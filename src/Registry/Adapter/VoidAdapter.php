<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Registry\Adapter;

/**
 * The adapter voiding all data it receives.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class VoidAdapter implements AdapterInterface
{
    /**
     * Saves the content under the specified hash.
     * @param string $namespace
     * @param string $hash
     * @param string $content
     * @return void
     */
    public function save(string $namespace, string $hash, string $content): void
    {
        return;
    }

    /**
     * Loads and returns the content of the specified hash, if available.
     * @param string $namespace
     * @param string $hash
     * @return string|null
     */
    public function load(string $namespace, string $hash): ?string
    {
        return null;
    }

    /**
     * Deletes the content under the specified hash.
     * @param string $namespace
     * @param string $hash
     */
    public function delete(string $namespace, string $hash): void
    {
        return;
    }

    /**
     * Returns all hashes currently known to the adapter.
     * @param string $namespace
     * @return array|string[]
     */
    public function getAllHashes(string $namespace): array
    {
        return [];
    }
}
