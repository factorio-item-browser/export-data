<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Registry\Adapter;

use FactorioItemBrowser\ExportData\Registry\Adapter\VoidAdapter;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the VoidAdapter class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Registry\Adapter\VoidAdapter
 */
class VoidAdapterTest extends TestCase
{
    /**
     * Tests the save method.
     * @covers ::save
     */
    public function testSave()
    {
        $namespace = 'abc';
        $hash = 'def';
        $content = 'ghi';

        $adapter = new VoidAdapter();
        $adapter->save($namespace, $hash, $content);
        $this->assertTrue(true); // We have nothing to assert...
    }
    
    /**
     * Tests the load method.
     * @covers ::load
     */
    public function testLoad()
    {
        $namespace = 'abc';
        $hash = 'def';
        
        $adapter = new VoidAdapter();
        $result = $adapter->load($namespace, $hash);
        $this->assertNull($result);
    }
    
    /**
     * Tests the getAllHashes method.
     * @covers ::getAllHashes
     */
    public function testGetAllHashes()
    {
        $namespace = 'abc';
        $expectedResult = [];

        $adapter = new VoidAdapter();
        $result = $adapter->getAllHashes($namespace);
        $this->assertSame($expectedResult, $result);
    }
}
