<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Icon;

/**
 * The entity representing an icon color.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Color
{
    /**
     * The red component of the color.
     */
    public float $red = 1.;

    /**
     * The green component of the color.
     */
    public float $green = 1.;

    /**
     * The blue component of the color.
     */
    public float $blue = 1.;

    /**
     * The alpha component of the color.
     */
    public float $alpha = 1.;
}
