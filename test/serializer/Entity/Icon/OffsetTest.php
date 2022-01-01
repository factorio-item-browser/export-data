<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Entity\Icon\Offset;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

/**
 * The test of the serializing the offset class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class OffsetTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $offset = new Offset();
        $offset->x = 42;
        $offset->y = 21;

        return $offset;
    }

    protected function getData(): array
    {
        return [
            'x' => 42,
            'y' => 21,
        ];
    }

    protected function getHashData(): array
    {
        return $this->getData();
    }
}
