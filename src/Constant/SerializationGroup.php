<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Constant;

/**
 * The interface holding the serialization groups for the serializer.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface SerializationGroup
{
    /**
     * The group for serializing all the data.
     */
    public const DEFAULT = 'Default';

    /**
     * The group for serializing has-relevant data, omitting some data which do not actually define a new entity.
     */
    public const HASH = 'Hash';
}
