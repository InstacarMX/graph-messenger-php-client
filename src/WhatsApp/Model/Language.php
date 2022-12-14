<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Language
{
    /**
     * Extracted from https://developers.facebook.com/docs/whatsapp/api/messages/message-templates#supported-languages.
     */
    private const SUPPORTED_LANGUAGES = [
        'af', 'sq', 'ar', 'az', 'bn', 'bg', 'ca', 'zh_CN', 'zh_HK', 'zh_TW', 'hr', 'cs', 'da', 'nl', 'en', 'en_GB',
        'en_US', 'et', 'fil', 'fi', 'fr', 'ka', 'de', 'el', 'gu', 'ha', 'he', 'hi', 'hu', 'id', 'ga', 'it', 'ja', 'kn',
        'kk', 'rw_RW', 'ko', 'ky_KG', 'lo', 'lv', 'lt', 'mk', 'ms', 'ml', 'mr', 'nb', 'fa', 'pl', 'pt_BR', 'pt_PT',
        'pa', 'ro', 'ru', 'sr', 'sk', 'sl', 'es', 'es_AR', 'es_ES', 'es_MX', 'sw', 'sv', 'ta', 'te', 'th', 'tr', 'uk',
        'ur', 'uz', 'vi', 'zu',
    ];

    private string $code;

    public function __construct(string $code)
    {
        if (!\in_array($code, self::SUPPORTED_LANGUAGES, true)) {
            throw new \InvalidArgumentException(sprintf('The code must be one of the supported languages in https://developers.facebook.com/docs/whatsapp/api/messages/message-templates#supported-languages, %s given', $code));
        }

        $this->code = $code;
    }

    public function getPolicy(): string
    {
        return 'deterministic';
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
