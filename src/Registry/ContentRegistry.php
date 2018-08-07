<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Registry;

/**
 * The registry holding the raw content strings.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ContentRegistry extends AbstractRegistry
{
    /**
     * Sets content into the registry.
     * @param string $hash
     * @param string $content
     * @return $this
     */
    public function set(string $hash, string $content)
    {
        $this->saveContent($hash, $content);
        return $this;
    }

    /**
     * Returns content from the registry.
     * @param string $hash
     * @return string|null
     */
    public function get(string $hash): ?string
    {
        return $this->loadContent($hash);
    }

    /**
     * Returns all known hashes from the registry.
     * @return array|string[]
     */
    public function getAllHashes(): array
    {
        return $this->adapter->getAllHashes($this->namespace);
    }
}
