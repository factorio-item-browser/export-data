<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Storage;

use FactorioItemBrowser\ExportData\ExportData;
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
    private ?ZipArchive $zipArchive = null;

    public function __construct(SerializerInterface $exportDataSerializer, string $fileName)
    {
        $this->exportDataSerializer = $exportDataSerializer;
        $this->fileName = $fileName;
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
     * Writes the meta data of the export to the storage file.
     * @param ExportData $exportData
     */
    public function writeMeta(ExportData $exportData): void
    {
        $this->writeData('meta', $exportData);
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
        $this->getZipArchive()->addFromString($name, $contents);
    }

    /**
     * Reads the meta data from the storage file.
     * @return ExportData
     */
    public function readMeta(): ExportData
    {
        $context = new DeserializationContext();
        $context->setAttribute(self::class, $this)
                ->setAttribute(ExportData::class, new ExportData($this, ''));

        $contents = $this->readFile("meta.json");
        return $this->exportDataSerializer->deserialize($contents, ExportData::class, 'json', $context);
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
        return (string) $this->getZipArchive()->getFromName($name);
    }

    /**
     * Closes any still open handles to the storage file.
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
