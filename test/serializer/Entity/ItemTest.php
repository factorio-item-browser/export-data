<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowserTestAsset\ExportData\SerializerTestCase;

/**
 * The test of the serializing the item class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Item
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
        $item->setType('abc')
             ->setName('def')
             ->setIconHash('ghi');
        $item->getLabels()->addTranslation('jkl', 'mno');
        $item->getDescriptions()->addTranslation('pqr', 'stu');

        return $item;
    }

    /**
     * Returns the serialized data.
     * @return array
     */
    protected function getData(): array
    {
        return [
            'type' => 'abc',
            'name' => 'def',
            'iconHash' => 'ghi',
            'labels' => [
                'jkl' => 'mno',
            ],
            'descriptions' => [
                'pqr' => 'stu',
            ],
        ];
    }
}