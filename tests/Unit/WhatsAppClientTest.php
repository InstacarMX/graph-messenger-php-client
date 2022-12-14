<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\Test\Unit;

use Instacar\GraphMessengerApi\Test\Util\IterableUtil;
use Instacar\GraphMessengerApi\WhatsApp\Model\Action\ButtonAction;
use Instacar\GraphMessengerApi\WhatsApp\Model\Action\ListAction;
use Instacar\GraphMessengerApi\WhatsApp\Model\Action\ProductAction;
use Instacar\GraphMessengerApi\WhatsApp\Model\Action\ProductListAction;
use Instacar\GraphMessengerApi\WhatsApp\Model\Address;
use Instacar\GraphMessengerApi\WhatsApp\Model\Body;
use Instacar\GraphMessengerApi\WhatsApp\Model\Button\ReplyButton;
use Instacar\GraphMessengerApi\WhatsApp\Model\Component\BodyComponent;
use Instacar\GraphMessengerApi\WhatsApp\Model\Component\HeaderComponent;
use Instacar\GraphMessengerApi\WhatsApp\Model\Component\QuickReplyButtonComponent;
use Instacar\GraphMessengerApi\WhatsApp\Model\Component\UrlButtonComponent;
use Instacar\GraphMessengerApi\WhatsApp\Model\Contact;
use Instacar\GraphMessengerApi\WhatsApp\Model\Context;
use Instacar\GraphMessengerApi\WhatsApp\Model\Currency;
use Instacar\GraphMessengerApi\WhatsApp\Model\DateTime;
use Instacar\GraphMessengerApi\WhatsApp\Model\Email;
use Instacar\GraphMessengerApi\WhatsApp\Model\Footer;
use Instacar\GraphMessengerApi\WhatsApp\Model\Header\TextHeader;
use Instacar\GraphMessengerApi\WhatsApp\Model\Interactive\InteractiveButton;
use Instacar\GraphMessengerApi\WhatsApp\Model\Interactive\InteractiveList;
use Instacar\GraphMessengerApi\WhatsApp\Model\Interactive\InteractiveProduct;
use Instacar\GraphMessengerApi\WhatsApp\Model\Interactive\InteractiveProductList;
use Instacar\GraphMessengerApi\WhatsApp\Model\Language;
use Instacar\GraphMessengerApi\WhatsApp\Model\Location;
use Instacar\GraphMessengerApi\WhatsApp\Model\Media\AudioMedia;
use Instacar\GraphMessengerApi\WhatsApp\Model\Media\DocumentMedia;
use Instacar\GraphMessengerApi\WhatsApp\Model\Media\ImageMedia;
use Instacar\GraphMessengerApi\WhatsApp\Model\Media\StickerMedia;
use Instacar\GraphMessengerApi\WhatsApp\Model\Media\VideoMedia;
use Instacar\GraphMessengerApi\WhatsApp\Model\Message\AudioMessage;
use Instacar\GraphMessengerApi\WhatsApp\Model\Message\ContactMessage;
use Instacar\GraphMessengerApi\WhatsApp\Model\Message\DocumentMessage;
use Instacar\GraphMessengerApi\WhatsApp\Model\Message\ImageMessage;
use Instacar\GraphMessengerApi\WhatsApp\Model\Message\InteractiveMessage;
use Instacar\GraphMessengerApi\WhatsApp\Model\Message\LocationMessage;
use Instacar\GraphMessengerApi\WhatsApp\Model\Message\ReactionMessage;
use Instacar\GraphMessengerApi\WhatsApp\Model\Message\StickerMessage;
use Instacar\GraphMessengerApi\WhatsApp\Model\Message\TemplateMessage;
use Instacar\GraphMessengerApi\WhatsApp\Model\Message\TextMessage;
use Instacar\GraphMessengerApi\WhatsApp\Model\Name;
use Instacar\GraphMessengerApi\WhatsApp\Model\Organization;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\ButtonPayloadParameter;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\ButtonTextParameter;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\CurrencyParameter;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\DateTimeParameter;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\DocumentParameter;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\ImageParameter;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\TextParameter;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\VideoParameter;
use Instacar\GraphMessengerApi\WhatsApp\Model\Phone;
use Instacar\GraphMessengerApi\WhatsApp\Model\Product;
use Instacar\GraphMessengerApi\WhatsApp\Model\Reaction;
use Instacar\GraphMessengerApi\WhatsApp\Model\Reply;
use Instacar\GraphMessengerApi\WhatsApp\Model\Row;
use Instacar\GraphMessengerApi\WhatsApp\Model\Section\ListSection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Section\ProductListSection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Template;
use Instacar\GraphMessengerApi\WhatsApp\Model\Text;
use Instacar\GraphMessengerApi\WhatsApp\Model\Url;
use Instacar\GraphMessengerApi\WhatsApp\WhatsAppClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Component\HttpClient\Response\MockResponse;

class WhatsAppClientTest extends TestCase
{
    public function testAudioMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $audio = new AudioMedia(id: '11111');
        $message = new AudioMessage('521111111111', $audio);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('audio-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testContactMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $message = new ContactMessage('521111111111');

        $fullContact = new Contact(
            new Name('John', 'Roe', 'Doe', 'Sr.', '3th'),
            new \DateTime('1990-01-01'),
            new Organization('Test Company LLC', 'TI', 'Test Company'),
        );
        $fullContact->addAddress(new Address('MX', 'Mexico', '12345', 'Mexico City', 'Mexico City', '1st Street', 'HOME'));
        $fullContact->addEmail(new Email('john@example.com', 'HOME'));
        $fullContact->addPhone(new Phone('522222222222', '1111111111', 'HOME'));
        $fullContact->addUrl(new Url('https://example.com/john', 'HOME'));
        $message->addContact($fullContact);

        $minimalContact = new Contact(new Name('Jane'));
        $minimalContact->addAddress(new Address(street: '2nd Street'));
        $minimalContact->addEmail(new Email('jane@example.com'));
        $minimalContact->addPhone(new Phone('523333333333'));
        $minimalContact->addUrl(new Url('https://example.com/jane'));
        $message->addContact($minimalContact);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('contact-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testDocumentMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $document = new DocumentMedia(id: '11111', filename: 'test.pdf', caption: 'This is a test document');
        $message = new DocumentMessage('521111111111', $document);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('document-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testImageMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $image = new ImageMedia(id: '11111', caption: 'This is a test image');
        $message = new ImageMessage('521111111111', $image);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('image-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testInteractiveButtonMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $listAction = new ButtonAction();
        $listAction->addButton(new ReplyButton(new Reply('111', 'test 1')));
        $listAction->addButton(new ReplyButton(new Reply('222', 'test 2')));

        $interactiveProduct = new InteractiveButton(
            $listAction,
            new Body('test body'),
            new TextHeader('test header'),
            new Footer('test footer'),
        );
        $message = new InteractiveMessage('521111111111', $interactiveProduct);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('interactive-button-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testInteractiveListMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $listAction = new ListAction('test button');

        $section1 = new ListSection('section-1');
        $section1->addRow(new Row('111', 'row-1', 'test row'));
        $section1->addRow(new Row('222', 'row-2'));
        $listAction->addSection($section1);

        $section2 = new ListSection('section-2');
        $section2->addRow(new Row('333', 'row-3', 'another test row'));
        $section2->addRow(new Row('444', 'row-4'));
        $listAction->addSection($section2);

        $interactiveList = new InteractiveList(
            $listAction,
            new Body('test body'),
            new TextHeader('test header'),
            new Footer('test footer'),
        );
        $message = new InteractiveMessage('521111111111', $interactiveList);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('interactive-list-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testInteractiveProductMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $interactiveProduct = new InteractiveProduct(
            new ProductAction('11111', '22222'),
            new Body('test body'),
            new Footer('test footer'),
        );
        $message = new InteractiveMessage('521111111111', $interactiveProduct);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('interactive-product-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testInteractiveProductListMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $productListAction = new ProductListAction('11111');

        $section1 = new ProductListSection('section-1');
        $section1->addProductItem(new Product('111'));
        $section1->addProductItem(new Product('222'));
        $productListAction->addSection($section1);

        $section2 = new ProductListSection('section-2');
        $section2->addProductItem(new Product('333'));
        $section2->addProductItem(new Product('444'));
        $productListAction->addSection($section2);

        $interactiveProductList = new InteractiveProductList(
            $productListAction,
            new TextHeader('test header'),
            new Body('test body'),
            new Footer('test footer'),
        );
        $message = new InteractiveMessage('521111111111', $interactiveProductList);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('interactive-product-list-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testLocationMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $location = new Location(10.01, 20.02, 'My house', '1st street #203');
        $message = new LocationMessage('521111111111', $location);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('location-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testReactionMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $reaction = new Reaction('wamid.vwxyz', '😀');
        $message = new ReactionMessage('521111111111', $reaction);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('reaction-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testStickerMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $sticker = new StickerMedia(id: '11111');
        $message = new StickerMessage('521111111111', $sticker);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('sticker-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testTemplateMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $language = new Language('es');
        $template = new Template('test_template', $language);

        $headerComponent = new HeaderComponent();
        $headerComponent->addParameter(new DocumentParameter(new DocumentMedia(id: '11111', filename: 'test1.pdf')));
        $headerComponent->addParameter(new ImageParameter(new ImageMedia(id: '22222')));
        $headerComponent->addParameter(new VideoParameter(new VideoMedia(id: '33333')));
        $headerComponent->addParameter(new DocumentParameter(new DocumentMedia(link: 'https://example.com/document.pdf', filename: 'test2.pdf')));
        $headerComponent->addParameter(new ImageParameter(new ImageMedia(link: 'https://example.com/image.jpg')));
        $headerComponent->addParameter(new VideoParameter(new VideoMedia(link: 'https://example.com/video.mp4')));
        $template->addComponent($headerComponent);

        $bodyComponent = new BodyComponent();
        $bodyComponent->addParameter(new CurrencyParameter(new Currency('MXN', 50.50, '$50.50')));
        $bodyComponent->addParameter(new DateTimeParameter(new DateTime('14 de agosto del 2022')));
        $bodyComponent->addParameter(new TextParameter('test message'));
        $template->addComponent($bodyComponent);

        $quickReplyComponent = new QuickReplyButtonComponent(0);
        $quickReplyComponent->addParameter(new ButtonPayloadParameter('test 1'));
        $quickReplyComponent->addParameter(new ButtonPayloadParameter('test 2'));
        $template->addComponent($quickReplyComponent);

        $urlComponent = new UrlButtonComponent(1);
        $urlComponent->addParameter(new ButtonTextParameter('test 3'));
        $urlComponent->addParameter(new ButtonTextParameter('test 4'));
        $template->addComponent($urlComponent);

        $message = new TemplateMessage('521111111111', $template);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('template-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testTextMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $text = new Text('This is a test', true);
        $message = new TextMessage('521111111111', $text);

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('text-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    public function testReplyToMessages(): void
    {
        $mockResponse = new MockResponse('{"messaging_product": "whatsapp", "contacts": [{"input": "521111111111", "wa_id": "1111111111"}], "messages": [{"id": "wamid.abcdef"}]}');
        $client = $this->mockClient($mockResponse);

        $text = new Text('This is a test', true);
        $message = new TextMessage('521111111111', $text, new Context('wamid.vwxyz'));

        $data = $client->sendMessage('0000000000', $message);

        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertEquals('https://graph.facebook.com/v15.0/0000000000/messages', $mockResponse->getRequestUrl());

        $request = $mockResponse->getRequestOptions();
        $this->assertAuthorization($request);
        $this->assertJsonRequest('reply-to-message.json', $request);

        $this->assertEquals('whatsapp', $data->getMessagingProduct());

        $contacts = IterableUtil::iterableToArray($data->getContacts());
        $this->assertCount(1, $contacts);
        $this->assertEquals('521111111111', $contacts[0]['input']);
        $this->assertEquals('1111111111', $contacts[0]['wa_id']);

        $messages = IterableUtil::iterableToArray($data->getMessages());
        $this->assertCount(1, $messages);
        $this->assertEquals('wamid.abcdef', $messages[0]['id']);
    }

    private function mockClient(MockResponse $response): WhatsAppClient
    {
        $httpClient = new MockHttpClient($response);
        $psr18Client = new Psr18Client($httpClient);
        $psr17Factory = new Psr17Factory();

        return new WhatsAppClient($psr18Client, $psr17Factory, $psr17Factory, $psr17Factory, '1234567890');
    }

    /**
     * @param mixed[] $requestOptions
     */
    private function assertAuthorization(array $requestOptions): void
    {
        $headers = $requestOptions['normalized_headers'];
        $this->assertArrayHasKey('authorization', $headers);

        $authorizationHeader = $headers['authorization'];
        $this->assertCount(1, $authorizationHeader);
        $this->assertEquals('Authorization: Bearer 1234567890', $authorizationHeader[0]);
    }

    /**
     * @param mixed[] $requestOptions
     */
    private function assertJsonRequest(string $fixture, array $requestOptions): void
    {
        $headers = $requestOptions['normalized_headers'];
        $this->assertArrayHasKey('content-type', $headers);

        $contentTypeHeader = $headers['content-type'];
        $this->assertCount(1, $contentTypeHeader);
        $this->assertEquals('Content-Type: application/json', $contentTypeHeader[0]);

        $fixturePath = __DIR__ . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR . 'Fixtures' . \DIRECTORY_SEPARATOR . $fixture;
        $fixtureRealPath = realpath($fixturePath);
        if ($fixtureRealPath === false) {
            throw new \InvalidArgumentException(sprintf('The fixture %s can not be found, search in %s', $fixture, $fixturePath));
        }

        $payload = $requestOptions['body'];
        $this->assertJsonStringEqualsJsonFile($fixtureRealPath, $payload);
    }
}
