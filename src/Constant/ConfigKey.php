<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Constant;

/**
 * The interface holding the keys of the config.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface ConfigKey
{
    /**
     * The main key for the config.
     */
    public const MAIN = 'export-data';

    /**
     * The key holding the cache directory to use.
     */
    public const CACHE_DIR = 'cache-dir';

    /**
     * The key holding the working directory to use.
     */
    public const WORKING_DIRECTORY = 'working-directory';

    /**
     * The key holding the serializer config.
     */
    public const SERIALIZER = 'serializer';
}
