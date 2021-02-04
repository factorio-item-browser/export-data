<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Collection;

use FactorioItemBrowser\ExportData\Collection\FileDictionary;
use FactorioItemBrowser\ExportData\Storage\Storage;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the FileDictionary class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\Collection\FileDictionary
 */
class FileDictionaryTest extends TestCase
{
    public function testSetAndGet(): void
    {
        $filePattern = 'foo/%s.txt';
        $fileName = 'abc';
        $compressFiles = false;
        $contents = 'def';

        $storage = $this->createMock(Storage::class);
        $storage->expects($this->once())
                ->method('writeFile')
                ->with($this->identicalTo('foo/abc.txt'), $this->identicalTo($contents), $this->isFalse());
        $storage->expects($this->once())
                ->method('readFile')
                ->with($this->identicalTo('foo/abc.txt'))
                ->willReturn($contents);

        $instance = new FileDictionary($storage, $filePattern, $compressFiles);
        $instance->set($fileName, $contents);

        $result = $instance->get($fileName);
        $this->assertSame($contents, $result);

        $this->assertEquals([], iterator_to_array($instance));
    }
}
