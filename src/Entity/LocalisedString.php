<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Utils\HashUtils;

/**
 * The entity representing the translations of a localised string.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class LocalisedString implements EntityInterface
{
    /**
     * The translations of the localised string.
     * @var array|string[]
     */
    protected $translations = [];

    /**
     * Sets a translation of the localised string.
     * @param string $locale
     * @param string $value
     * @return $this
     */
    public function setTranslation(string $locale, string $value)
    {
        if (strlen($value) === 0) {
            unset($this->translations[$locale]);
        } else {
            $this->translations[$locale] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        }
        return $this;
    }

    /**
     * Returns a translation of the localised string.
     * @param string $locale
     * @return string
     */
    public function getTranslation(string $locale): string
    {
        return $this->translations[$locale] ?? '';
    }

    /**
     * Returns all translations of the localised string.
     * @return array|string[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        return array_filter($this->translations);
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->translations = array_filter($data->getData());
        return $this;
    }

    /**
     * Calculates a hash value representing the entity.
     * @return string
     */
    public function calculateHash(): string
    {
        return HashUtils::calculateHashOfArray($this->translations);
    }
}
