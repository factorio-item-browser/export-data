<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Storage;

use BluePsyduck\LaminasAutoWireFactory\Attribute\Alias;
use BluePsyduck\LaminasAutoWireFactory\Attribute\ReadConfig;
use FactorioItemBrowser\ExportData\Constant\ConfigKey;
use FactorioItemBrowser\ExportData\Constant\ServiceName;
use JMS\Serializer\SerializerInterface;

/**
 * The factory for creating the storage instances.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class StorageFactory
{
    /** @var array<string, Storage> */
    private array $instances = [];

    public function __construct(
        #[Alias(ServiceName::SERIALIZER)]
        private readonly SerializerInterface $serializer,
        #[ReadConfig(ConfigKey::MAIN, ConfigKey::WORKING_DIRECTORY)]
        private readonly string $workingDirectory,
    ) {
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
                $this->serializer,
                sprintf('%s/%s.zip', $this->workingDirectory, $combinationId),
            );
        }

        return $this->instances[$combinationId];
    }
}
