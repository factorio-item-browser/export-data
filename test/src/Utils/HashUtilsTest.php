<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Utils;

use FactorioItemBrowser\ExportData\Utils\HashUtils;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the HashUtils class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Utils\HashUtils
 */
class HashUtilsTest extends TestCase
{
    /**
     * Tests the calculateHash method.
     * @covers ::calculateHash
     */
    public function testCalculateHash(): void
    {
        $content = 'abc';
        $expectedResult = '900150983cd24fb0';

        $result = HashUtils::calculateHash($content);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the calculateHashOfArray method.
     * @covers ::calculateHashOfArray
     */
    public function testCalculateHashOfArray(): void
    {
        $data = ['abc', 'def'];
        $expectedResult = '9e86daa1e1bd94ed';

        $result = HashUtils::calculateHashOfArray($data);
        $this->assertSame($expectedResult, $result);
    }
}
