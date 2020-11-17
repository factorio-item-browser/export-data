<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData;

use Exception;
use FactorioItemBrowser\ExportData\Storage\StorageFactory;

/**
 * The main service managing the export data.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ExportDataService
{
    private StorageFactory $storageFactory;

    public function __construct(
        StorageFactory $storageFactory
    ) {
        $this->storageFactory = $storageFactory;
    }

    /**
     * Creates a new export data instance for the specified combination. This will remove any existing data for that
     * combination.
     * @param string $combinationId
     * @return ExportData
     */
    public function createExport(string $combinationId): ExportData
    {
        $storage = $this->storageFactory->createForCombination($combinationId);
        $storage->remove();
        return new ExportData($storage, $combinationId);
    }

    /**
     * Loads the export data of the specified combination.
     * @param string $combinationId
     * @return ExportData
     */
    public function loadExport(string $combinationId): ExportData
    {
        $storage = $this->storageFactory->createForCombination($combinationId);
        try {
            return $storage->readData('meta', ExportData::class);
        } catch (Exception $e) {
            return new ExportData($storage, $combinationId);
        }
    }

    /**
     * Persists the export and all its data which have not been persisted.
     * @param ExportData $exportData
     * @return string
     */
    public function persistExport(ExportData $exportData): string
    {
        $storage = $this->storageFactory->createForCombination($exportData->getCombinationId());
        $storage->writeData('meta', $exportData);
        return $storage->getFileName();
    }

    /**
     * Removes the export with the specified combination, if it exists.
     * @param string $combinationId
     */
    public function removeExport(string $combinationId): void
    {
        $storage = $this->storageFactory->createForCombination($combinationId);
        $storage->remove();
    }
}
