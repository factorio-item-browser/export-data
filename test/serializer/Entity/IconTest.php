<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use FactorioItemBrowserTestAsset\ExportData\SerializerTestCase;

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
               ->setOffsetX(42)
               ->setOffsetY(21)
               ->setScale(13.37);

        $layer2 = new Layer();
        $layer2->setFileName('def')
               ->setOffsetX(13)
               ->setOffsetY(37)
               ->setScale(73.31);

        $icon = new Icon();
        $icon->setHash('ghi')
             ->setLayers([$layer1, $layer2])
             ->setSize(48)
             ->setRenderedSize(64);

        return $icon;
    }

    /**
     * Returns the serialized data.
     * @return array
     */
    protected function getData(): array
    {
        return [
            'hash' => 'ghi',
            'layers' => [
                [
                    'fileName' => 'abc',
                    'offsetX' => 42,
                    'offsetY' => 21,
                    'scale' => 13.37,
                    'tint' => [
                        'red' => 1.,
                        'green' => 1.,
                        'blue' => 1.,
                        'alpha' => 1.,
                    ],
                ],
                [
                    'fileName' => 'def',
                    'offsetX' => 13,
                    'offsetY' => 37,
                    'scale' => 73.31,
                    'tint' => [
                        'red' => 1.,
                        'green' => 1.,
                        'blue' => 1.,
                        'alpha' => 1.,
                    ],
                ]
            ],
            'size' => 48,
            'renderedSize' => 64,
        ];
    }
}
