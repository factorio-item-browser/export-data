<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
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
    public string $id = '';

    /**
     * The type of the icon.
     */
    public string $type = '';

    /**
     * The name of the icon.
     */
    public string $name = '';

    /**
     * The size in which the icon is rendered.
     */
    public int $size = 0;

    /**
     * The layers of the icon.
     * @var array<Layer>
     */
    #[Type('array<' . Layer::class . '>')]
    public array $layers = [];
}
