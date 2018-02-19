<?php

namespace FactorioItemBrowser\ExportData\Service;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Constant\Path;
use FactorioItemBrowser\ExportData\Entity\Mod;
use FactorioItemBrowser\ExportData\Entity\Mod\Combination;
use FactorioItemBrowser\ExportData\Exception\ExportDataException;

/**
 * The main service class of the export data.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ExportDataService
{
    /**
     * The directory to save the export files to.
     * @var string
     */
    protected $exportDirectory;

    /**
     * The mods of the export directory.
     * @var array|Mod[]
     */
    protected $mods = [];

    /**
     * Initializes the export data service.
     * @param string $exportDirectory
     */
    public function __construct(string $exportDirectory)
    {
        $this->exportDirectory = $exportDirectory;
    }

    /**
     * Loads the mods from the export directory.
     * @return $this
     */
    public function loadMods()
    {
        $this->mods = [];
        $content = $this->readFile(Path::FILE_MODS_LIST, true);
        if (!empty($content)) {
            $data = new DataContainer(json_decode($content, true));
            foreach ($data->getObjectArray([]) as $modData) {
                $mod = new Mod();
                $mod->readData($modData);
                $this->mods[$mod->getName()] = $mod;
            }
        }
        return $this;
    }

    /**
     * Returns all loaded mods.
     * @return array|Mod[]
     */
    public function getMods(): array
    {
        return $this->mods;
    }

    /**
     * Returns the loaded mod with the specified name.
     * @param string $modName
     * @return Mod|null
     */
    public function getMod(string $modName): ?Mod
    {
        return $this->mods[$modName] ?? null;
    }

    /**
     * Sets the mod to be saved.
     * @param Mod $mod
     * @return $this
     */
    public function setMod(Mod $mod)
    {
        $this->mods[$mod->getName()] = $mod;
        return $this;
    }

    /**
     * Removes the mods from the list of mods.
     * @param string $modName
     * @return $this
     */
    public function removeMod(string $modName)
    {
        unset($this->mods[$modName]);
        return $this;
    }

    /**
     * Saves the mods to the export directory.
     * @return $this
     */
    public function saveMods()
    {
        $data = array_values(array_map(function(Mod $mod): array  {
            return $mod->writeData();
        }, $this->mods));
        $this->writeFile(Path::FILE_MODS_LIST, json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        return $this;
    }

    /**
     * Saves the specified combination to the export directory.
     * @param Combination $combination
     * @return $this
     */
    public function saveCombination(Combination $combination)
    {
        $path = $this->getCombinationPath($combination->getMainModName(), $combination->getName());
        $data = $combination->writeData();
        $this->writeFile($path, json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        return $this;
    }

    public function loadCombination(string $modName, string $combinationName): Combination
    {
        $path = $this->getCombinationPath($modName, $combinationName);
        $content = $this->readFile($path);
        $combination = new Combination();
        $combination->readData(new DataContainer(json_decode($content, true)));
        return $combination;
    }

    /**
     * Returns the path of the specified combination.
     * @param string $modName
     * @param string $combinationName
     * @return string
     */
    protected function getCombinationPath(string $modName, string $combinationName): string
    {
        return implode(DIRECTORY_SEPARATOR, [
            Path::DIRECTORY_MODS,
            $modName,
            $combinationName . '.json'
        ]);
    }

    /**
     * Saves the specified icon to the export directory.
     * @param string $iconHash
     * @param string $content
     * @return $this
     */
    public function saveIcon(string $iconHash, string $content)
    {
        $this->writeFile($this->getIconPath($iconHash), $content);
        return $this;
    }

    /**
     * Loads the icon with the specified hash from the export directory.
     * @param string $iconHash
     * @return string
     * @throws ExportDataException
     */
    public function loadIcon(string $iconHash): string
    {
        return $this->readFile($this->getIconPath($iconHash));
    }

    /**
     * Returns the path to the icon file with the specified hash.
     * @param string $iconHash
     * @return string
     */
    protected function getIconPath(string $iconHash): string
    {
        return implode(DIRECTORY_SEPARATOR, [
            Path::DIRECTORY_ICONS,
            substr($iconHash, 0, 2),
            substr($iconHash, 2, 2),
            $iconHash . '.png'
        ]);
    }

    /**
     * Reads the specified file.
     * @param string $fileName
     * @param bool $ignoreError
     * @return string
     * @throws ExportDataException
     */
    protected function readFile(string $fileName, bool $ignoreError = false): string
    {
        $fullPath = $this->exportDirectory . DIRECTORY_SEPARATOR . $fileName;
        $result = false;
        if (file_exists($fullPath)) {
            $result = file_get_contents($fullPath);
        }
        if ($result === false && !$ignoreError) {
            throw new ExportDataException('Unable to read file ' . $fileName);
        }
        return (string) $result;
    }

    /**
     * Writes the specified file.
     * @param string $fileName
     * @param string $content
     * @return $this
     * @throws ExportDataException
     */
    protected function writeFile(string $fileName, string $content)
    {
        $fullPath = $this->exportDirectory . DIRECTORY_SEPARATOR . $fileName;
        $directory = dirname($fullPath);
        if (!is_dir($directory)) {
            $result = mkdir($directory, 0775, true);
            if (!$result) {
                throw new ExportDataException('Unable to create directory ' . $directory);
            }
        }
        $result = false;
        if (is_writable($directory)) {
            $result = file_put_contents($fullPath, $content);
        }
        if ($result === false) {
            throw new ExportDataException('Unable to write file ' . $fileName);
        }
        return $this;
    }
}