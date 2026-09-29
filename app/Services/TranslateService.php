<?php

namespace App\Services;

use DeepL\Translator;
use DeepL\DeepLException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TranslateService
{
    protected static ?Translator $translator = null;

    protected static function translator(): Translator
    {
        if (self::$translator === null) {
            self::$translator = new Translator(config('services.deepl.key'));
        }
        return self::$translator;
    }

    public static function to(?string $text, string $targetLang = 'en'): ?string
    {
        if (empty(trim($text ?? '')) || $targetLang === 'id') {
            return $text;
        }

        $cacheKey = 'translate_' . $targetLang . '_' . md5($text);

        return Cache::rememberForever($cacheKey, function () use ($text, $targetLang) {
            try {
                $result = self::translator()->translateText(
                    $text,
                    'id',
                    $targetLang === 'en' ? 'en-US' : $targetLang,
                    ['tag_handling' => 'html']
                );
                return html_entity_decode($result->text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            } catch (DeepLException $e) {
                Log::warning('DeepL translation failed: ' . $e->getMessage());
                return $text;
            }
        });
    }

    public static function toIndonesian(?string $text, string $sourceLang): ?string
    {
        if (empty(trim($text ?? '')) || $sourceLang === 'id') {
            return $text;
        }

        $cacheKey = 'translate_to_id_' . $sourceLang . '_' . md5($text);

        return Cache::rememberForever($cacheKey, function () use ($text, $sourceLang) {
            try {
                $result = self::translator()->translateText(
                    $text,
                    $sourceLang === 'en' ? 'en' : $sourceLang,
                    'id'
                );
                return $result->text;
            } catch (DeepLException $e) {
                Log::warning('DeepL reverse translation failed: ' . $e->getMessage());
                return $text; // fallback: search pakai kata asli
            }
        });
    }

    public static function timezoneLabel(): string
    {
        return app()->getLocale() === 'id' ? 'WIB' : 'WIB (GMT+7)';
    }
}