<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Collection;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * The collection representing a localised string.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements IteratorAggregate<string, string>
 */
class Translations implements IteratorAggregate
{
    /** @var array<string, string> */
    private array $translations = [];

    public function set(string $locale, string $translation): self
    {
        if ($translation === '') {
            unset($this->translations[$locale]);
        } else {
            $this->translations[$locale] = mb_convert_encoding($translation, 'UTF-8', 'UTF-8');
        }

        return $this;
    }

    public function get(string $locale): string
    {
        return $this->translations[$locale] ?? '';
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->translations);
    }
}
