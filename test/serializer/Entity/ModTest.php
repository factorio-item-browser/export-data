<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Mod;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

/**
 * The test of the serializing the mod class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $mod = new Mod();
        $mod->name = 'abc';
        $mod->author = 'def';
        $mod->version = 'ghi';
        $mod->iconId = 'jkl';
        $mod->localisedName = ['mno', 42];
        $mod->localisedDescription = ['pqr', 21];
        $mod->labels->set('stu', 'vwx');
        $mod->descriptions->set('yza', 'bcd');

        return $mod;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'name' => 'abc',
            'author' => 'def',
            'version' => 'ghi',
            'iconId' => 'jkl',
            'localisedName' => ['mno', 42],
            'localisedDescription' => ['pqr', 21],
            'labels' => [
                'stu' => 'vwx',
            ],
            'descriptions' => [
                'yza' => 'bcd',
            ],
        ];
    }
}
