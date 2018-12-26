<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use BluePsyduck\Common\Data\DataContainer;

/**
 * The interface of the entities.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface EntityInterface
{
    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array;

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data);

    /**
     * Calculates a hash value representing the entity.
     * @return string
     */
    public function calculateHash(): string;
}
