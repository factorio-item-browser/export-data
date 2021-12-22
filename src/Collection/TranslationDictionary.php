<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Collection;

use ArrayIterator;
use IteratorAggregate;
use JMS\Serializer\Annotation\Inline;
use JMS\Serializer\Annotation\Type;
use Traversable;

/**
 * The dictionary for the translations.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements IteratorAggregate<string, string>
 */
class TranslationDictionary implements DictionaryInterface, IteratorAggregate
{
    /** @var array<string, string> */
    #[Type('array<string, string>')]
    #[Inline]
    private array $values = [];

    public function set(string $key, string $value): void
    {
        if ($value === '') {
            unset($this->values[$key]);
        } else {
            $this->values[$key] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        }
    }

    public function get(string $key): string
    {
        return $this->values[$key] ?? '';
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->values);
    }
}
