<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

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
              ->setScale(13.37)
              ->setSize(1337);
        $layer->getOffset()->setX(42)
                           ->setY(21);
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
            'offset' => [
                'x' => 42,
                'y' => 21,
            ],
            'scale' => 13.37,
            'size' => 1337,
            'tint' => [
                'red' => 12.34,
                'green' => 23.45,
                'blue' => 34.56,
                'alpha' => 45.67,
            ],
        ];
    }
}
