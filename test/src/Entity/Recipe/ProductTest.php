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
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $product = new Product();

        $this->assertSame('', $product->getType());
        $this->assertSame('', $product->getName());
        $this->assertSame(1., $product->getAmountMin());
        $this->assertSame(1., $product->getAmountMax());
        $this->assertSame(1., $product->getProbability());
    }

    /**
     * Tests the setting and getting the type.
     * @covers ::getType
     * @covers ::setType
     */
    public function testSetAndGetType(): void
    {
        $type = 'abc';
        $product = new Product();

        $this->assertSame($product, $product->setType($type));
        $this->assertSame($type, $product->getType());
    }

    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $product = new Product();

        $this->assertSame($product, $product->setName($name));
        $this->assertSame($name, $product->getName());
    }

    /**
     * Tests the setting and getting the amount min.
     * @covers ::getAmountMin
     * @covers ::setAmountMin
     */
    public function testSetAndGetAmountMin(): void
    {
        $amountMin = 13.37;
        $product = new Product();

        $this->assertSame($product, $product->setAmountMin($amountMin));
        $this->assertSame($amountMin, $product->getAmountMin());
    }

    /**
     * Tests the setting and getting the amount max.
     * @covers ::getAmountMax
     * @covers ::setAmountMax
     */
    public function testSetAndGetAmountMax(): void
    {
        $amountMax = 13.37;
        $product = new Product();

        $this->assertSame($product, $product->setAmountMax($amountMax));
        $this->assertSame($amountMax, $product->getAmountMax());
    }

    /**
     * Tests the setting and getting the probability.
     * @covers ::getProbability
     * @covers ::setProbability
     */
    public function testSetAndGetProbability(): void
    {
        $probability = 13.37;
        $product = new Product();

        $this->assertSame($product, $product->setProbability($probability));
        $this->assertSame($probability, $product->getProbability());
    }
}
