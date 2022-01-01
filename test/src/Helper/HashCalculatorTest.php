<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Helper;

use FactorioItemBrowser\ExportData\Constant\SerializationGroup;
use FactorioItemBrowser\ExportData\Helper\HashCalculator;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * The PHPUnit test of the HashCalculator class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\Helper\HashCalculator
 */
class HashCalculatorTest extends TestCase
{
    /** @var SerializerInterface&MockObject */
    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        $this->serializer = $this->createMock(SerializerInterface::class);
    }

    private function createInstance(): HashCalculator
    {
        return new HashCalculator(
            $this->serializer,
        );
    }

    public function testHashEntity(): void
    {
        $entity = new stdClass();
        $serializedEntity = 'abc';
        $expectedResult = '90015098-3cd2-4fb0-d696-3f7d28e17f72';

        $this->serializer->expects($this->once())
                         ->method('serialize')
                         ->with(
                             $this->identicalTo($entity),
                             $this->identicalTo('json'),
                             $this->callback(function (SerializationContext $context): bool {
                                 $this->assertEquals([SerializationGroup::HASH], $context->getAttribute('groups'));
                                 return true;
                             }),
                         )
                         ->willReturn($serializedEntity);

        $instance = $this->createInstance();
        $result = $instance->hashEntity($entity);

        $this->assertSame($expectedResult, $result);
    }
}
