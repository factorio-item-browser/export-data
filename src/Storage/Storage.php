<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Storage;

use BluePsyduck\LaminasAutoWireFactory\Attribute\Alias;
use FactorioItemBrowser\ExportData\Constant\ServiceName;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializerInterface;
use ZipArchive;

/**
 * The class handling storing of data and files for a combination.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Storage
{
    private ?ZipArchive $zipArchive = null;

    public function __construct(
        #[Alias(ServiceName::SERIALIZER)]
        private readonly SerializerInterface $serializer,
        private readonly string $fileName,
    ) {
    }

    public function __destruct()
    {
        $this->close();
    }

    private function getZipArchive(): ZipArchive
    {
        if ($this->zipArchive === null) {
            $this->zipArchive = new ZipArchive();
            $this->zipArchive->open($this->fileName, ZipArchive::CREATE);
        }
        return $this->zipArchive;
    }

    /**
     * Returns the file name used by this storage instance.
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Writes additional data to the storage file.
     * @param string $name
     * @param mixed $data
     */
    public function writeData(string $name, $data): void
    {
        $contents = $this->serializer->serialize($data, 'json');
        $this->writeFile("{$name}.json", $contents);
    }

    /**
     * Write a (binary) file to the storage file.
     * @param string $name
     * @param string $contents
     * @param bool $compress
     */
    public function writeFile(string $name, string $contents, bool $compress = true): void
    {
        $zipArchive = $this->getZipArchive();
        $zipArchive->addFromString($name, $contents);

        if (!$compress) {
            $zipArchive->setCompressionName($name, ZipArchive::CM_STORE);
        }
    }

    /**
     * Reads additional data from the storage file.
     * @template T
     * @param string $name
     * @param class-string<T> $dataClass
     * @return T
     */
    public function readData(string $name, string $dataClass)
    {
        $context = new DeserializationContext();
        $context->setAttribute(self::class, $this);

        $contents = $this->readFile("{$name}.json");
        return $this->serializer->deserialize($contents, $dataClass, 'json', $context); // @phpstan-ignore-line
    }

    /**
     * Reads a (binary) file from the storage file.
     * @param string $name
     * @return string
     */
    public function readFile(string $name): string
    {
        return (string) $this->getZipArchive()->getFromName($name);
    }

    /**
     * Closes the storage file, writing all temporary changes to disk.
     */
    public function close(): void
    {
        if ($this->zipArchive !== null) {
            $this->zipArchive->close();
            $this->zipArchive = null;
        }
    }

    /**
     * Removes the storage file from the system.
     */
    public function remove(): void
    {
        $this->close();
        if (file_exists($this->fileName)) {
            unlink($this->fileName);
        }
    }
}
