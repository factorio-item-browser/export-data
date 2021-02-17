<?php

/**
 * The configuration of the Export Data library.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
// phpcs:ignoreFile

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData;

use BluePsyduck\JmsSerializerFactory\Constant\ConfigKey as JmsConfigKey;
use FactorioItemBrowser\ExportData\Constant\ConfigKey;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;

return [
    ConfigKey::MAIN => [
        ConfigKey::SERIALIZER => [
            JmsConfigKey::METADATA_DIRS => [
                __NAMESPACE__ => 'vendor/factorio-item-browser/export-data/config/serializer',
            ],
            JmsConfigKey::PROPERTY_NAMING_STRATEGY => IdenticalPropertyNamingStrategy::class,
            JmsConfigKey::OBJECT_CONSTRUCTOR => Serializer\Construction\ObjectConstructor::class,
            JmsConfigKey::ADD_DEFAULT_HANDLERS => true,
            JmsConfigKey::HANDLERS => [
                Serializer\Handler\ChunkedCollectionHandler::class,
            ],
        ],
    ],
];
