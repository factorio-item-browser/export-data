<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Collection;

use FactorioItemBrowser\ExportData\Collection\TranslationDictionary;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the TranslationDictionary class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Collection\TranslationDictionary
 */
class TranslationDictionaryTest extends TestCase
{
    public function testSetAndGet(): void
    {
        $instance = new TranslationDictionary();
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
