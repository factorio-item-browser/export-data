<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Storage;

/**
 * The interface for the storage factory.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface StorageFactoryInterface
{
    /**
     * Creates the storage to use for the specified combination id.
     * @param string $combinationId
     * @return StorageInterface
     */
    public function createForCombination(string $combinationId): StorageInterface;
}
