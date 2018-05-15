<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Machine;
use FactorioItemBrowser\ExportData\Entity\Recipe;

/**
 * The class representing the actual data of an exported combination.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class CombinationData
{
    /**
     * The items of the combination.
     * @var array|Item[]
     */
    protected $items = [];

    /**
     * The recipes of the combination.
     * @var array|Recipe[]
     */
    protected $recipes = [];

    /**
     * The machines of the combination.
     * @var array|Machine[]
     */
    protected $machines = [];

    /**
     * The icons of the export.
     * @var array|Icon[]
     */
    protected $icons = [];

    /**
     * Clones the entity.
     */
    public function __clone()
    {
        $this->items = array_map(function (Item $item): Item {
            return clone($item);
        }, $this->items);
        $this->recipes = array_map(function (Recipe $recipe): Recipe {
            return clone($recipe);
        }, $this->recipes);
        $this->machines =  array_map(function (Machine $machine): Machine {
            return clone($machine);
        }, $this->machines);
        $this->icons = array_map(function (Icon $icon): Icon {
            return clone($icon);
        }, $this->icons);
    }

    /**
     * Sets the items of the combination.
     * @param array|Item[] $items
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->items = array_values(array_filter($items, function ($item): bool {
            return $item instanceof Item;
        }));
        return $this;
    }

    /**
     * Adds an item to the combination.
     * @param Item $item
     * @return $this
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Returns the item with the specified type and name, if it exists.
     * @param string $type
     * @param string $name
     * @return Item|null
     */
    public function getItem(string $type, string $name): ?Item
    {
        $result = null;
        foreach ($this->items as $item) {
            if ($item->getType() === $type && $item->getName() === $name) {
                $result = $item;
                break;
            }
        }
        return $result;
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
     * Removes the item with the specified type and name.
     * @param string $type
     * @param string $name
     * @return $this
     */
    public function removeItem(string $type, string $name)
    {
        foreach ($this->items as $key => $item) {
            if ($item->getType() === $type && $item->getName() === $name) {
                unset($this->items[$key]);
                break;
            }
        }
        return $this;
    }

    /**
     * Sets the recipes of the combination.
     * @param array|Recipe[] $recipes
     * @return $this
     */
    public function setRecipes(array $recipes)
    {
        $this->recipes = array_values(array_filter($recipes, function ($recipe): bool {
            return $recipe instanceof Recipe;
        }));
        return $this;
    }

    /**
     * Adds a recipe to the combination.
     * @param Recipe $recipe
     * @return $this
     */
    public function addRecipe(Recipe $recipe)
    {
        $this->recipes[] = $recipe;
        return $this;
    }

    /**
     * Returns the recipe with the specified name and mode, if it exists.
     * @param string $name
     * @param string $mode
     * @return Recipe|null
     */
    public function getRecipe(string $name, string $mode): ?Recipe
    {
        $result = null;
        foreach ($this->recipes as $recipe) {
            if ($recipe->getName() === $name && $recipe->getMode() === $mode) {
                $result = $recipe;
                break;
            }
        }
        return $result;
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
     * Removes the recipe with the specified type and name.
     * @param string $name
     * @param string $mode
     * @return $this
     */
    public function removeRecipe(string $name, string $mode)
    {
        foreach ($this->recipes as $key => $recipe) {
            if ($recipe->getName() === $name && $recipe->getMode() === $mode) {
                unset($this->recipes[$key]);
                break;
            }
        }
        return $this;
    }

    /**
     * Sets the machines of the combination.
     * @param array|Machine[] $machines
     * @return $this
     */
    public function setMachines(array $machines)
    {
        $this->machines = array_values(array_filter($machines, function ($machine): bool {
            return $machine instanceof Machine;
        }));
        return $this;
    }

    /**
     * Adds a machine to the combination.
     * @param Machine $machine
     * @return $this
     */
    public function addMachine(Machine $machine)
    {
        $this->machines[] = $machine;
        return $this;
    }

    /**
     * Returns the machine with the specified name, if it exists.
     * @param string $name
     * @return Machine|null
     */
    public function getMachine(string $name): ?Machine
    {
        $result = null;
        foreach ($this->machines as $machine) {
            if ($machine->getName() === $name) {
                $result = $machine;
                break;
            }
        }
        return $result;
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
     * Removes the machine with the specified name.
     * @param string $name
     * @return $this
     */
    public function removeMachine(string $name)
    {
        foreach ($this->machines as $key => $machine) {
            if ($machine->getName() === $name) {
                unset($this->machines[$key]);
                break;
            }
        }
        return $this;
    }

    /**
     * Sets the icons of the combination.
     * @param array|Icon[] $icons
     * @return $this
     */
    public function setIcons(array $icons)
    {
        $this->icons = array_values(array_filter($icons, function ($icon): bool {
            return $icon instanceof Icon;
        }));
        return $this;
    }

    /**
     * Adds an icon to the combination.
     * @param Icon $icon
     * @return $this
     */
    public function addIcon(Icon $icon)
    {
        $this->icons[] = $icon;
        return $this;
    }

    /**
     * Returns the icon with the specified hash, if available.
     * @param string $iconHash
     * @return Icon|null
     */
    public function getIcon(string $iconHash): ?Icon
    {
        $result = null;
        foreach ($this->icons as $icon) {
            if ($icon->getIconHash() === $iconHash) {
                $result = $icon;
                break;
            }
        }
        return $result;
    }

    /**
     * Returns all icons of the combination.
     * @return array|Icon[]
     */
    public function getIcons(): array
    {
        return $this->icons;
    }

    /**
     * Removes the icon with the specified hash from the combination.
     * @param string $iconHash
     * @return $this
     */
    public function removeIcon(string $iconHash)
    {
        foreach ($this->icons as $key => $icon) {
            if ($icon->getIconHash() === $iconHash) {
                unset($this->icons[$key]);
                break;
            }
        }
        return $this;
    }

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder->setArray('i', $this->items, function (Item $item): array {
                        return $item->writeData();
                    }, [])
                    ->setArray('r', $this->recipes, function (Recipe $recipe): array {
                        return $recipe->writeData();
                    }, [])
                    ->setArray('m', $this->machines, function (Machine $machine): array {
                        return $machine->writeData();
                    }, [])
                    ->setArray('c', $this->icons, function (Icon $icon): array {
                        return $icon->writeData();
                    }, []);
        return $dataBuilder->getData();
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->items = array_map(function (DataContainer $data): Item {
            return (new Item())->readData($data);
        }, $data->getObjectArray('i'));
        $this->recipes = array_map(function (DataContainer $data): Recipe {
            return (new Recipe())->readData($data);
        }, $data->getObjectArray('r'));
        $this->machines = array_map(function (DataContainer $data): Machine {
            return (new Machine())->readData($data);
        }, $data->getObjectArray('m'));
        $this->icons = array_map(function (DataContainer $data): Icon {
            return (new Icon())->readData($data);
        }, $data->getObjectArray('c'));
        return $this;
    }
}