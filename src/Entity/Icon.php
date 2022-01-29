<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Constant\SerializationGroup;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * The entity representing an icon of an item or recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Icon
{
    /**
     * The ID of the icon.
     */
    #[Groups([SerializationGroup::DEFAULT])]
    public string $id = '';

    /**
     * The type of the icon.
     */
    #[Groups([SerializationGroup::DEFAULT])]
    public string $type = '';

    /**
     * The name of the icon.
     */
    #[Groups([SerializationGroup::DEFAULT])]
    public string $name = '';

    /**
     * The size in which the icon is rendered.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public int $size = 0;

    /**
     * The layers of the icon.
     * @var array<Layer>
     */
    #[Type('array<' . Layer::class . '>')]
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public array $layers = [];
}
