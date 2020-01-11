<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use FactorioItemBrowserTestAsset\ExportData\SerializerTestCase;

/**
 * The test of the serializing the layer class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Icon\Layer
 */
class LayerTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $layer = new Layer();
        $layer->setFileName('abc')
              ->setOffsetX(42)
              ->setOffsetY(21)
              ->setScale(13.37);
        $layer->getTint()->setRed(12.34)
                         ->setGreen(23.45)
                         ->setBlue(34.56)
                         ->setAlpha(45.67);

        return $layer;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'fileName' => 'abc',
            'offsetX' => 42,
            'offsetY' => 21,
            'scale' => 13.37,
            'tint' => [
                'red' => 12.34,
                'green' => 23.45,
                'blue' => 34.56,
                'alpha' => 45.67,
            ],
        ];
    }
}
