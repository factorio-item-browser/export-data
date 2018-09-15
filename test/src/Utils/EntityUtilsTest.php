<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Utils;

use FactorioItemBrowser\ExportData\Utils\EntityUtils;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the EntityUtils class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Utils\EntityUtils
 */
class EntityUtilsTest extends TestCase
{
    /**
     * Tests the buildIdentifier method.
     * @covers ::buildIdentifier
     */
    public function testBuildIdentifier(): void
    {
        $keys = ['abc', 'def'];
        $expectedResult = 'abc|def';

        $result = EntityUtils::buildIdentifier($keys);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the calculateHash method.
     * @covers ::calculateHash
     */
    public function testCalculateHash(): void
    {
        $content = 'abc';
        $expectedResult = '900150983cd24fb0';

        $result = EntityUtils::calculateHash($content);
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

        $result = EntityUtils::calculateHashOfArray($data);
        $this->assertSame($expectedResult, $result);
    }
}
