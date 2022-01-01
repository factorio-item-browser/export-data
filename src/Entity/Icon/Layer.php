<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Constant\SerializationGroup;
use JMS\Serializer\Annotation\Groups;

/**
 * The entity representing one layer of an icon.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Layer
{
    /**
     * The name of the file used by the layer.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public string $fileName = '';

    /**
     * The offset of the layer.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public Offset $offset;

    /**
     * The scale of the layer.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public float $scale = 1.;

    /**
     * The size of the layer, in pixel.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public int $size = 0;

    /**
     * The tint of the layer.
     */
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public Color $tint;

    public function __construct()
    {
        $this->offset = new Offset();
        $this->tint = new Color();
    }
}
