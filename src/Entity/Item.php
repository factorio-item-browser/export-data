<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

/**
 * The class representing an item from the export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Item extends LocalisedEntity
{
    /**
     * The type of the item.
     */
    public string $type = '';

    /**
     * The name of the item.
     */
    public string $name = '';

    /**
     * The ID of the icon used for the item.
     */
    public string $iconId = '';
}
