<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\TranslationDictionary;
use FactorioItemBrowser\ExportData\Entity\LocalisedEntity;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the LocalisedEntity class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\Entity\LocalisedEntity
 */
class LocalisedEntityTest extends TestCase
{
    public function testConstruct(): void
    {
        $instance = $this->getMockBuilder(LocalisedEntity::class)
                         ->getMockForAbstractClass();

        $this->assertNull($instance->localisedName);
        $this->assertNull($instance->localisedDescription);
        $this->assertInstanceOf(TranslationDictionary::class, $instance->labels);
        $this->assertInstanceOf(TranslationDictionary::class, $instance->descriptions);
    }
}
