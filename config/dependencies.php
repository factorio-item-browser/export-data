<?php

declare(strict_types=1);

/**
 * The configuration of the export data dependencies.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace FactorioItemBrowser\ExportData;

use FactorioItemBrowser\ExportData\Constant\ServiceName;

return [
    'dependencies' => [
        'factories'  => [
            // 3rd party dependencies
            ServiceName::SERIALIZER => Serializer\SerializerFactory::class,
        ],
    ],
];
