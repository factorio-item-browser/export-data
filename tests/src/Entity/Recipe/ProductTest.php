<?php

namespace FactorioItemBrowserTest\ExportData\Entity\Recipe;

use FactorioItemBrowser\ExportData\Entity\Recipe\Product;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the product class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass FactorioItemBrowser\ExportData\Entity\Recipe\Product
 */
class ProductTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $product = new Product();

        $this->assertEquals('', $product->getType());
        $this->assertEquals('', $product->getName());
        $this->assertEquals(0., $product->getAmountMin());
        $this->assertEquals(0., $product->getAmountMax());
        $this->assertEquals(0., $product->getProbability());
        $this->assertEquals(0, $product->getOrder());
    }

    /**
     * Tests setting and getting the type.
     */
    public function testSetAndGetType()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setType('foo'));
        $this->assertEquals('foo', $product->getType());
    }

    /**
     * Tests setting and getting the name.
     */
    public function testSetAndGetName()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setName('foo'));
        $this->assertEquals('foo', $product->getName());
    }

    /**
     * Tests setting and getting the minimal amount.
     */
    public function testSetAndGetAmountMin()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setAmountMin(13.37));
        $this->assertEquals(13.37, $product->getAmountMin());
    }

    /**
     * Tests setting and getting the maximal amount.
     */
    public function testSetAndGetAmountMax()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setAmountMax(13.37));
        $this->assertEquals(13.37, $product->getAmountMax());
    }

    /**
     * Tests setting and getting the probability.
     */
    public function testSetAndGetProbability()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setProbability(13.37));
        $this->assertEquals(13.37, $product->getProbability());
    }

    /**
     * Tests setting and getting the order.
     */
    public function testSetAndGetOrder()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setOrder(42));
        $this->assertEquals(42, $product->getOrder());
    }
}
