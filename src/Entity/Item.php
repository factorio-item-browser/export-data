<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\DictionaryInterface;
use FactorioItemBrowser\ExportData\Collection\TranslationDictionary;
use JMS\Serializer\Annotation\Type;

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
    #[Type(TranslationDictionary::class)]
    public DictionaryInterface $labels;
    #[Type(TranslationDictionary::class)]
    public DictionaryInterface $descriptions;
    public string $iconId = '';

    public function __construct()
    {
        $this->labels = new TranslationDictionary();
        $this->descriptions = new TranslationDictionary();
    }
}
