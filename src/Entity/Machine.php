<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\DictionaryInterface;
use FactorioItemBrowser\ExportData\Collection\TranslationDictionary;
use JMS\Serializer\Annotation\Type;

/**
 * The class representing a (crafting) machine from the export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Machine
{
    public string $name = '';
    #[Type(TranslationDictionary::class)]
    public DictionaryInterface $labels;
    #[Type(TranslationDictionary::class)]
    public DictionaryInterface $descriptions;
    /** @var array<string> */
    #[Type('array<string>')]
    public array $craftingCategories = [];
    public float $craftingSpeed = 1.;
    public int $numberOfItemSlots = 0;
    public int $numberOfFluidInputSlots = 0;
    public int $numberOfFluidOutputSlots = 0;
    public int $numberOfModuleSlots = 0;
    public float $energyUsage = 0.;
    public string $energyUsageUnit = 'W';
    public string $iconId = '';

    public function __construct()
    {
        $this->labels = new TranslationDictionary();
        $this->descriptions = new TranslationDictionary();
    }
}
