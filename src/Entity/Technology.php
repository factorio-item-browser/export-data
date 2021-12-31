<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
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
    public string $name = '';

    /**
     * The difficulty mode of the technology.
     */
    public string $mode = '';

    /**
     * The prerequisites required for the technology.
     * @var array<string>
     */
    #[Type('array<string>')]
    public array $prerequisites = [];

    /**
     * The research ingredients for the technology.
     * @var array<Ingredient>
     */
    #[Type('array<' . Ingredient::class . '>')]
    public array $researchIngredients = [];

    /**
     * The number of researches required to unlock the technology.
     */
    public int $researchCount = 0;

    /**
     * The time required for each research.
     */
    public float $researchTime = 0.;

    /**
     * The recipes unlocked by the technology.
     * @var array<string>
     */
    #[Type('array<string>')]
    public array $unlockedRecipes = [];

    /**
     * The ID of the icon used by the technology.
     */
    public string $iconId = '';
}
