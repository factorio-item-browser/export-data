<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData;

use FactorioItemBrowser\ExportData\Collection\ChunkedCollection;
use FactorioItemBrowser\ExportData\Collection\DictionaryInterface;
use FactorioItemBrowser\ExportData\Collection\FileDictionary;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Machine;
use FactorioItemBrowser\ExportData\Entity\Mod;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use FactorioItemBrowser\ExportData\Entity\Technology;
use FactorioItemBrowser\ExportData\Storage\Storage;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;

/**
 * The class managing the data of an export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ExportData
{
    private readonly string $combinationId;

    /** @var ChunkedCollection<Mod> */
    #[Type('ChunkedCollection<' . Mod::class . '>')]
    private readonly ChunkedCollection $mods;

    /** @var ChunkedCollection<Item> */
    #[Type('ChunkedCollection<' . Item::class . '>')]
    private readonly ChunkedCollection $items;

    /** @var ChunkedCollection<Machine> */
    #[Type('ChunkedCollection<' . Machine::class . '>')]
    private readonly ChunkedCollection $machines;

    /** @var ChunkedCollection<Recipe> */
    #[Type('ChunkedCollection<' . Recipe::class . '>')]
    private readonly ChunkedCollection $recipes;

    /** @var ChunkedCollection<Technology> */
    #[Type('ChunkedCollection<' . Technology::class . '>')]
    private readonly ChunkedCollection $technologies;

    /** @var ChunkedCollection<Icon> */
    #[Type('ChunkedCollection<FactorioItemBrowser\ExportData\Entity\Icon>')]
    private readonly ChunkedCollection $icons;

    #[Exclude]
    private readonly DictionaryInterface $renderedIcons;

    public function __construct(
        Storage $storage,
        string $combinationId,
    ) {
        $this->combinationId = $combinationId;
        $this->mods = new ChunkedCollection($storage, Mod::class);
        $this->items = new ChunkedCollection($storage, Item::class);
        $this->machines = new ChunkedCollection($storage, Machine::class);
        $this->recipes = new ChunkedCollection($storage, Recipe::class);
        $this->technologies = new ChunkedCollection($storage, Technology::class);
        $this->icons = new ChunkedCollection($storage, Icon::class);
        $this->renderedIcons = new FileDictionary($storage, 'rendered-icon/%s.png', false);
    }

    public function getCombinationId(): string
    {
        return $this->combinationId;
    }

    /**
     * @return ChunkedCollection<Mod>
     */
    public function getMods(): ChunkedCollection
    {
        return $this->mods;
    }

    /**
     * @return ChunkedCollection<Item>
     */
    public function getItems(): ChunkedCollection
    {
        return $this->items;
    }

    /**
     * @return ChunkedCollection<Machine>
     */
    public function getMachines(): ChunkedCollection
    {
        return $this->machines;
    }

    /**
     * @return ChunkedCollection<Recipe>
     */
    public function getRecipes(): ChunkedCollection
    {
        return $this->recipes;
    }

    /**
     * @return ChunkedCollection<Technology>
     */
    public function getTechnologies(): ChunkedCollection
    {
        return $this->technologies;
    }

    /**
     * @return ChunkedCollection<Icon>
     */
    public function getIcons(): ChunkedCollection
    {
        return $this->icons;
    }

    public function getRenderedIcons(): DictionaryInterface
    {
        return $this->renderedIcons;
    }
}
