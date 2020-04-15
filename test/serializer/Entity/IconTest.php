<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

/**
 * The test of the serializing the icon class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Icon
 */
class IconTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $layer1 = new Layer();
        $layer1->setFileName('abc')
               ->setScale(13.37)
               ->setSize(42);

        $layer2 = new Layer();
        $layer2->setFileName('def')
               ->setScale(73.31)
               ->setSize(21);

        $icon = new Icon();
        $icon->setId('ghi')
             ->setLayers([$layer1, $layer2])
             ->setSize(1337);

        return $icon;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'id' => 'ghi',
            'layers' => [
                [
                    'fileName' => 'abc',
                    'offset' => [
                        'x' => 0,
                        'y' => 0,
                    ],
                    'scale' => 13.37,
                    'size' => 42,
                    'tint' => [
                        'red' => 1.,
                        'green' => 1.,
                        'blue' => 1.,
                        'alpha' => 1.,
                    ],
                ],
                [
                    'fileName' => 'def',
                    'offset' => [
                        'x' => 0,
                        'y' => 0,
                    ],
                    'scale' => 73.31,
                    'size' => 21,
                    'tint' => [
                        'red' => 1.,
                        'green' => 1.,
                        'blue' => 1.,
                        'alpha' => 1.,
                    ],
                ]
            ],
            'size' => 1337,
        ];
    }
}
