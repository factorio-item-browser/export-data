<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData;

use FactorioItemBrowser\ExportData\Entity\Combination;
use FactorioItemBrowser\ExportData\Storage\StorageFactoryInterface;

/**
 * The main service managing the export data.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ExportDataService
{
    /**
     * The storage factory.
     * @var StorageFactoryInterface
     */
    protected $storageFactory;

    /**
     * Initializes the export data service.
     * @param StorageFactoryInterface $storageFactory
     */
    public function __construct(StorageFactoryInterface $storageFactory)
    {
        $this->storageFactory = $storageFactory;
    }

    /**
     * Creates a new export data instance for the specified combination.
     * @param string $combinationId
     * @return ExportData
     */
    public function createExport(string $combinationId): ExportData
    {
        $combination = new Combination();
        $combination->setId($combinationId);

        return new ExportData($combination, $this->storageFactory->createForCombination($combinationId));
    }

    /**
     * Loads the export data of the specified combination.
     * @param string $combinationId
     * @return ExportData
     */
    public function loadExport(string $combinationId): ExportData
    {
        $storage = $this->storageFactory->createForCombination($combinationId);

        return new ExportData($storage->load(), $storage);
    }
}
