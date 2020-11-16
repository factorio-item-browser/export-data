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
    public string $type = '';
    public string $name = '';
    public float $amount = 1.;
}
