<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\DictionaryInterface;
use FactorioItemBrowser\ExportData\Collection\TranslationDictionary;
use JMS\Serializer\Annotation\Type;

/**
 * The abstract class for localised entities.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
abstract class LocalisedEntity
{
    /**
     * The localised name of the entity to be translated.
     */
    #[Type('localisedString')]
    public mixed $localisedName = null;

    /**
     * The localised description of the entity to be translated.
     */
    #[Type('localisedString')]
    public mixed $localisedDescription = null;

    /**
     * The translated labels for the entity.
     */
    #[Type(TranslationDictionary::class)]
    public DictionaryInterface $labels;

    /**
     * The translated descriptions for the entity.
     */
    #[Type(TranslationDictionary::class)]
    public DictionaryInterface $descriptions;

    public function __construct()
    {
        $this->labels = new TranslationDictionary();
        $this->descriptions = new TranslationDictionary();
    }
}
