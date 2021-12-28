<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Recipe;

/**
 * The entity representing an ingredient of a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Ingredient
{
    /**
     * The type of the ingredient.
     */
    public string $type = '';

    /**
     * The name of the ingredient.
     */
    public string $name = '';

    /**
     * The amount of the ingredient used in the recipe.
     */
    public float $amount = 1.;
}
