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
    protected const NAMESPACE = 'mods';

    /**
     * The hash to use for the file of the mods.
     */
    protected const HASH_FILE_MODS = '0000000000000000';

    /**
     * The mods of the registry.
     * @var array
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
        $this->mods[$mod->getName()] = $mod->writeData();
        $this->saveContent(self::HASH_FILE_MODS, (string) json_encode($this->mods));
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

        $result = null;
        if (isset($this->mods[$modName])) {
            $result = new Mod();
            $result->readData(new DataContainer($this->mods[$modName]));
        }
        return $result;
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

    /**
     * Loads the mods from the file.
     * @return $this
     */
    protected function loadMods()
    {
        if (!$this->isLoaded) {
            $this->mods = $this->decodeContent((string) $this->loadContent(self::HASH_FILE_MODS));
            $this->isLoaded = true;
        }
        return $this;
    }
}
