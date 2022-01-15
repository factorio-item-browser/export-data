<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Constant\SerializationGroup;
use FactorioItemBrowser\ExportData\Entity\Technology\Ingredient;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * The class representing a technology.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Technology extends LocalisedEntity
{
    /**
     * The name of the technology.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $name = '';

    /**
     * The difficulty mode of the technology.
     */
    #[Groups([SerializationGroup::DEFAULT])]
    public string $mode = '';

    /**
     * The prerequisites required for the technology.
     * @var array<string>
     */
    #[Type('array<string>')]
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public array $prerequisites = [];

    /**
     * The research ingredients for the technology.
     * @var array<Ingredient>
     */
    #[Type('array<' . Ingredient::class . '>')]
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public array $researchIngredients = [];

    /**
     * The number of researches required to unlock the technology.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public int $researchCount = 0;

    /**
     * The formula to calculate the research count in case the technology has multiple levels.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $researchCountFormula = '';

    /**
     * The time required for each research.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public float $researchTime = 0.;

    /**
     * The recipes unlocked by the technology.
     * @var array<string>
     */
    #[Type('array<string>')]
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public array $unlockedRecipes = [];

    /**
     * The level of the technology.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public int $level = 0;

    /**
     * The maximum level of the technology.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public int $maxLevel = 0;

    /**
     * The ID of the icon used by the technology.
     */
    #[Groups([SerializationGroup::DEFAULT])]
    public string $iconId = '';
}
