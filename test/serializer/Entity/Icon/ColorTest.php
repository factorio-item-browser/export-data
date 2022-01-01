<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Entity\Icon\Color;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

/**
 * The test of the serializing the color class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ColorTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $color = new Color();
        $color->red = 12.34;
        $color->green = 23.45;
        $color->blue = 34.56;
        $color->alpha = 45.67;

        return $color;
    }

    protected function getData(): array
    {
        return [
            'red' => 12.34,
            'green' => 23.45,
            'blue' => 34.56,
            'alpha' => 45.67,
        ];
    }


    protected function getHashData(): array
    {
        return $this->getData();
    }
}
