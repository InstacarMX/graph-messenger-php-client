<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Parameter;

use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

#[DiscriminatorMap(typeProperty: 'type', mapping: [
    'currency' => CurrencyParameter::class,
    'date_time' => DateTimeParameter::class,
    'document' => DocumentParameter::class,
    'image' => ImageParameter::class,
    'text' => TextParameter::class,
    'video' => VideoParameter::class,
])]
abstract class Parameter
{
}
