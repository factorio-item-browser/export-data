<?php

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
 * @coversDefaultClass FactorioItemBrowser\ExportData\Entity\LocalisedString
 */
class LocalisedStringTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $localisedString = new LocalisedString();
        $this->assertEquals([], $localisedString->getTranslations());
    }

    /**
     * Tests the cloning.
     */
    public function testClone()
    {
        $localisedString = new LocalisedString();
        $localisedString->setTranslation('en', 'foo');

        $clonedLocalisedString = clone($localisedString);
        $localisedString->setTranslation('en', 'oof');

        $this->assertEquals('foo', $clonedLocalisedString->getTranslation('en'));
    }

    /**
     * Tests setting and getting the translations.
     */
    public function testSetAndGetTranslations()
    {
        $localisedString = new LocalisedString();
        $this->assertEquals($localisedString, $localisedString->setTranslation('en', 'foo'));
        $this->assertEquals($localisedString, $localisedString->setTranslation('de', 'bar'));
        $this->assertEquals($localisedString, $localisedString->setTranslation('cz', 'baz'));
        $this->assertEquals($localisedString, $localisedString->setTranslation('cz', ''));

        $this->assertEquals(['en' => 'foo', 'de' => 'bar'], $localisedString->getTranslations());
        $this->assertEquals('foo', $localisedString->getTranslation('en'));
        $this->assertEquals('bar', $localisedString->getTranslation('de'));
        $this->assertEquals('', $localisedString->getTranslation('jp'));
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
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(LocalisedString $localisedString, array $expectedData)
    {
        $data = $localisedString->writeData();
        $this->assertEquals($expectedData, $data);

        $newLocalisedString = new LocalisedString();
        $this->assertEquals($newLocalisedString, $newLocalisedString->readData(new DataContainer($data)));
        $this->assertEquals($newLocalisedString, $localisedString);
    }
}
