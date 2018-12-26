<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Utils;

/**
 * The utils class helping with entities.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class EntityUtils
{
    /**
     * Builds and returns the identifier from the keys.
     * @param array $keys
     * @return string
     */
    public static function buildIdentifier(array $keys): string
    {
        return implode('|', $keys);
    }

    /**
     * Calculates the hash of the specified content.
     * @param string $content
     * @return string
     */
    public static function calculateHash(string $content): string
    {
        return substr(hash('md5', $content), 0, 16);
    }

    /**
     * Calculates the hash of the specified data array.
     * @param array $data
     * @return string
     */
    public static function calculateHashOfArray(array $data): string
    {
        return self::calculateHash((string) json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }
}
