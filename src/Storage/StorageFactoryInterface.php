<?php

declare(strict_types=1);

/**
 * The interface for the storage factory.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace FactorioItemBrowser\ExportData\Storage;

/**
 * The factory for creating the storage instances.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface StorageFactoryInterface
{
    /**
     * Creates the storage to use for the specified combination hash.
     * @param string $combinationHash
     * @return StorageInterface
     */
    public function createForCombination(string $combinationHash): StorageInterface;
}
