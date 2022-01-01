<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Collection;

use FactorioItemBrowser\ExportData\Collection\TranslationDictionary;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

/**
 * The test of the serializing the translations class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class TranslationDictionaryTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $translations = new TranslationDictionary();
        $translations->set('abc', 'def');
        $translations->set('ghi', 'jkl');

        return $translations;
    }

    protected function getData(): array
    {
        return [
            'abc' => 'def',
            'ghi' => 'jkl',
        ];
    }

    protected function getHashData(): array
    {
        return [];
    }
}
