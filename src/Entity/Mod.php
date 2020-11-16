<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\Translations;

/**
 * The entity representing a mod.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Mod
{
    public string $name = '';
    public Translations $titles;
    public Translations $descriptions;
    public string $author = '';
    public string $version = '';
    public string $thumbnailId = '';

    public function __construct()
    {
        $this->titles = new Translations();
        $this->descriptions = new Translations();
    }
}
