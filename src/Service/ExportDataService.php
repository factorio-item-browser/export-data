<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Service;

use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Machine;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use FactorioItemBrowser\ExportData\Registry\Adapter\AdapterInterface;
use FactorioItemBrowser\ExportData\Registry\ContentRegistry;
use FactorioItemBrowser\ExportData\Registry\EntityRegistry;
use FactorioItemBrowser\ExportData\Registry\ModRegistry;

/**
 * The main service class of the export data.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ExportDataService
{
    /**
     * The namespace to use for the rendered icons.
     */
    protected const NAMESPACE_RENDERED_ICONS = 'renderedIcon';

    /**
     * The registry of the icons.
     * @var EntityRegistry
     */
    protected $iconRegistry;

    /**
     * The registry of the items.
     * @var EntityRegistry
     */
    protected $itemRegistry;

    /**
     * The registry of the machines.
     * @var EntityRegistry
     */
    protected $machineRegistry;

    /**
     * The registry of the mods.
     * @var ModRegistry
     */
    protected $modRegistry;

    /**
     * The registry of the recipes.
     * @var EntityRegistry
     */
    protected $recipeRegistry;

    /**
     * The registry of the rendered icons.
     * @var ContentRegistry
     */
    protected $renderedIconRegistry;

    /**
     * Initializes the service.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->iconRegistry = new EntityRegistry($adapter, Icon::class);
        $this->machineRegistry = new EntityRegistry($adapter, Machine::class);
        $this->modRegistry = new ModRegistry($adapter);
        $this->itemRegistry = new EntityRegistry($adapter, Item::class);
        $this->recipeRegistry = new EntityRegistry($adapter, Recipe::class);
        $this->renderedIconRegistry = new ContentRegistry($adapter, self::NAMESPACE_RENDERED_ICONS);
    }

    /**
     * Returns the registry of the icons.
     * @return EntityRegistry
     */
    public function getIconRegistry(): EntityRegistry
    {
        return $this->iconRegistry;
    }

    /**
     * Returns the registry of the machines.
     * @return EntityRegistry
     */
    public function getMachineRegistry(): EntityRegistry
    {
        return $this->machineRegistry;
    }

    /**
     * Returns the registry of the items.
     * @return EntityRegistry
     */
    public function getItemRegistry(): EntityRegistry
    {
        return $this->itemRegistry;
    }

    /**
     * Returns the registry of the mods.
     * @return ModRegistry
     */
    public function getModRegistry(): ModRegistry
    {
        return $this->modRegistry;
    }

    /**
     * Returns the registry of the recipes.
     * @return EntityRegistry
     */
    public function getRecipeRegistry(): EntityRegistry
    {
        return $this->recipeRegistry;
    }

    /**
     * Returns the registry of the rendered icons.
     * @return ContentRegistry
     */
    public function getRenderedIconRegistry(): ContentRegistry
    {
        return $this->renderedIconRegistry;
    }
}
