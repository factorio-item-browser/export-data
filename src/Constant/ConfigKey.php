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
     * The key holding the name of the project.
     */
    public const PROJECT = 'factorio-item-browser';

    /**
     * The key holding the name of the ExportData library itself.
     */
    public const EXPORT_DATA = 'export-data';

    /**
     * The key holding the cache directory to use.
     */
    public const CACHE_DIR = 'cache-dir';

    /**
     * The key holding the working directory to use.
     */
    public const WORKING_DIRECTORY = 'working-directory';
}
