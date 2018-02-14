<?php

namespace FactorioItemBrowserTest\ExportData\Entity;

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
}
