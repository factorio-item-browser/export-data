<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Icon;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Icon\Color;
use FactorioItemBrowser\ExportData\Utils\HashUtils;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the color class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Icon\Color
 */
class ColorTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $color = new Color();
        $this->assertSame(1., $color->getRed());
        $this->assertSame(1., $color->getGreen());
        $this->assertSame(1., $color->getBlue());
        $this->assertSame(1., $color->getAlpha());
    }

    /**
     * Tests setting and getting the red.
     * @covers ::setRed
     * @covers ::getRed
     * @covers ::<protected>
     */
    public function testSetAndGetRed()
    {
        $color = new Color();
        $this->assertSame($color, $color->setRed(0.25));
        $this->assertSame(0.25, $color->getRed());
        $this->assertSame(64., $color->getRed(256.));

        $this->assertSame($color, $color->setRed(64., 256.));
        $this->assertSame(0.25, $color->getRed());
        $this->assertSame(64., $color->getRed(256.));
    }

    /**
     * Tests setting and getting the green.
     * @covers ::setGreen
     * @covers ::getGreen
     * @covers ::<protected>
     */
    public function testSetAndGetGreen()
    {
        $color = new Color();
        $this->assertSame($color, $color->setGreen(0.25));
        $this->assertSame(0.25, $color->getGreen());
        $this->assertSame(64., $color->getGreen(256.));

        $this->assertSame($color, $color->setGreen(64., 256.));
        $this->assertSame(0.25, $color->getGreen());
        $this->assertSame(64., $color->getGreen(256.));
    }

    /**
     * Tests setting and getting the blue.
     * @covers ::setBlue
     * @covers ::getBlue
     * @covers ::<protected>
     */
    public function testSetAndGetBlue()
    {
        $color = new Color();
        $this->assertSame($color, $color->setBlue(0.25));
        $this->assertSame(0.25, $color->getBlue());
        $this->assertSame(64., $color->getBlue(256.));

        $this->assertSame($color, $color->setBlue(64., 256.));
        $this->assertSame(0.25, $color->getBlue());
        $this->assertSame(64., $color->getBlue(256.));
    }

    /**
     * Tests setting and getting the alpha.
     * @covers ::setAlpha
     * @covers ::getAlpha
     * @covers ::<protected>
     */
    public function testSetAndGetAlpha()
    {
        $color = new Color();
        $this->assertSame($color, $color->setAlpha(0.25));
        $this->assertSame(0.25, $color->getAlpha());
        $this->assertSame(64., $color->getAlpha(256.));

        $this->assertSame($color, $color->setAlpha(64., 256.));
        $this->assertSame(0.25, $color->getAlpha());
        $this->assertSame(64., $color->getAlpha(256.));
    }

    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideWriteAndReadData(): array
    {
        $color = new Color();
        $color->setRed(0.2)
              ->setGreen(0.4)
              ->setBlue(0.6)
              ->setAlpha(0.8);

        $data = [
            'r' => 0.2,
            'g' => 0.4,
            'b' => 0.6,
            'a' => 0.8
        ];

        return [
            [$color, $data],
            [new Color(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param Color $color
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideWriteAndReadData
     */
    public function testWriteAndReadData(Color $color, array $expectedData)
    {
        $data = $color->writeData();
        $this->assertEquals($expectedData, $data);

        $newColor = new Color();
        $this->assertSame($newColor, $newColor->readData(new DataContainer($data)));
        $this->assertEquals($newColor, $color);
    }

    /**
     * Tests the calculateHash method.
     * @covers ::calculateHash
     */
    public function testCalculateHash()
    {
        $color = new Color();
        $color->setRed(0.2)
              ->setGreen(0.4)
              ->setBlue(0.6)
              ->setAlpha(0.8);

        $expectedResult = HashUtils::calculateHashOfArray([
            0.2,
            0.4,
            0.6,
            0.8
        ]);

        $result = $color->calculateHash();
        $this->assertSame($expectedResult, $result);
    }
}
