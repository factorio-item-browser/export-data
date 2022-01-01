<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Constant\SerializationGroup;
use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use FactorioItemBrowser\ExportData\Entity\Recipe\Product;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * The class representing a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Recipe extends LocalisedEntity
{
    /**
     * The type of the recipe.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $type = '';

    /**
     * The name of the recipe.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $name = '';

    /**
     * The mode of the recipe.
     */
    #[Groups([SerializationGroup::DEFAULT])]
    public string $mode = '';

    /**
     * The ingredients of the recipe.
     * @var array<Ingredient>
     */
    #[Type('array<' . Ingredient::class . '>')]
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public array $ingredients = [];

    /**
     * The products of the recipe.
     * @var array<Product>
     */
    #[Type('array<' . Product::class . '>')]
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public array $products = [];

    /**
     * The time of the recipe, either the crafting time, or mining time in case of a mining recipe.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public float $time = 0.;

    /**
     * The category of the recipe, either the crafting category, or the resource category in case of a mining recipe.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $category = '';

    /**
     * The ID of the icon used by the recipe.
     */
    #[Groups([SerializationGroup::DEFAULT])]
    public string $iconId = '';
}
