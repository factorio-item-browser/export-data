<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Collection;

use FactorioItemBrowser\ExportData\Collection\Translations;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Translations class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Collection\Translations
 */
class TranslationsTest extends TestCase
{
    /**
     * @covers ::<public>
     */
    public function testSetAndGet(): void
    {
        $instance = new Translations();
        $this->assertSame('', $instance->get('foo'));

        $instance->set('foo', 'abc');
        $this->assertSame('abc', $instance->get('foo'));

        $instance->set('bar', 'def');
        $this->assertSame('abc', $instance->get('foo'));
        $this->assertSame('def', $instance->get('bar'));

        $instance->set('baz', 'ghi');
        $this->assertSame('ghi', $instance->get('baz'));
        $instance->set('baz', '');
        $this->assertSame('', $instance->get('baz'));

        $expectedData = [
            'foo' => 'abc',
            'bar' => 'def',
        ];
        $data = iterator_to_array($instance);
        $this->assertEquals($expectedData, $data);
    }
}
