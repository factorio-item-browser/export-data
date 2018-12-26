<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Registry;

use FactorioItemBrowser\ExportData\Registry\Adapter\AdapterInterface;

/**
 * The abstract class of the registry implementations.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
abstract class AbstractRegistry
{
    /**
     * The adapter to persist the data.
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * The namespace of the registry to use in the adapter.
     * @var string
     */
    protected $namespace;

    /**
     * The internal cache of the registry.
     * @var array|string[]|null[]
     */
    protected $cache = [];

    /**
     * Initializes the registry.
     * @param AdapterInterface $adapter
     * @param string $namespace
     */
    public function __construct(AdapterInterface $adapter, string $namespace)
    {
        $this->adapter = $adapter;
        $this->namespace = $namespace;
    }

    /**
     * Saves the specified content into the registry.
     * @param string $hash
     * @param string $content
     */
    protected function saveContent(string $hash, string $content): void
    {
        $this->adapter->save($this->namespace, $hash, $content);
        $this->cache[$hash] = $content;
    }

    /**
     * Loads the content with the specified hash from the registry.
     * @param string $hash
     * @return string|null
     */
    protected function loadContent(string $hash): ?string
    {
        if (!array_key_exists($hash, $this->cache)) {
            $content = $this->adapter->load($this->namespace, $hash);
            $this->cache[$hash] = is_string($content) ? $content : null;
        }
        return $this->cache[$hash];
    }

    /**
     * Deletes the content with the specified hash from the registry.
     * @param string $hash
     */
    protected function deleteContent(string $hash): void
    {
        $this->adapter->delete($this->namespace, $hash);
        unset($this->cache[$hash]);
    }

    /**
     * Encodes the specified content into a JSON string.
     * @param array $content
     * @return string
     */
    protected function encodeContent(array $content): string
    {
        return (string) json_encode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Decodes the specified JSON content.
     * @param string $content
     * @return array
     */
    protected function decodeContent(string $content): array
    {
        $result = json_decode($content, true);
        return is_array($result) ? $result : [];
    }
}
