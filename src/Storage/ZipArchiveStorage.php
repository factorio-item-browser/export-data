<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Storage;

use Exception;
use FactorioItemBrowser\ExportData\Entity\Combination;
use JMS\Serializer\SerializerInterface;
use ZipArchive;

/**
 * The implementation of a combination storage utilizing a zip archive.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ZipArchiveStorage implements StorageInterface
{
    /**
     * The filename used for the serialized data.
     */
    protected const DATA_FILENAME = 'data.json';

    /**
     * The filename used for the icons.
     */
    protected const ICON_FILENAME = 'icons/%s.png';

    /**
     * The serializer.
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * The file name to use.
     * @var string
     */
    protected $fileName;

    /**
     * The zip archive the storage is working on.
     * @var ZipArchive|null
     */
    protected $zipArchive;

    /**
     * Initializes the combination storage.
     * @param SerializerInterface $serializer
     * @param string $fileName
     */
    public function __construct(SerializerInterface $serializer, string $fileName)
    {
        $this->serializer = $serializer;
        $this->fileName = $fileName;
    }

    /**
     * Finalizes the combination storage.
     */
    public function __destruct()
    {
        $this->closeZipArchive();
    }

    /**
     * Returns the zip archive instance to work on, and creates it if it not yet existing.
     * @return ZipArchive
     */
    protected function getZipArchive(): ZipArchive
    {
        if ($this->zipArchive === null) {
            $this->zipArchive = new ZipArchive();
            $this->zipArchive->open($this->fileName, ZipArchive::CREATE);
        }

        return $this->zipArchive;
    }

    /**
     * Closes the zip archive if it has been opened.
     */
    protected function closeZipArchive(): void
    {
        if ($this->zipArchive !== null) {
            $this->zipArchive->close();
            $this->zipArchive = null;
        }
    }

    /**
     * Adds a rendered icon to the storage.
     * @param string $iconId
     * @param string $contents
     */
    public function addRenderedIcon(string $iconId, string $contents): void
    {
        $this->getZipArchive()->addFromString($this->getRenderedIconFileName($iconId), $contents);
    }

    /**
     * Returns a rendered icon from the storage.
     * @param string $iconId
     * @return string
     */
    public function getRenderedIcon(string $iconId): string
    {
        return (string) $this->getZipArchive()->getFromName($this->getRenderedIconFileName($iconId));
    }

    /**
     * Returns the filename to use for the rendered icon.
     * @param string $iconId
     * @return string
     */
    protected function getRenderedIconFileName(string $iconId): string
    {
        return sprintf(self::ICON_FILENAME, $iconId);
    }

    /**
     * Saves the combination data to the storage.
     * @param Combination $combination
     * @return string The filename used for the file.
     */
    public function save(Combination $combination): string
    {
        $serializedData = $this->serializer->serialize($combination, 'json');
        $this->getZipArchive()->addFromString(self::DATA_FILENAME, $serializedData);
        $this->closeZipArchive();

        return $this->fileName;
    }

    /**
     * Loads the combination data from the storage if it has been persisted before.
     */
    public function load(): Combination
    {
        $result = new Combination();

        $serializedData = (string) $this->getZipArchive()->getFromName(self::DATA_FILENAME);
        if ($serializedData !== '') {
            try {
                $result = $this->serializer->deserialize($serializedData, Combination::class, 'json');
            } catch (Exception $e) {
                // Nothing to do.
            }
        }
        return $result;
    }

    /**
     * Removes all persisted data from the storage.
     */
    public function remove(): void
    {
        $this->closeZipArchive();

        if (file_exists($this->fileName)) {
            unlink($this->fileName);
        }
    }
}
