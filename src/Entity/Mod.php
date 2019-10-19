<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

/**
 * The entity representing a mod.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Mod
{
    /**
     * The name of the mod.
     * @var string
     */
    protected $name = '';

    /**
     * The localised titles of the mod.
     * @var LocalisedString
     */
    protected $titles;

    /**
     * The localised descriptions of the mod.
     * @var LocalisedString
     */
    protected $descriptions;

    /**
     * The author of the mod.
     * @var string
     */
    protected $author = '';

    /**
     * The version of the mod.
     * @var string
     */
    protected $version = '';

    /**
     * The id of the mod thumbnail.
     * @var string
     */
    protected $thumbnailId = '';

    /**
     * Initializes the mod.
     */
    public function __construct()
    {
        $this->titles = new LocalisedString();
        $this->descriptions = new LocalisedString();
    }

    /**
     * Sets the name of the mod.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the mod.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the localised titles of the mod.
     * @param LocalisedString $titles
     * @return $this Implementing fluent interface.
     */
    public function setTitles(LocalisedString $titles): self
    {
        $this->titles = $titles;
        return $this;
    }

    /**
     * Returns the localised titles of the mod.
     * @return LocalisedString
     */
    public function getTitles(): LocalisedString
    {
        return $this->titles;
    }

    /**
     * Sets the localised descriptions of the mod.
     * @param LocalisedString $descriptions
     * @return $this Implementing fluent interface.
     */
    public function setDescriptions(LocalisedString $descriptions): self
    {
        $this->descriptions = $descriptions;
        return $this;
    }

    /**
     * Returns the localised descriptions of the mod.
     * @return LocalisedString
     */
    public function getDescriptions(): LocalisedString
    {
        return $this->descriptions;
    }

    /**
     * Sets the author of the mod.
     * @param string $author
     * @return $this Implementing fluent interface.
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Returns the author of the mod.
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Sets the version of the mod.
     * @param string $version
     * @return $this Implementing fluent interface.
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Returns the version of the mod.
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Sets the id of the mod thumbnail.
     * @param string $thumbnailId
     * @return $this
     */
    public function setThumbnailId(string $thumbnailId): self
    {
        $this->thumbnailId = $thumbnailId;
        return $this;
    }

    /**
     * Returns the id of the mod thumbnail.
     * @return string
     */
    public function getThumbnailId(): string
    {
        return $this->thumbnailId;
    }
}
