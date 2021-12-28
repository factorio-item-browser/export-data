<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

/**
 * The test of the serializing the item class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $item = new Item();
        $item->type = 'abc';
        $item->name = 'def';
        $item->iconId = 'ghi';
        $item->localisedName = ['jkl', 42];
        $item->localisedDescription = ['mno', 21];
        $item->labels->set('pqr', 'stu');
        $item->descriptions->set('vwx', 'yza');

        return $item;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'type' => 'abc',
            'name' => 'def',
            'iconId' => 'ghi',
            'localisedName' => ['jkl', 42],
            'localisedDescription' => ['mno', 21],
            'labels' => [
                'pqr' => 'stu',
            ],
            'descriptions' => [
                'vwx' => 'yza',
            ],
        ];
    }
}
