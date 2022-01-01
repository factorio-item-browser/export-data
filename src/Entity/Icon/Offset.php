<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Constant\SerializationGroup;
use JMS\Serializer\Annotation\Groups;

/**
 * The entity representing the offset of a layer.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Offset
{
    /**
     * The horizontal offset.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public int $x = 0;

    /**
     * The vertical offset.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public int $y = 0;
}
