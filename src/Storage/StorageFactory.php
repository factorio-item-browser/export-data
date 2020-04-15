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
class StorageFactory implements StorageFactoryInterface
{
    /**
     * The serializer.
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * The working directory to save the exports to.
     * @var string
     */
    protected $workingDirectory;

    /**
     * StorageFactory constructor.
     * @param SerializerInterface $exportDataSerializer
     * @param string $exportDataWorkingDirectory
     */
    public function __construct(SerializerInterface $exportDataSerializer, string $exportDataWorkingDirectory)
    {
        $this->serializer = $exportDataSerializer;
        $this->workingDirectory = $exportDataWorkingDirectory;
    }

    /**
     * Creates the storage to use for the specified combination id.
     * @param string $combinationId
     * @return StorageInterface
     */
    public function createForCombination(string $combinationId): StorageInterface
    {
        return new ZipArchiveStorage(
            $this->serializer,
            sprintf('%s/%s.zip', $this->workingDirectory, $combinationId)
        );
    }
}
