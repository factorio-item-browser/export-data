<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Registry\Adapter;

use FactorioItemBrowser\ExportData\Exception\ExportDataException;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

/**
 * The adapter implementation based on the file system.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class FileSystemAdapter implements AdapterInterface
{
    /**
     * The directory to use for persisting the data.
     * @var string
     */
    protected $directory;

    /**
     * Initializes the filesystem adapter.
     * @param string $directory
     */
    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    /**
     * Saves the content under the specified hash.
     * @param string $namespace
     * @param string $hash
     * @param string $content
     * @return void
     * @throws ExportDataException
     */
    public function save(string $namespace, string $hash, string $content): void
    {
        $fileName = $this->getFileName($namespace, $hash);
        $this->ensureDirectory(dirname($fileName));

        $success = false;
        if (!file_exists($fileName) || is_readable($fileName)) {
            $success = file_put_contents($fileName, $content);
        }
        if ($success === false) {
            throw new ExportDataException('Unable to write file ' . $fileName);
        }
        return;
    }

    /**
     * Loads and returns the content of the specified hash, if available.
     * @param string $namespace
     * @param string $hash
     * @return string|null
     */
    public function load(string $namespace, string $hash): ?string
    {
        $result = null;
        $fileName = $this->getFileName($namespace, $hash);
        if (file_exists($fileName) && is_readable($fileName)) {
            $result = file_get_contents($fileName);
        }
        return is_string($result) ? $result : null;
    }

    /**
     * Returns the filename to use to save the content with the specified namespace and hash.
     * @param string $namespace
     * @param string $hash
     * @return string
     */
    protected function getFileName(string $namespace, string $hash): string
    {
        $fileName = implode(DIRECTORY_SEPARATOR, [
            $this->directory,
            $namespace,
            substr($hash, 0, 2),
            $hash
        ]);
        return $fileName;
    }

    /**
     * Ensures that the specified directory is available and writable.
     * @param string $directory
     * @return $this
     * @throws ExportDataException
     */
    protected function ensureDirectory(string $directory)
    {
        if (!is_dir($directory)) {
            $success = mkdir($directory, 0775, true);
            if (!$success) {
                throw new ExportDataException('Unable to create directory ' . $directory . '.');
            }
        }

        if (!is_writable($directory)) {
            throw new ExportDataException('Directory ' . $directory . ' is not writable.');
        }

        return $this;
    }

    /**
     * Returns all hashes currently known to the adapter.
     * @param string $namespace
     * @return array|string[]
     */
    public function getAllHashes(string $namespace): array
    {
        $directory = implode(DIRECTORY_SEPARATOR, [
            $this->directory,
            $namespace,
        ]);

        $result = [];
        if (is_dir($directory)) {
            $directoryIterator = new RecursiveDirectoryIterator(
                $directory,
                RecursiveDirectoryIterator::SKIP_DOTS
            );

            foreach (new RecursiveIteratorIterator($directoryIterator) as $file) {
                /* @var SplFileInfo $file */
                $result[] = $file->getFilename();
            }
        }
        return $result;
    }
}
