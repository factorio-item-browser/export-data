<?php

namespace FactorioItemBrowserTest\ExportData\Service;

use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Mod;
use FactorioItemBrowser\ExportData\Entity\Mod\Combination;
use FactorioItemBrowser\ExportData\Entity\Mod\CombinationData;
use FactorioItemBrowser\ExportData\Exception\ExportDataException;
use FactorioItemBrowser\ExportData\Service\ExportDataService;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the export data service class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass FactorioItemBrowser\ExportData\Service\ExportDataService
 */
class ExportDataServiceTest extends TestCase
{
    /**
     * Tests setting, getting and removing mods.
     */
    public function testSetGetAndRemoveMods()
    {
        $mod1 = new Mod();
        $mod1->setName('abc');
        $mod2 = new Mod();
        $mod2->setName('def');

        $service = new ExportDataService(vfsStream::setup('export')->url());

        $this->assertEquals([], $service->getMods());
        $this->assertEquals($service, $service->setMod($mod1));
        $this->assertEquals(['abc' => $mod1], $service->getMods());
        $this->assertEquals($mod1, $service->getMod('abc'));
        $this->assertNull($service->getMod('def'));

        $this->assertEquals($service, $service->setMod($mod2));
        $this->assertEquals(['abc' => $mod1, 'def' => $mod2], $service->getMods());
        $this->assertEquals($mod1, $service->getMod('abc'));
        $this->assertEquals($mod2, $service->getMod('def'));

        $this->assertEquals($service, $service->removeMod('abc'));
        $this->assertEquals(['def' => $mod2], $service->getMods());
        $this->assertNull($service->getMod('abc'));
        $this->assertEquals($mod2, $service->getMod('def'));
    }

    /**
     * Tests loading the mods.
     */
    public function testLoadMods()
    {
        $content = '[{"n":"abc","o":42},{"n":"def","o":21}]';
        $mod1 = new Mod();
        $mod1->setName('abc')
             ->setOrder(42);
        $mod2 = new Mod();
        $mod2->setName('def')
             ->setOrder(21);
        $expectedMods = [
            'def' => $mod2,
            'abc' => $mod1
        ];

        $directory = vfsStream::setup('export', null, ['mods/list.json' => $content]);
        $service = new ExportDataService($directory->url());

        $this->assertEquals($service, $service->loadMods());
        $this->assertEquals($expectedMods, $service->getMods());
        $this->assertEquals($mod2, current($service->getMods()));
    }

    /**
     * Tests saving the mods.
     */
    public function testSaveMods()
    {
        $mod1 = new Mod();
        $mod1->setName('abc')
             ->setOrder(42);
        $mod2 = new Mod();
        $mod2->setName('def')
             ->setOrder(21);

        $directory = vfsStream::setup('export');
        $service = new ExportDataService($directory->url());
        $expectedContent = '[{"n":"def","o":21},{"n":"abc","o":42}]';

        $service->setMod($mod1)
                ->setMod($mod2);

        $this->assertEquals($service, $service->saveMods());
        $this->assertTrue($directory->hasChild('mods/list.json'));
        $this->assertEquals($expectedContent, file_get_contents($directory->getChild('mods/list.json')->url()));
    }

    /**
     * Tests saving combination data.
     */
    public function testSaveCombinationData()
    {
        $item = new Item();
        $item->setName('abc');

        $combination = new Combination();
        $combination->setName('abc')
                    ->setMainModName('def');
        $combination->getData()->addItem($item);
        $content = '{"i":[{"n":"abc"}]}';

        $directory = vfsStream::setup('export');
        $service = new ExportDataService($directory->url());

        $this->assertEquals($service, $service->saveCombinationData($combination));
        $this->assertTrue($directory->hasChild('mods/def/abc.json'));
        $this->assertEquals($content, file_get_contents($directory->getChild('mods/def/abc.json')->url()));
    }

    /**
     * Tests loading combination data.
     */
    public function testLoadCombinationData()
    {
        $content = '{"i":[{"n":"abc"}]}';
        $combination = new Combination();
        $combination->setName('abc')
                    ->setMainModName('def');

        $item = new Item();
        $item->setName('abc');
        $expectedCombinationData = new CombinationData();
        $expectedCombinationData->addItem($item);

        $directory = vfsStream::setup('export', null, ['mods/def/abc.json' => $content]);
        $service = new ExportDataService($directory->url());

        $this->assertEquals($service, $service->loadCombinationData($combination));
        $this->assertEquals($expectedCombinationData, $combination->getData());
        $this->assertTrue($combination->getIsDataLoaded());
    }

    /**
     * Tests saving an icon.
     */
    public function testSaveIcon()
    {
        $iconHash = 'abcdef';
        $iconContent = 'foo';
        $directory = vfsStream::setup('export');
        $service = new ExportDataService($directory->url());

        $this->assertEquals($service, $service->saveIcon($iconHash, $iconContent));
        $this->assertTrue($directory->hasChild('icons/ab/abcdef.png'));
        $this->assertEquals($iconContent, file_get_contents($directory->getChild('icons/ab/abcdef.png')->url()));
    }

    /**
     * Tests loading an icon.
     */
    public function testLoadIcon()
    {
        $iconHash = 'abcdef';
        $iconContent = 'foo';
        $directory = vfsStream::setup('export', null, ['icons/ab/abcdef.png' => $iconContent]);
        $service = new ExportDataService($directory->url());

        $this->assertEquals($iconContent, $service->loadIcon($iconHash));
    }

    /**
     * Tests reading errors.
     */
    public function testReadError()
    {
        $directory = vfsStream::setup('export');
        $service = new ExportDataService($directory->url());

        $this->expectException(ExportDataException::class);
        $this->expectExceptionMessage('Unable to read file');

        $this->assertEquals('', $service->loadIcon('abcdef'));
    }

    /**
     * Provides the data for the writeError test.
     * @return array
     */
    public function provideWriteError(): array
    {
        return [
            [false, 'Unable to create directory'],
            [true, 'Unable to write file']
        ];
    }

    /**
     * Tests writing errors.
     * @param bool $withDirectory
     * @param string $expectedException
     * @dataProvider provideWriteError
     */
    public function testWriteError(bool $withDirectory, string $expectedException)
    {
        $directory = vfsStream::setup('export', 0400, []);
        if ($withDirectory) {
            $directory->addChild(vfsStream::newDirectory('icons/ab', 0400));
        }
        $service = new ExportDataService($directory->url());

        $this->expectException(ExportDataException::class);
        $this->expectExceptionMessage($expectedException);

        $this->assertEquals($service, $service->saveIcon('abcdef', 'fail'));
        $this->assertFalse($directory->hasChild('icons/ab/abcdef.png'));
    }
}
