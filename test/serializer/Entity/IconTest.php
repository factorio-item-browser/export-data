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
 */
class IconTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $layer1 = new Layer();
        $layer1->fileName = 'abc';
        $layer1->scale = 13.37;
        $layer1->size = 42;

        $layer2 = new Layer();
        $layer2->fileName = 'def';
        $layer2->scale = 73.31;
        $layer2->size = 21;

        $icon = new Icon();
        $icon->id = 'ghi';
        $icon->type = 'jkl';
        $icon->name = 'mno';
        $icon->layers = [$layer1, $layer2];
        $icon->size = 1337;

        return $icon;
    }

    protected function getData(): array
    {
        return [
            'id' => 'ghi',
            'type' => 'jkl',
            'name' => 'mno',
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

    protected function getHashData(): array
    {
        return [
            'type' => 'jkl',
            'name' => 'mno',
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
