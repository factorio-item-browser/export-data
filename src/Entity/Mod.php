<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Constant\SerializationGroup;
use JMS\Serializer\Annotation\Groups;

/**
 * The entity representing a mod.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Mod extends LocalisedEntity
{
    /**
     * The name of the mod, used on the Factorio Mod Portal.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $name = '';

    /**
     * The author of the mod.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $author = '';

    /**
     * The (normalized) version of the mod.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $version = '';

    /**
     * The ID of the icon used as thumbnail for the mod.
     */
    #[Groups([SerializationGroup::DEFAULT])]
    public string $iconId = '';
}
