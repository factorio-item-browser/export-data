<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Storage;

use FactorioItemBrowser\ExportData\Entity\Combination;

/**
 * The interface for the storage implementations.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface StorageInterface
{
    /**
     * Adds a rendered icon to the storage.
     * @param string $iconHash
     * @param string $contents
     */
    public function addRenderedIcon(string $iconHash, string $contents): void;

    /**
     * Returns a rendered icon from the storage.
     * @param string $iconHash
     * @return string
     */
    public function getRenderedIcon(string $iconHash): string;

    /**
     * Saves the combination data to the storage.
     * @param Combination $combination
     * @return string The filename used for the file.
     */
    public function save(Combination $combination): string;

    /**
     * Loads the combination data from the storage if it has been persisted before.
     */
    public function load(): Combination;
}
