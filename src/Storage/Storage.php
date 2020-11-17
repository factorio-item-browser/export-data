<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Storage;

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
    private SerializerInterface $exportDataSerializer;
    private string $fileName;

    public function __construct(SerializerInterface $exportDataSerializer, string $fileName)
    {
        $this->exportDataSerializer = $exportDataSerializer;
        $this->fileName = $fileName;
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
        $contents = $this->exportDataSerializer->serialize($data, 'json');
        $this->writeFile("{$name}.json", $contents);
    }

    /**
     * Write a (binary) file to the storage file.
     * @param string $name
     * @param string $contents
     */
    public function writeFile(string $name, string $contents): void
    {
        try {
            $zipArchive = new ZipArchive();
            $zipArchive->open($this->fileName, ZipArchive::CREATE);
            $zipArchive->addFromString($name, $contents);
        } finally {
            $zipArchive->close();
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
        return $this->exportDataSerializer->deserialize($contents, $dataClass, 'json', $context);
    }

    /**
     * Reads a (binary) file from the storage file.
     * @param string $name
     * @return string
     */
    public function readFile(string $name): string
    {
        try {
            $zipArchive = new ZipArchive();
            $zipArchive->open($this->fileName, ZipArchive::CREATE);
            return (string) $zipArchive->getFromName($name);
        } finally {
            $zipArchive->close();
        }
    }

    /**
     * Removes the storage file from the system.
     */
    public function remove(): void
    {
        if (file_exists($this->fileName)) {
            unlink($this->fileName);
        }
    }
}
