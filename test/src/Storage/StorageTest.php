<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Storage;

use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Storage\Storage;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Storage class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\Storage\Storage
 */
class StorageTest extends TestCase
{
    /** @var SerializerInterface&MockObject */
    private SerializerInterface $exportDataSerializer;
    private string $fileName;

    protected function setUp(): void
    {
        $this->exportDataSerializer = $this->createMock(SerializerInterface::class);
        $this->fileName = (string) tempnam(sys_get_temp_dir(), 'test');
        unlink($this->fileName); // tempnam() is already creating the file. We don't want to ahve it yet.
    }

    protected function tearDown(): void
    {
        if (file_exists($this->fileName)) {
            unlink($this->fileName);
        }
    }

    private function createInstance(): Storage
    {
        return new Storage($this->exportDataSerializer, $this->fileName);
    }

    public function testConstruct(): void
    {
        $instance = $this->createInstance();
        $this->assertSame($this->fileName, $instance->getFileName());

        $instance->writeFile('foo', 'bar');
        $instance->close();
        $this->assertTrue(file_exists($this->fileName));

        $instance->remove();
        $this->assertFalse(file_exists($this->fileName));
    }

    public function testWriteAndReadData(): void
    {
        $item = new Item();
        $item->type = 'abc';
        $item->name = 'def';
        $serializedItem = '{"type":"abc","name":"def"}';

        $this->exportDataSerializer->expects($this->once())
                                   ->method('serialize')
                                   ->with($this->identicalTo($item), $this->identicalTo('json'))
                                   ->willReturn($serializedItem);
        $this->exportDataSerializer->expects($this->once())
                                   ->method('deserialize')
                                   ->with(
                                       $this->identicalTo($serializedItem),
                                       $this->identicalTo(Item::class),
                                       $this->identicalTo('json'),
                                   )
                                   ->willReturn($item);

        $instance = $this->createInstance();
        $instance->writeData('foo.json', $item);
        $instance->close();

        $result = $instance->readData('foo.json', Item::class);
        $this->assertSame($item, $result);
    }

    public function testWriteAndReadFile(): void
    {
        $name1 = 'abc.txt';
        $contents1 = 'def';
        $name2 = 'ghi.png';
        $contents2 = 'jkl';

        $instance = $this->createInstance();
        $instance->writeFile($name1, $contents1, true);
        $instance->writeFile($name2, $contents2, false);
        $instance->close();

        $this->assertSame($contents1, $instance->readFile($name1));
        $this->assertSame($contents2, $instance->readFile($name2));
    }
}
