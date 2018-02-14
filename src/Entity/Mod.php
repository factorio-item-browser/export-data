<?php

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Mod\Dependency;

/**
 * The class representing a mod.
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
     * The filename of the mod.
     * @var string
     */
    protected $fileName = '';

    /**
     * The name of the root directory within the mod.
     * @var string
     */
    protected $directoryName = '';

    /**
     * The dependencies of the mod.
     * @var array|Dependency[]
     */
    protected $dependencies = [];

    /**
     * The checksum of the mod file.
     * @var string
     */
    protected $checksum = '';

    /**
     * The order of the mod in the full list.
     * @var int
     */
    protected $order = 0;

    /**
     * The names of the combinations of the mod.
     * @var array|string[]
     */
    protected $combinationNames = [];

    /**
     * Initializes the mod.
     */
    public function __construct()
    {
        $this->titles = new LocalisedString();
        $this->descriptions = new LocalisedString();
    }

    /**
     * Clones the mod.
     */
    public function __clone()
    {
        $this->titles = clone($this->titles);
        $this->descriptions = clone($this->descriptions);
        $this->dependencies = array_map(function (Dependency $dependency): Dependency {
            return clone($dependency);
        }, $this->dependencies);
    }

    /**
     * Sets the name of the mod.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name)
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
    public function setTitles(LocalisedString $titles)
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
    public function setDescriptions(LocalisedString $descriptions)
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
    public function setAuthor(string $author)
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
    public function setVersion(string $version)
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
     * Sets the filename of the mod.
     * @param string $fileName
     * @return $this Implementing fluent interface.
     */
    public function setFileName(string $fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * Returns the filename of the mod.
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Sets the name of the root directory within the mod.
     * @param string $directoryName
     * @return $this Implementing fluent interface.
     */
    public function setDirectoryName(string $directoryName)
    {
        $this->directoryName = $directoryName;
        return $this;
    }

    /**
     * Returns the name of the root directory within the mod.
     * @return string
     */
    public function getDirectoryName(): string
    {
        return $this->directoryName;
    }

    /**
     * Sets the dependencies of the mod.
     * @param array|Dependency[] $dependencies
     * @return $this Implementing fluent interface.
     */
    public function setDependencies(array $dependencies)
    {
        $this->dependencies = array_values(array_filter($dependencies, function ($dependency): bool {
            return $dependency instanceof Dependency;
        }));
        return $this;
    }

    /**
     * Adds a dependency to the mod.
     * @param Dependency $dependency
     * @return $this
     */
    public function addDependency(Dependency $dependency)
    {
        $this->dependencies[] = $dependency;
        return $this;
    }

    /**
     * Returns the dependencies of the mod.
     * @return array|Dependency[]
     */
    public function getDependencies(): array
    {
        return $this->dependencies;
    }

    /**
     * Sets the checksum of the mod file.
     * @param string $checksum
     * @return $this Implementing fluent interface.
     */
    public function setChecksum(string $checksum)
    {
        $this->checksum = $checksum;
        return $this;
    }

    /**
     * Returns the checksum of the mod file.
     * @return string
     */
    public function getChecksum(): string
    {
        return $this->checksum;
    }

    /**
     * Sets the order of the mod in the full list.
     * @param int $order
     * @return $this Implementing fluent interface.
     */
    public function setOrder(int $order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Returns the order of the mod in the full list.
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * Sets the names of the combinations of the mod.
     * @param array|string[] $combinationNames
     * @return $this Implementing fluent interface.
     */
    public function setCombinationNames(array $combinationNames)
    {
        $this->combinationNames = $combinationNames;
        return $this;
    }

    /**
     * Adds a combination name to the mod.
     * @param string $combinationName
     * @return $this
     */
    public function addCombinationName(string $combinationName)
    {
        $this->combinationNames[] = $combinationName;
        return $this;
    }

    /**
     * Returns the names of the combinations of the mod.
     * @return array|string[]
     */
    public function getCombinationNames(): array
    {
        return $this->combinationNames;
    }
}