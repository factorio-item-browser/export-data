<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Registry;

use FactorioItemBrowser\ExportData\Registry\Adapter\AdapterInterface;
use FactorioItemBrowser\ExportData\Registry\ContentRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ContentRegistry class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Registry\ContentRegistry
 */
class ContentRegistryTest extends TestCase
{
    /**
     * Tests the set method.
     * @covers ::set
     */
    public function testSet(): void
    {
        $hash = 'abc';
        $content = 'def';

        /* @var ContentRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(ContentRegistry::class)
                         ->setMethods(['saveContent'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('saveContent')
                 ->with($hash, $content);

        $registry->set($hash, $content);
    }

    /**
     * Tests the get method.
     * @covers ::get
     */
    public function testGet(): void
    {
        $hash = 'abc';
        $content = 'def';

        /* @var ContentRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(ContentRegistry::class)
                         ->setMethods(['loadContent'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('loadContent')
                 ->with($hash)
                 ->willReturn($content);

        $result = $registry->get($hash);
        $this->assertSame($content, $result);
    }

    /**
     * Tests the remove method.
     * @covers ::remove
     */
    public function testRemove(): void
    {
        $hash = 'abc';

        /* @var ContentRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(ContentRegistry::class)
                         ->setMethods(['deleteContent'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('deleteContent')
                 ->with($hash);

        $registry->remove($hash);
    }
    
    /**
     * Tests the getAllHashes method.
     * @covers ::getAllHashes
     */
    public function testGetAllHashes(): void
    {
        $namespace = 'abc';
        $hashes = ['def', 'ghi'];

        /* @var AdapterInterface|MockObject $adapter */
        $adapter = $this->getMockBuilder(AdapterInterface::class)
                        ->setMethods(['getAllHashes'])
                        ->getMockForAbstractClass();
        $adapter->expects($this->once())
                ->method('getAllHashes')
                ->with($namespace)
                ->willReturn($hashes);

        $registry = new ContentRegistry($adapter, $namespace);
        $result = $registry->getAllHashes();
        $this->assertSame($hashes, $result);
    }
}
