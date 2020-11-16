<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\Translations;
use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use FactorioItemBrowser\ExportData\Entity\Recipe\Product;

/**
 * The class representing a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Recipe
{
    public string $name = '';
    public Translations $labels;
    public Translations $descriptions;
    public string $mode = '';
    /** @var array<Ingredient> */
    public array $ingredients = [];
    /** @var array<Product> */
    public array $products = [];
    public float $craftingTime = 0.;
    public string $craftingCategory = '';
    public string $iconId = '';

    public function __construct()
    {
        $this->labels = new Translations();
        $this->descriptions = new Translations();
    }
}
