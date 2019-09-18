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
     * The serializer.
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * The zip archive the storage is working on.
     * @var ZipArchive
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
        $this->zipArchive = $this->createZipArchive($fileName);
    }

    /**
     * Finalizes the combination storage.
     */
    public function __destruct()
    {
        $this->zipArchive->close();
    }

    /**
     * Creates the zip archive instance to work on.
     * @param string $fileName
     * @return ZipArchive
     */
    protected function createZipArchive(string $fileName): ZipArchive
    {
        $result = new ZipArchive();
        $result->open($fileName, ZipArchive::CREATE);
        return $result;
    }

    /**
     * Adds a rendered icon to the storage.
     * @param string $iconHash
     * @param string $contents
     */
    public function addRenderedIcon(string $iconHash, string $contents): void
    {
        $this->zipArchive->addFromString($this->getRenderedIconFileName($iconHash), $contents);
    }

    /**
     * Returns a rendered icon from the storage.
     * @param string $iconHash
     * @return string
     */
    public function getRenderedIcon(string $iconHash): string
    {
        return (string) $this->zipArchive->getFromName($this->getRenderedIconFileName($iconHash));
    }

    /**
     * Returns the filename to use for the rendered icon.
     * @param string $iconHash
     * @return string
     */
    protected function getRenderedIconFileName(string $iconHash): string
    {
        return sprintf('icons/%s.png', $iconHash);
    }

    /**
     * Saves the combination data to the storage.
     * @param Combination $combination
     * @return string The filename used for the file.
     */
    public function save(Combination $combination): string
    {
        $serializedData = $this->serializer->serialize($combination, 'json');
        $this->zipArchive->addFromString('data.json', $serializedData);
        return $this->zipArchive->filename;
    }

    /**
     * Loads the combination data from the storage if it has been persisted before.
     */
    public function load(): Combination
    {
        $result = new Combination();

        $serializedData = (string) $this->zipArchive->getFromName('data.json');
        if ($serializedData !== '') {
            try {
                $result = $this->serializer->deserialize($serializedData, Combination::class, 'json');
            } catch (Exception $e) {
                // Nothing to do.
            }
        }
        return $result;
    }
}
