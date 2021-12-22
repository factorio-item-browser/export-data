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
    public string $id = '';
    public int $size = 0;
    /** @var array<Layer> */
    #[Type('array<' . Layer::class . '>')]
    public array $layers = [];
}
