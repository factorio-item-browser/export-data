<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData;

use BluePsyduck\TestHelper\ReflectionTrait;
use FactorioItemBrowser\ExportData\Entity\Combination;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\ExportData;
use FactorioItemBrowser\ExportData\Storage\StorageInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the ExportData class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\ExportData
 */
class ExportDataTest extends TestCase
{
    use ReflectionTrait;

    /**
     * The mocked combination.
     * @var Combination&MockObject
     */
    protected $combination;

    /**
     * The mocked storage.
     * @var StorageInterface&MockObject
     */
    protected $storage;

    /**
     * Sets up the test case.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->combination = $this->createMock(Combination::class);
        $this->storage = $this->createMock(StorageInterface::class);
    }

    /**
     * Tests the constructing.
     * @covers ::__construct
     * @throws ReflectionException
     */
    public function testConstruct(): void
    {
        $exportData = new ExportData($this->combination, $this->storage);

        $this->assertSame($this->combination, $this->extractProperty($exportData, 'combination'));
        $this->assertSame($this->storage, $this->extractProperty($exportData, 'storage'));
    }

    /**
     * Tests the getCombination method.
     * @covers ::getCombination
     */
    public function testGetCombination(): void
    {
        $exportData = new ExportData($this->combination, $this->storage);
        $result = $exportData->getCombination();

        $this->assertSame($this->combination, $result);
    }

    /**
     * Tests the addRenderedIcon method.
     * @covers ::addRenderedIcon
     */
    public function testAddRenderedIcon(): void
    {
        $iconId = 'abc';
        $contents = 'def';

        /* @var Icon&MockObject $icon */
        $icon = $this->createMock(Icon::class);
        $icon->expects($this->once())
             ->method('getId')
             ->willReturn($iconId);

        $this->storage->expects($this->once())
                      ->method('addRenderedIcon')
                      ->with($this->identicalTo($iconId), $this->identicalTo($contents));

        $exportData = new ExportData($this->combination, $this->storage);
        $result = $exportData->addRenderedIcon($icon, $contents);

        $this->assertSame($exportData, $result);
    }

    /**
     * Tests the getRenderedIcon method.
     * @covers ::getRenderedIcon
     */
    public function testGetRenderedIcon(): void
    {
        $iconId = 'abc';
        $contents = 'def';

        /* @var Icon&MockObject $icon */
        $icon = $this->createMock(Icon::class);
        $icon->expects($this->once())
             ->method('getId')
             ->willReturn($iconId);

        $this->storage->expects($this->once())
                      ->method('getRenderedIcon')
                      ->with($this->identicalTo($iconId))
                      ->willReturn($contents);

        $exportData = new ExportData($this->combination, $this->storage);
        $result = $exportData->getRenderedIcon($icon);

        $this->assertSame($contents, $result);
    }

    /**
     * Tests the persist method.
     * @covers ::persist
     */
    public function testPersist(): void
    {
        $fileName = 'abc';

        $this->storage->expects($this->once())
                      ->method('save')
                      ->with($this->identicalTo($this->combination))
                      ->willReturn($fileName);

        $exportData = new ExportData($this->combination, $this->storage);
        $result = $exportData->persist();

        $this->assertSame($fileName, $result);
    }

    /**
     * Tests the remove method.
     * @covers ::remove
     */
    public function testRemove(): void
    {
        $this->storage->expects($this->once())
                      ->method('remove');


        $exportData = new ExportData($this->combination, $this->storage);
        $exportData->remove();
    }
}
