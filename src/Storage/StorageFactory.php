<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Storage;

use JMS\Serializer\SerializerInterface;

/**
 * The factory for creating the storage instances.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class StorageFactory
{
    private SerializerInterface $exportDataSerializer;
    private string $exportDataWorkingDirectory;

    /** @var array<string, Storage> */
    private array $instances = [];

    public function __construct(
        SerializerInterface $exportDataSerializer,
        string $exportDataWorkingDirectory
    ) {
        $this->exportDataSerializer = $exportDataSerializer;
        $this->exportDataWorkingDirectory = $exportDataWorkingDirectory;
    }

    /**
     * Creates the storage to use for the combination with the specified id.
     * @param string $combinationId
     * @return Storage
     */
    public function createForCombination(string $combinationId): Storage
    {
        if (!isset($this->instances[$combinationId])) {
            $this->instances[$combinationId] = new Storage(
                $this->exportDataSerializer,
                sprintf('%s/%s.zip', $this->exportDataWorkingDirectory, $combinationId),
            );
        }

        return $this->instances[$combinationId];
    }
}
