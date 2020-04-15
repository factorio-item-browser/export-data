<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

/**
 * The entity representing an actual combination of an export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Combination
{
    /**
     * The id of the combination.
     * @var string
     */
    protected $id = '';

    /**
     * The mods of the combination.
     * @var array|Mod[]
     */
    protected $mods = [];

    /**
     * The items of the combination.
     * @var array|Item[]
     */
    protected $items = [];

    /**
     * The machines of the combination.
     * @var array|Machine[]
     */
    protected $machines = [];

    /**
     * The recipes of the combination.
     * @var array|Recipe[]
     */
    protected $recipes = [];

    /**
     * The icons of the combination.
     * @var array|Icon[]
     */
    protected $icons = [];

    /**
     * Sets the id of the combination.
     * @param string $id
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Returns the id of the combination.
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets the mods of the combination.
     * @param array|Mod[] $mods
     * @return $this
     */
    public function setMods(array $mods): self
    {
        $this->mods = $mods;
        return $this;
    }

    /**
     * Adds a mod to the combination.
     * @param Mod $mod
     * @return $this
     */
    public function addMod(Mod $mod): self
    {
        $this->mods[] = $mod;
        return $this;
    }

    /**
     * Returns the mods of the combination.
     * @return array|Mod[]
     */
    public function getMods(): array
    {
        return $this->mods;
    }

    /**
     * Sets the items of the combination.
     * @param array|Item[] $items
     * @return $this
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    /**
     * Adds a item to the combination.
     * @param Item $item
     * @return $this
     */
    public function addItem(Item $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Returns the items of the combination.
     * @return array|Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Sets the machines of the combination.
     * @param array|Machine[] $machines
     * @return $this
     */
    public function setMachines(array $machines): self
    {
        $this->machines = $machines;
        return $this;
    }

    /**
     * Adds a machine to the combination.
     * @param Machine $machine
     * @return $this
     */
    public function addMachine(Machine $machine): self
    {
        $this->machines[] = $machine;
        return $this;
    }

    /**
     * Returns the machines of the combination.
     * @return array|Machine[]
     */
    public function getMachines(): array
    {
        return $this->machines;
    }

    /**
     * Sets the recipes of the combination.
     * @param array|Recipe[] $recipes
     * @return $this
     */
    public function setRecipes(array $recipes): self
    {
        $this->recipes = $recipes;
        return $this;
    }

    /**
     * Adds a recipe to the combination.
     * @param Recipe $recipe
     * @return $this
     */
    public function addRecipe(Recipe $recipe): self
    {
        $this->recipes[] = $recipe;
        return $this;
    }

    /**
     * Returns the recipes of the combination.
     * @return array|Recipe[]
     */
    public function getRecipes(): array
    {
        return $this->recipes;
    }

    /**
     * Sets the icons of the combination.
     * @param array|Icon[] $icons
     * @return $this
     */
    public function setIcons(array $icons): self
    {
        $this->icons = $icons;
        return $this;
    }

    /**
     * Adds a icon to the combination.
     * @param Icon $icon
     * @return $this
     */
    public function addIcon(Icon $icon): self
    {
        $this->icons[] = $icon;
        return $this;
    }

    /**
     * Returns the icons of the combination.
     * @return array|Icon[]
     */
    public function getIcons(): array
    {
        return $this->icons;
    }
}
