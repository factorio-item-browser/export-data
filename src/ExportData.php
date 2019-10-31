<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData;

use FactorioItemBrowser\ExportData\Entity\Combination;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Storage\StorageInterface;

/**
 * The class managing the data of an export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ExportData
{
    /**
     * The combination of the export.
     * @var Combination
     */
    protected $combination;

    /**
     * The storage to use for the combination.
     * @var StorageInterface
     */
    protected $storage;

    /**
     * Initializes the export.
     * @param Combination $combination
     * @param StorageInterface $storage
     */
    public function __construct(Combination $combination, StorageInterface $storage)
    {
        $this->combination = $combination;
        $this->storage = $storage;
    }

    /**
     * The combination of the export.
     * @return Combination
     */
    public function getCombination(): Combination
    {
        return $this->combination;
    }

    /**
     * Adds a rendered icon to the export data.
     * @param Icon $icon
     * @param string $contents
     * @return $this
     */
    public function addRenderedIcon(Icon $icon, string $contents): self
    {
        $this->storage->addRenderedIcon($icon->getId(), $contents);
        return $this;
    }

    /**
     * Returns a rendered icon from the export data.
     * @param Icon $icon
     * @return string
     */
    public function getRenderedIcon(Icon $icon): string
    {
        return $this->storage->getRenderedIcon($icon->getId());
    }

    /**
     * Persists the export data.
     * @return string The filename used for the file.
     */
    public function persist(): string
    {
        return $this->storage->save($this->combination);
    }

    /**
     * Removes the export data from the storage.
     */
    public function remove(): void
    {
        $this->storage->remove();
    }
}
