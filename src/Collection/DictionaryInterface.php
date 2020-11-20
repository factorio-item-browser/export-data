<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Collection;

use Traversable;

/**
 * The interface for collections implementing a dictionary.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @extends Traversable<string, string>
 */
interface DictionaryInterface extends Traversable
{
    /**
     * Sets a value into the dictionary.
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value): void;

    /**
     * Returns a value from the dictionary.
     * @param string $key
     * @return string
     */
    public function get(string $key): string;
}
