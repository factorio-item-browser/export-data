<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity\Recipe;

use FactorioItemBrowser\ExportData\Entity\Recipe\Product;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

/**
 * The test of the serializing the product class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ProductTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $product = new Product();
        $product->type = 'abc';
        $product->name = 'def';
        $product->amountMin = 12.34;
        $product->amountMax = 23.45;
        $product->probability = 34.56;
        return $product;
    }

    protected function getData(): array
    {
        return [
            'type' => 'abc',
            'name' => 'def',
            'amountMin' => 12.34,
            'amountMax' => 23.45,
            'probability' => 34.56,
        ];
    }

    protected function getHashData(): array
    {
        return $this->getData();
    }
}
