<?php

namespace Instacar\GraphMessengerApi;

use Instacar\GraphMessengerApi\Exception\GraphException;
use Instacar\GraphMessengerApi\Response\ErrorResponse;
use Instacar\Psr7Utils\Serializer\RequestSerializer;
use Instacar\Psr7Utils\Serializer\RequestSerializerInterface;
use Instacar\Psr7Utils\Serializer\ResponseDeserializer;
use Instacar\Psr7Utils\Serializer\ResponseDeserializerInterface;
use Instacar\Psr7Utils\Utils\RequestUtils;
use Instacar\Psr7Utils\Utils\UriUtils;
use LogicException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Symfony\Component\HttpClient\HttpClient as SymfonyHttpClient;
use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class GraphClient
{
    protected const BASE_URL = 'https://graph.facebook.com/v15.0/';

    private ClientInterface $client;

    private RequestFactoryInterface $requestFactory;

    private UriFactoryInterface $uriFactory;

    private RequestSerializerInterface $requestSerializer;

    private ResponseDeserializerInterface $responseDeserializer;

    private string $jwtToken;

    public function __construct(
        ClientInterface $client,
        RequestFactoryInterface $requestFactory,
        UriFactoryInterface $uriFactory,
        StreamFactoryInterface $streamFactory,
        string $jwtToken,
    ) {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(null));
        $nameConverter = new MetadataAwareNameConverter($classMetadataFactory, new CamelCaseToSnakeCaseNameConverter());
        $propertyTypeExtractor = new ReflectionExtractor();
        $classDiscriminatorResolver = new ClassDiscriminatorFromClassMetadata($classMetadataFactory);
        $serializer = new Serializer(
            [
                new ObjectNormalizer(
                    $classMetadataFactory,
                    $nameConverter,
                    null,
                    $propertyTypeExtractor,
                    $classDiscriminatorResolver,
                    null,
                    [ObjectNormalizer::SKIP_NULL_VALUES => true],
                ),
                new ArrayDenormalizer(),
            ],
            ['json' => new JsonEncoder()],
        );

        $this->client = $client;
        $this->requestFactory = $requestFactory;
        $this->uriFactory = $uriFactory;
        $this->requestSerializer = new RequestSerializer($serializer, $streamFactory);
        $this->responseDeserializer = new ResponseDeserializer($serializer);
        $this->jwtToken = $jwtToken;
    }

    public static function createDefault(string $jwtToken): static
    {
        if (!class_exists(SymfonyHttpClient::class)) {
            throw new LogicException('You must install the Symfony HTTP Client component.' . \PHP_EOL . 'Please, execute "composer require symfony/http-client" in your project root');
        }
        if (!class_exists(Request::class)) {
            throw new LogicException('You must install the Nyholm PSR-7 implementation.' . \PHP_EOL . 'Please, execute "composer require nyholm/psr7" in your project root');
        }

        $httpClient = SymfonyHttpClient::create();
        $psr18Client = new Psr18Client($httpClient);
        $psr17Factory = new Psr17Factory();

        return new static($psr18Client, $psr17Factory, $psr17Factory, $psr17Factory, $jwtToken);
    }

    /**
     * @phpstan-template TRequestPayload of object
     * @phpstan-template TResponsePayload of object
     *
     * @phpstan-param class-string<TResponsePayload> $responseClass
     * @phpstan-param array<string, string> $params
     * @phpstan-param TRequestPayload|null $payload
     * @phpstan-param array<string, string|array<string>> $headers
     * @phpstan-return TResponsePayload
     */
    protected function sendJsonRequest(
        string $endpoint,
        string $responseClass,
        string $method = 'GET',
        array $params = [],
        mixed $payload = null,
        bool $authenticated = true,
        array $headers = [],
    ): object {
        $request = $this->createJsonRequest($endpoint, $method, $params, $payload, $authenticated, $headers);
        $response = $this->client->sendRequest($request);

        return $this->parseJsonResponse($response, $responseClass);
    }

    /**
     * @phpstan-template TPayload of object
     *
     * @phpstan-param array<string, string> $params
     * @phpstan-param TPayload|null $payload
     * @phpstan-param array<string, string|array<string>> $headers
     */
    private function createJsonRequest(
        string $endpoint,
        string $method = 'GET',
        array $params = [],
        mixed $payload = null,
        bool $authenticated = true,
        array $headers = [],
    ): RequestInterface {
        $uri = $this->uriFactory->createUri(self::BASE_URL . $endpoint);
        $uri = UriUtils::withParams($uri, $params);

        $request = $this->requestFactory->createRequest($method, $uri);

        $request = $request->withHeader('Accept', 'application/json');
        $request = $request->withHeader('Content-Type', 'application/json');

        $request = RequestUtils::withHeaders($request, $headers);
        $request = $this->requestSerializer->serialize($request, $payload, 'json');

        if ($authenticated) {
            $request = RequestUtils::withBearerAuthorization($request, $this->jwtToken);
        }

        return $request;
    }

    /**
     * @phpstan-template TPayload of object
     *
     * @phpstan-param class-string<TPayload> $responseClass
     * @phpstan-return TPayload
     */
    private function parseJsonResponse(
        ResponseInterface $response,
        string $responseClass,
    ): object {
        $statusCode = $response->getStatusCode();
        if ($statusCode < 200 || $statusCode > 299) {
            $errorResponse = $this->responseDeserializer->deserialize($response, ErrorResponse::class, 'json');
            $error = $errorResponse->getError();

            throw new GraphException($statusCode, $error);
        }

        return $this->responseDeserializer->deserialize($response, $responseClass, 'json');
    }
}