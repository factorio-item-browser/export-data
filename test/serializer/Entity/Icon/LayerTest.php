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
        $layer->fileName = 'abc';
        $layer->scale = 13.37;
        $layer->size = 1337;
        $layer->offset->x = 42;
        $layer->offset->y = 21;
        $layer->tint->red = 12.34;
        $layer->tint->green = 23.45;
        $layer->tint->blue = 34.56;
        $layer->tint->alpha = 45.67;

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
