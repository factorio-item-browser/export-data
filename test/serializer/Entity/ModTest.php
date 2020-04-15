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
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Mod
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
        $mod->setName('abc')
            ->setAuthor('def')
            ->setVersion('ghi')
            ->setThumbnailId('jkl');
        $mod->getTitles()->addTranslation('mno', 'pqr');
        $mod->getDescriptions()->addTranslation('stu', 'vwx');

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
            'thumbnailId' => 'jkl',
            'titles' => [
                'mno' => 'pqr',
            ],
            'descriptions' => [
                'stu' => 'vwx',
            ],
        ];
    }
}
