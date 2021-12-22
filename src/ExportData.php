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
use FactorioItemBrowser\ExportData\Storage\Storage;

/**
 * The class managing the data of an export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ExportData
{
    public readonly string $combinationId;
    /** @var ChunkedCollection<Mod> */
    public readonly ChunkedCollection $mods;
    /** @var ChunkedCollection<Item> */
    public readonly ChunkedCollection $items;
    /** @var ChunkedCollection<Machine> */
    public readonly ChunkedCollection $machines;
    /** @var ChunkedCollection<Recipe> */
    public readonly ChunkedCollection $recipes;
    /** @var ChunkedCollection<Icon> */
    public readonly ChunkedCollection $icons;
    public readonly DictionaryInterface $renderedIcons;

    public function __construct(
        Storage $storage,
        string $combinationId,
    ) {
        $this->combinationId = $combinationId;
        $this->mods = new ChunkedCollection($storage, Mod::class);
        $this->items = new ChunkedCollection($storage, Item::class);
        $this->machines = new ChunkedCollection($storage, Machine::class);
        $this->recipes = new ChunkedCollection($storage, Recipe::class);
        $this->icons = new ChunkedCollection($storage, Icon::class);
        $this->renderedIcons = new FileDictionary($storage, 'rendered-icon/%s.png', false);
    }
}
