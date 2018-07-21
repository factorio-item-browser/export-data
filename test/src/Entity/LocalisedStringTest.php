<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\LocalisedString;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the localised string class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\LocalisedString
 */
class LocalisedStringTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $localisedString = new LocalisedString();
        $this->assertSame([], $localisedString->getTranslations());
    }

    /**
     * Tests the cloning.
     * @coversNothing
     */
    public function testClone()
    {
        $localisedString = new LocalisedString();
        $localisedString->setTranslation('en', 'foo');

        $clonedLocalisedString = clone($localisedString);
        $localisedString->setTranslation('en', 'oof');

        $this->assertSame('foo', $clonedLocalisedString->getTranslation('en'));
    }

    /**
     * Tests setting and getting the translations.
     * @covers ::setTranslation
     * @covers ::getTranslations
     * @covers ::setTranslation
     * @covers ::getTranslation
     */
    public function testSetAndGetTranslations()
    {
        $localisedString = new LocalisedString();
        $this->assertSame($localisedString, $localisedString->setTranslation('en', 'foo'));
        $this->assertSame($localisedString, $localisedString->setTranslation('de', 'bar'));
        $this->assertSame($localisedString, $localisedString->setTranslation('cz', 'baz'));
        $this->assertSame($localisedString, $localisedString->setTranslation('cz', ''));

        $this->assertSame(['en' => 'foo', 'de' => 'bar'], $localisedString->getTranslations());
        $this->assertSame('foo', $localisedString->getTranslation('en'));
        $this->assertSame('bar', $localisedString->getTranslation('de'));
        $this->assertSame('', $localisedString->getTranslation('jp'));
    }

    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $localisedString = new LocalisedString();
        $localisedString->setTranslation('en', 'abc')
                        ->setTranslation('de', 'def');

        $data = [
            'en' => 'abc',
            'de' => 'def'
        ];

        return [
            [$localisedString, $data],
            [new LocalisedString(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param LocalisedString $localisedString
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(LocalisedString $localisedString, array $expectedData)
    {
        $data = $localisedString->writeData();
        $this->assertEquals($expectedData, $data);

        $newLocalisedString = new LocalisedString();
        $this->assertSame($newLocalisedString, $newLocalisedString->readData(new DataContainer($data)));
        $this->assertEquals($newLocalisedString, $localisedString);
    }
}
