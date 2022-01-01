<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\DictionaryInterface;
use FactorioItemBrowser\ExportData\Collection\TranslationDictionary;
use FactorioItemBrowser\ExportData\Constant\SerializationGroup;
use JMS\Serializer\Annotation\Groups;
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
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public mixed $localisedName = null;

    /**
     * The localised description of the entity to be translated.
     */
    #[Type('localisedString')]
    #[Groups([SerializationGroup::DEFAULT, SerializationGroup::HASH])]
    public mixed $localisedDescription = null;

    /**
     * The translated labels for the entity.
     */
    #[Type(TranslationDictionary::class)]
    #[Groups([SerializationGroup::DEFAULT])]
    public DictionaryInterface $labels;

    /**
     * The translated descriptions for the entity.
     */
    #[Type(TranslationDictionary::class)]
    #[Groups([SerializationGroup::DEFAULT])]
    public DictionaryInterface $descriptions;

    public function __construct()
    {
        $this->labels = new TranslationDictionary();
        $this->descriptions = new TranslationDictionary();
    }
}
