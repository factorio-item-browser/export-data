<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\TranslationDictionary;

/**
 * The class representing an item from the export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Item
{
    public string $type = '';
    public string $name = '';
    public TranslationDictionary $labels;
    public TranslationDictionary $descriptions;
    public string $iconId = '';

    public function __construct()
    {
        $this->labels = new TranslationDictionary();
        $this->descriptions = new TranslationDictionary();
    }
}
