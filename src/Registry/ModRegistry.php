<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Registry;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Mod;
use FactorioItemBrowser\ExportData\Registry\Adapter\AdapterInterface;

/**
 * The registry holding the mods.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModRegistry extends AbstractRegistry
{
    /**
     * The namespace to use for the mods.
     */
    protected const NAMESPACE = 'mod';

    /**
     * The hash to use for the file of the mods.
     */
    protected const HASH_FILE_MODS = '0000000000000000';

    /**
     * The mods of the registry.
     * @var array|Mod[]
     */
    protected $mods = [];

    /**
     * Whether the mods have been loaded.
     * @var bool
     */
    protected $isLoaded = false;

    /**
     * Initializes the registry.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct($adapter, self::NAMESPACE);
    }

    /**
     * Sets a mod into the registry.
     * @param Mod $mod
     * @return $this
     */
    public function set(Mod $mod)
    {
        $this->loadMods();
        $this->mods[$mod->getName()] = $mod;
        $this->saveMods();
        return $this;
    }

    /**
     * Saves the currently known mod to the adapter.
     * @return $this
     */
    protected function saveMods()
    {
        $mods = [];
        foreach ($this->mods as $mod) {
            $mods[] = $mod->writeData();
        }
        $this->saveContent(self::HASH_FILE_MODS, $this->encodeContent($mods));
        return $this;
    }

    /**
     * Returns a mod from the registry.
     * @param string $modName
     * @return Mod|null
     */
    public function get(string $modName): ?Mod
    {
        $this->loadMods();
        return $this->mods[$modName] ?? null;
    }

    /**
     * Loads the mods from the file.
     * @return $this
     */
    protected function loadMods()
    {
        if (!$this->isLoaded) {
            $this->mods = [];
            foreach ($this->decodeContent((string) $this->loadContent(self::HASH_FILE_MODS)) as $modData) {
                if (is_array($modData)) {
                    $mod = new Mod();
                    $mod->readData(new DataContainer($modData));
                    $this->mods[$mod->getName()] = $mod;
                }
            }
            $this->isLoaded = true;
        }
        return $this;
    }

    /**
     * Returns the names of all mods.
     * @return array|string[]
     */
    public function getAllNames(): array
    {
        $this->loadMods();

        return array_keys($this->mods);
    }
}