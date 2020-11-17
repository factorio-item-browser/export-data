<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Recipe;

use FactorioItemBrowser\ExportData\Entity\Recipe\Product;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the product class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Recipe\Product
 */
class ProductTest extends TestCase
{
    /**
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $product = new Product();

        $this->assertSame('', $product->type);
        $this->assertSame('', $product->name);
        $this->assertSame(1., $product->amountMin);
        $this->assertSame(1., $product->amountMax);
        $this->assertSame(1., $product->probability);
    }
}
