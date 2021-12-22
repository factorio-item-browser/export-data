<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\DictionaryInterface;
use FactorioItemBrowser\ExportData\Collection\TranslationDictionary;
use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use FactorioItemBrowser\ExportData\Entity\Recipe\Product;
use JMS\Serializer\Annotation\Type;

/**
 * The class representing a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Recipe
{
    public string $name = '';
    #[Type(TranslationDictionary::class)]
    public DictionaryInterface $labels;
    #[Type(TranslationDictionary::class)]
    public DictionaryInterface $descriptions;
    public string $mode = '';
    /** @var array<Ingredient> */
    #[Type('array<' . Ingredient::class . '>')]
    public array $ingredients = [];
    /** @var array<Product> */
    #[Type('array<' . Product::class . '>')]
    public array $products = [];
    public float $craftingTime = 0.;
    public string $craftingCategory = '';
    public string $iconId = '';

    public function __construct()
    {
        $this->labels = new TranslationDictionary();
        $this->descriptions = new TranslationDictionary();
    }
}
