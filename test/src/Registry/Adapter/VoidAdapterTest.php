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
     * Tests the save and load method.
     * @covers ::save
     * @covers ::load
     */
    public function testSaveAndLoad(): void
    {
        $namespace = 'abc';
        $hash = 'def';
        
        $adapter = new VoidAdapter();
        $adapter->save($namespace, $hash, 'ghi');

        $result = $adapter->load($namespace, $hash);
        $this->assertNull($result);
    }
    
    /**
     * Tests the getAllHashes method.
     * @covers ::getAllHashes
     */
    public function testGetAllHashes(): void
    {
        $namespace = 'abc';
        $expectedResult = [];

        $adapter = new VoidAdapter();
        $result = $adapter->getAllHashes($namespace);
        $this->assertSame($expectedResult, $result);
    }
}
