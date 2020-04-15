<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

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
    public function testConstruct(): void
    {
        $localisedString = new LocalisedString();
        $this->assertSame([], $localisedString->getTranslations());
    }

    /**
     * Tests setting and getting the translations.
     * @covers ::addTranslation
     * @covers ::getTranslations
     * @covers ::setTranslations
     */
    public function testSetAddAndGetTranslations(): void
    {
        $localisedString = new LocalisedString();

        $this->assertSame($localisedString, $localisedString->setTranslations(['en' => 'foo', 'de' => 'bar']));
        $this->assertSame(['en' => 'foo', 'de' => 'bar'], $localisedString->getTranslations());

        $this->assertSame($localisedString, $localisedString->addTranslation('cz', 'baz'));
        $this->assertSame(['en' => 'foo', 'de' => 'bar', 'cz' => 'baz'], $localisedString->getTranslations());
    }
}
