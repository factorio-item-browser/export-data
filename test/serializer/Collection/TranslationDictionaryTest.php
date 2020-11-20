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
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Collection\TranslationDictionary
 */
class TranslationDictionaryTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $translations = new TranslationDictionary();
        $translations->set('abc', 'def');
        $translations->set('ghi', 'jkl');

        return $translations;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'abc' => 'def',
            'ghi' => 'jkl',
        ];
    }
}
