<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

/**
 * The entity representing the translations of a localised string.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class LocalisedString
{
    /**
     * The translations of the localised string.
     * @var array|string[]
     */
    protected $translations = [];

    /**
     * @param array|string[] $translations
     * @return $this
     */
    public function setTranslations(array $translations): self
    {
        $this->translations = $translations;
        return $this;
    }

    /**
     * Adds a translation of the localised string.
     * @param string $locale
     * @param string $value
     * @return $this
     */
    public function addTranslation(string $locale, string $value): self
    {
        $this->translations[$locale] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        return $this;
    }

    /**
     * Returns all translations of the localised string.
     * @return array|string[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }
}
