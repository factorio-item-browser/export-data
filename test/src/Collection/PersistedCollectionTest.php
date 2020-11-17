<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Collection;

use FactorioItemBrowser\ExportData\Collection\PersistedCollection;
use FactorioItemBrowser\ExportData\Storage\Storage;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the PersistedCollection class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Collection\PersistedCollection
 */
class PersistedCollectionTest extends TestCase
{
    /**
     * @covers ::<public>
     */
    public function testSetAndGet(): void
    {
        $filePattern = 'foo/%s.txt';
        $fileName = 'abc';
        $contents = 'def';

        $storage = $this->createMock(Storage::class);
        $storage->expects($this->once())
                ->method('writeFile')
                ->with($this->identicalTo('foo/abc.txt'), $this->identicalTo($contents));
        $storage->expects($this->once())
                ->method('readFile')
                ->with($this->identicalTo('foo/abc.txt'))
                ->willReturn($contents);

        $instance = new PersistedCollection($storage, $filePattern);
        $instance->set($fileName, $contents);

        $result = $instance->get($fileName);
        $this->assertSame($contents, $result);
    }
}
