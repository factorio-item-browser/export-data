<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Icon;

/**
 * The entity representing one layer of an icon.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Layer
{
    public string $fileName = '';
    public Offset $offset;
    public float $scale = 1.;
    public int $size = 0;
    public Color $tint;

    public function __construct()
    {
        $this->offset = new Offset();
        $this->tint = new Color();
    }
}
