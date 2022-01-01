<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Recipe;

use FactorioItemBrowser\ExportData\Constant\SerializationGroup;
use JMS\Serializer\Annotation\Groups;

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
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $type = '';

    /**
     * The name of the ingredient.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $name = '';

    /**
     * The amount of the ingredient used in the recipe.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public float $amount = 1.;
}
