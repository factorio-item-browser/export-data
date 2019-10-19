<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\LocalisedString;
use FactorioItemBrowser\ExportData\Entity\Mod;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the mod class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Mod
 */
class ModTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $mod = new Mod();

        $this->assertSame('', $mod->getName());
        $this->assertSame('', $mod->getAuthor());
        $this->assertSame('', $mod->getVersion());
        $this->assertSame('', $mod->getThumbnailId());

        // Asserted through type-hints
        $mod->getTitles();
        $mod->getDescriptions();
    }

    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $mod = new Mod();

        $this->assertSame($mod, $mod->setName($name));
        $this->assertSame($name, $mod->getName());
    }

    /**
     * Tests setting and getting the titles.
     * @covers ::setTitles
     * @covers ::getTitles
     */
    public function testSetAndGetTitles(): void
    {
        /* @var LocalisedString&MockObject $titles */
        $titles = $this->createMock(LocalisedString::class);
        $mod = new Mod();

        $this->assertSame($mod, $mod->setTitles($titles));
        $this->assertSame($titles, $mod->getTitles());
    }

    /**
     * Tests setting and getting the descriptions.
     * @covers ::setDescriptions
     * @covers ::getDescriptions
     */
    public function testSetAndGetDescriptions(): void
    {
        /* @var LocalisedString&MockObject $descriptions */
        $descriptions = $this->createMock(LocalisedString::class);
        $mod = new Mod();

        $this->assertSame($mod, $mod->setDescriptions($descriptions));
        $this->assertSame($descriptions, $mod->getDescriptions());
    }

    /**
     * Tests the setting and getting the author.
     * @covers ::getAuthor
     * @covers ::setAuthor
     */
    public function testSetAndGetAuthor(): void
    {
        $author = 'abc';
        $mod = new Mod();

        $this->assertSame($mod, $mod->setAuthor($author));
        $this->assertSame($author, $mod->getAuthor());
    }

    /**
     * Tests the setting and getting the version.
     * @covers ::getVersion
     * @covers ::setVersion
     */
    public function testSetAndGetVersion(): void
    {
        $version = 'abc';
        $mod = new Mod();

        $this->assertSame($mod, $mod->setVersion($version));
        $this->assertSame($version, $mod->getVersion());
    }

    /**
     * Tests the setting and getting the thumbnail id.
     * @covers ::getThumbnailId
     * @covers ::setThumbnailId
     */
    public function testSetAndGetThumbnailId(): void
    {
        $thumbnailId = 'abc';
        $mod = new Mod();

        $this->assertSame($mod, $mod->setThumbnailId($thumbnailId));
        $this->assertSame($thumbnailId, $mod->getThumbnailId());
    }
}
