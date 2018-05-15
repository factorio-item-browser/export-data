<?php

namespace FactorioItemBrowserTest\ExportData\Entity\Recipe;

use BluePsyduck\Common\Data\DataContainer;
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
    public function testConstruct()
    {
        $product = new Product();

        $this->assertEquals('', $product->getType());
        $this->assertEquals('', $product->getName());
        $this->assertEquals(1., $product->getAmountMin());
        $this->assertEquals(1., $product->getAmountMax());
        $this->assertEquals(1., $product->getProbability());
        $this->assertEquals(0, $product->getOrder());
    }

    /**
     * Tests the cloning.
     * @coversNothing
     */
    public function testClone()
    {
        $product = new Product();
        $product->setType('abc')
                ->setName('def')
                ->setAmountMin(13.37)
                ->setAmountMax(4.2)
                ->setProbability(2.1)
                ->setOrder(42);

        $clonedProduct = clone($product);
        $product->setType('cba')
            ->setName('fed')
            ->setAmountMin(73.31)
            ->setAmountMax(2.4)
            ->setProbability(1.2)
            ->setOrder(24);

        $this->assertEquals('abc', $clonedProduct->getType());
        $this->assertEquals('def', $clonedProduct->getName());
        $this->assertEquals(13.37, $clonedProduct->getAmountMin());
        $this->assertEquals(4.2, $clonedProduct->getAmountMax());
        $this->assertEquals(2.1, $clonedProduct->getProbability());
        $this->assertEquals(42, $clonedProduct->getOrder());
    }

    /**
     * Tests setting and getting the type.
     * @covers ::setType
     * @covers ::getType
     */
    public function testSetAndGetType()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setType('foo'));
        $this->assertEquals('foo', $product->getType());
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setName('foo'));
        $this->assertEquals('foo', $product->getName());
    }

    /**
     * Tests setting and getting the minimal amount.
     * @covers ::setAmountMin
     * @covers ::getAmountMin
     */
    public function testSetAndGetAmountMin()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setAmountMin(13.37));
        $this->assertEquals(13.37, $product->getAmountMin());
    }

    /**
     * Tests setting and getting the maximal amount.
     * @covers ::setAmountMax
     * @covers ::getAmountMax
     */
    public function testSetAndGetAmountMax()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setAmountMax(13.37));
        $this->assertEquals(13.37, $product->getAmountMax());
    }

    /**
     * Tests setting and getting the probability.
     * @covers ::setProbability
     * @covers ::getProbability
     */
    public function testSetAndGetProbability()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setProbability(13.37));
        $this->assertEquals(13.37, $product->getProbability());
    }

    /**
     * Tests setting and getting the order.
     * @covers ::setOrder
     * @covers ::getOrder
     */
    public function testSetAndGetOrder()
    {
        $product = new Product();
        $this->assertEquals($product, $product->setOrder(42));
        $this->assertEquals(42, $product->getOrder());
    }

    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $product = new Product();
        $product->setType('abc')
                   ->setName('def')
                   ->setAmountMin(13.37)
                   ->setAmountMax(73.31)
                   ->setProbability(4.2)
                   ->setOrder(42);

        $data = [
            't' => 'abc',
            'n' => 'def',
            'i' => 13.37,
            'a' => 73.31,
            'p' => 4.2,
            'o' => 42
        ];

        return [
            [$product, $data],
            [new Product(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param Product $product
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Product $product, array $expectedData)
    {
        $data = $product->writeData();
        $this->assertEquals($expectedData, $data);

        $newProduct = new Product();
        $this->assertEquals($newProduct, $newProduct->readData(new DataContainer($data)));
        $this->assertEquals($newProduct, $product);
    }
}
