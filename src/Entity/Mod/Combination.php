<?php

namespace FactorioItemBrowser\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\EntityInterface;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Recipe;

/**
 * The class representing an actual mod combination of an export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Combination implements EntityInterface
{
    /**
     * The name of the combination.
     * @var string
     */
    protected $name = '';

    /**
     * The name of the main mod of the combination.
     * @var string
     */
    protected $mainModName = '';

    /**
     * The names of the mods which have been loaded for this combination.
     * @var array|string[]
     */
    protected $loadedModNames = [];

    /**
     * The names of optional mods which have been loaded for this combination.
     * @var array|string[]
     */
    protected $loadedOptionalModNames = [];

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
        $this->icons = array_map(function (Icon $icon): Icon {
            return clone($icon);
        }, $this->icons);
    }

    /**
     * Sets the name of the combination.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the combination.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name of the main mod of the combination.
     * @param string $mainModName
     * @return $this Implementing fluent interface.
     */
    public function setMainModName(string $mainModName)
    {
        $this->mainModName = $mainModName;
        return $this;
    }

    /**
     * Returns the name of the main mod of the combination.
     * @return string
     */
    public function getMainModName(): string
    {
        return $this->mainModName;
    }

    /**
     * Sets the names of the mods which have been loaded for this combination.
     * @param array|string[] $loadedModNames
     * @return $this Implementing fluent interface.
     */
    public function setLoadedModNames(array $loadedModNames)
    {
        $this->loadedModNames = $loadedModNames;
        return $this;
    }

    /**
     * Adds a name of a mod which have been loaded for this combination.
     * @param string $loadedModName
     * @return $this
     */
    public function addLoadedModName(string $loadedModName)
    {
        $this->loadedModNames[] = $loadedModName;
        return $this;
    }

    /**
     * Returns the names of the mods which have been loaded for this combination.
     * @return array|string[]
     */
    public function getLoadedModNames(): array
    {
        return $this->loadedModNames;
    }

    /**
     * Sets the names of optional mods which have been loaded for this combination.
     * @param array|string[] $loadedOptionalModNames
     * @return $this Implementing fluent interface.
     */
    public function setLoadedOptionalModNames(array $loadedOptionalModNames)
    {
        $this->loadedOptionalModNames = $loadedOptionalModNames;
        return $this;
    }

    /**
     * Adds the name of an optional mod which have been loaded for this combination.
     * @param string $loadedOptionalModName
     * @return $this
     */
    public function addLoadedOptionalModName(string $loadedOptionalModName)
    {
        $this->loadedOptionalModNames[] = $loadedOptionalModName;
        return $this;
    }

    /**
     * Returns the names of optional mods which have been loaded for this combination.
     * @return array|string[]
     */
    public function getLoadedOptionalModNames(): array
    {
        return $this->loadedOptionalModNames;
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
     * Returns the recipe with the specified type and name, if it exists.
     * @param string $type
     * @param string $name
     * @return Recipe|null
     */
    public function getRecipe(string $type, string $name): ?Recipe
    {
        $result = null;
        foreach ($this->recipes as $recipe) {
            if ($recipe->getType() === $type && $recipe->getName() === $name) {
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
     * @param string $type
     * @param string $name
     * @return $this
     */
    public function removeRecipe(string $type, string $name)
    {
        foreach ($this->recipes as $key => $recipe) {
            if ($recipe->getType() === $type && $recipe->getName() === $name) {
                unset($this->recipes[$key]);
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
        $dataBuilder->setString('n', $this->name, '')
                    ->setString('m', $this->mainModName, '')
                    ->setArray('l', $this->loadedModNames, 'strval', [])
                    ->setArray('o', $this->loadedOptionalModNames, 'strval', [])
                    ->setArray('i', $this->items, function (Item $item): array {
                        return $item->writeData();
                    }, [])
                    ->setArray('r', $this->recipes, function (Recipe $recipe): array {
                        return $recipe->writeData();
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
        $this->name = $data->getString('n', '');
        $this->mainModName = $data->getString('m', '');
        $this->loadedModNames = array_map('strval', $data->getArray('l'));
        $this->loadedOptionalModNames = array_map('strval', $data->getArray('o'));
        $this->items = array_map(function (DataContainer $data): Item {
            $item = new Item();
            $item->readData($data);
            return $item;
        }, $data->getObjectArray('i'));
        $this->recipes = array_map(function (DataContainer $data): Recipe {
            $recipe = new Recipe();
            $recipe->readData($data);
            return $recipe;
        }, $data->getObjectArray('r'));
        $this->icons = array_map(function (DataContainer $data): Icon {
            $icon = new Icon();
            $icon->readData($data);
            return $icon;
        }, $data->getObjectArray('c'));

        return $this;
    }
}