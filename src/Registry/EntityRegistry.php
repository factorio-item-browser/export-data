<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Registry;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\EntityInterface;
use FactorioItemBrowser\ExportData\Registry\Adapter\AdapterInterface;

/**
 * The registry managing a single type of entities.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class EntityRegistry extends AbstractRegistry
{
    /**
     * The name of the entity class to use in the registry.
     * @var string
     */
    protected $entityClassName;

    /**
     * Initializes the registry.
     * @param AdapterInterface $adapter
     * @param string $entityClassName
     */
    public function __construct(AdapterInterface $adapter, string $entityClassName)
    {
        parent::__construct($adapter, $this->getNamespace($entityClassName));
        $this->entityClassName = $entityClassName;
    }

    /**
     * Returns the namespace to sue for the specified entity class.
     * @param string $entityClassName
     * @return string
     */
    protected function getNamespace(string $entityClassName): string
    {
        return strtolower(substr((string) strrchr($entityClassName, '\\'), 1));
    }

    /**
     * Sets the specified entity into the registry.
     * @param EntityInterface $entity
     * @return string The hash used to save the entity.
     */
    public function set(EntityInterface $entity): string
    {
        $hash = $entity->calculateHash();
        $content = $this->encodeContent($entity->writeData());
        $this->saveContent($hash, $content);
        return $hash;
    }

    /**
     * Returns the entity with the specified hash.
     * @param string $hash
     * @return EntityInterface|null
     */
    public function get(string $hash): ?EntityInterface
    {
        $result = null;
        $content = $this->loadContent($hash);
        if ($content !== null) {
            $result = $this->createEntityFromContent($content);
        }
        return $result;
    }

    /**
     * Removes the entity with the specified hash.
     * @param string $hash
     */
    public function remove(string $hash): void
    {
        $this->deleteContent($hash);
    }

    /**
     * Returns all known hashes from the registry.
     * @return array|string[]
     */
    public function getAllHashes(): array
    {
        return $this->adapter->getAllHashes($this->namespace);
    }

    /**
     * Creates an entity from the specified content.
     * @param string $content
     * @return EntityInterface
     */
    protected function createEntityFromContent(string $content): EntityInterface
    {
        $result = $this->createEntity();
        $result->readData(new DataContainer($this->decodeContent($content)));
        return $result;
    }

    /**
     * Creates a new entity of the registry.
     * @return EntityInterface
     */
    protected function createEntity(): EntityInterface
    {
        $className = $this->entityClassName;
        return new $className();
    }
}
