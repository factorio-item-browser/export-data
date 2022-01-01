<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Recipe;

use FactorioItemBrowser\ExportData\Constant\SerializationGroup;
use JMS\Serializer\Annotation\Groups;

/**
 * The entity representing a product of a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Product
{
    /**
     * The type of the product.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $type = '';

    /**
     * The name of the product.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $name = '';

    /**
     * The minimal amount of the product returned from the recipe.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public float $amountMin = 1.;

    /**
     * The maximal amount of the product returned  from the recipe.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public float $amountMax = 1.;

    /**
     * The probability in which the product is returned from the recipe.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public float $probability = 1.;
}
