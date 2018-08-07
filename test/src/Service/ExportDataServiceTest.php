<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Service;

use BluePsyduck\Common\Test\ReflectionTrait;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Machine;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use FactorioItemBrowser\ExportData\Registry\Adapter\AdapterInterface;
use FactorioItemBrowser\ExportData\Service\ExportDataService;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the ExportDataService class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Service\ExportDataService
 */
class ExportDataServiceTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests the getIconRegistry method.
     * @throws ReflectionException
     * @covers ::__construct
     * @covers ::getIconRegistry
     */
    public function testGetIconRegistry()
    {
        /* @var AdapterInterface $adapter */
        $adapter = $this->createMock(AdapterInterface::class);
        $expectedEntityClassName = Icon::class;

        $service = new ExportDataService($adapter);
        $registry = $service->getIconRegistry();
        $this->assertSame($adapter, $this->extractProperty($registry, 'adapter'));
        $this->assertSame($expectedEntityClassName, $this->extractProperty($registry, 'entityClassName'));
    }

    /**
     * Tests the getMachineRegistry method.
     * @throws ReflectionException
     * @covers ::__construct
     * @covers ::getMachineRegistry
     */
    public function testGetMachineRegistry()
    {
        /* @var AdapterInterface $adapter */
        $adapter = $this->createMock(AdapterInterface::class);
        $expectedEntityClassName = Machine::class;

        $service = new ExportDataService($adapter);
        $registry = $service->getMachineRegistry();
        $this->assertSame($adapter, $this->extractProperty($registry, 'adapter'));
        $this->assertSame($expectedEntityClassName, $this->extractProperty($registry, 'entityClassName'));
    }

    /**
     * Tests the getItemRegistry method.
     * @throws ReflectionException
     * @covers ::__construct
     * @covers ::getItemRegistry
     */
    public function testGetItemRegistry()
    {
        /* @var AdapterInterface $adapter */
        $adapter = $this->createMock(AdapterInterface::class);
        $expectedEntityClassName = Item::class;

        $service = new ExportDataService($adapter);
        $registry = $service->getItemRegistry();
        $this->assertSame($adapter, $this->extractProperty($registry, 'adapter'));
        $this->assertSame($expectedEntityClassName, $this->extractProperty($registry, 'entityClassName'));
    }

    /**
     * Tests the getModRegistry method.
     * @throws ReflectionException
     * @covers ::__construct
     * @covers ::getModRegistry
     */
    public function testGetModRegistry()
    {
        /* @var AdapterInterface $adapter */
        $adapter = $this->createMock(AdapterInterface::class);
        $expectedNamespace = 'mod';

        $service = new ExportDataService($adapter);
        $registry = $service->getModRegistry();
        $this->assertSame($adapter, $this->extractProperty($registry, 'adapter'));
        $this->assertSame($expectedNamespace, $this->extractProperty($registry, 'namespace'));
    }

    /**
     * Tests the getRecipeRegistry method.
     * @throws ReflectionException
     * @covers ::__construct
     * @covers ::getRecipeRegistry
     */
    public function testGetRecipeRegistry()
    {
        /* @var AdapterInterface $adapter */
        $adapter = $this->createMock(AdapterInterface::class);
        $expectedEntityClassName = Recipe::class;

        $service = new ExportDataService($adapter);
        $registry = $service->getRecipeRegistry();
        $this->assertSame($adapter, $this->extractProperty($registry, 'adapter'));
        $this->assertSame($expectedEntityClassName, $this->extractProperty($registry, 'entityClassName'));
    }

    /**
     * Tests the getRenderedIconRegistry method.
     * @throws ReflectionException
     * @covers ::__construct
     * @covers ::getRenderedIconRegistry
     */
    public function testGetRenderedIconRegistry()
    {
        /* @var AdapterInterface $adapter */
        $adapter = $this->createMock(AdapterInterface::class);
        $expectedNamespace = 'renderedIcon';

        $service = new ExportDataService($adapter);
        $registry = $service->getRenderedIconRegistry();
        $this->assertSame($adapter, $this->extractProperty($registry, 'adapter'));
        $this->assertSame($expectedNamespace, $this->extractProperty($registry, 'namespace'));
    }
}
