<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Serializer;

use BluePsyduck\TestHelper\ReflectionTrait;
use FactorioItemBrowser\ExportData\Constant\ConfigKey;
use FactorioItemBrowser\ExportData\Serializer\Construction\ObjectConstructor;
use FactorioItemBrowser\ExportData\Serializer\Handler\ChunkedCollectionHandler;
use FactorioItemBrowser\ExportData\Serializer\SerializerFactory;
use Interop\Container\ContainerInterface;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the SerializerFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\Serializer\SerializerFactory
 */
class SerializerFactoryTest extends TestCase
{
    use ReflectionTrait;

    public function testInvoke(): void
    {
        $builder = SerializerBuilder::create();
        $builder
            ->addMetadataDir(
                (string) realpath(__DIR__ . '/../../../config/serializer'),
                'FactorioItemBrowser\ExportData'
            )
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
            ->setObjectConstructor(new ObjectConstructor())
            ->addDefaultHandlers()
            ->configureHandlers(function (HandlerRegistry $registry): void {
                $registry->registerSubscribingHandler(new ChunkedCollectionHandler());
            });

        $expectedResult = $builder->build();

        $container = $this->createMock(ContainerInterface::class);

        $factory = $this->getMockBuilder(SerializerFactory::class)
                        ->onlyMethods(['addCacheDirectory'])
                        ->getMock();
        $factory->expects($this->once())
                ->method('addCacheDirectory')
                ->with($this->identicalTo($container));

        $result = $factory($container, SerializerInterface::class);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @throws ReflectionException
     */
    public function testAddCacheDirectory(): void
    {
        $cacheDir = 'test/coverage';
        $config = [
            ConfigKey::PROJECT => [
                ConfigKey::EXPORT_DATA => [
                    ConfigKey::CACHE_DIR => $cacheDir,
                ],
            ],
        ];

        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo('config'))
                  ->willReturn($config);

        $serializerBuilder = new SerializerBuilder();
        $expectedSerializerBuilder = clone $serializerBuilder;
        $expectedSerializerBuilder->setCacheDir($cacheDir);

        $factory = new SerializerFactory();
        $this->invokeMethod($factory, 'addCacheDirectory', $container, $serializerBuilder);

        $this->assertEquals($expectedSerializerBuilder, $serializerBuilder);
    }

    /**
     * @throws ReflectionException
     */
    public function testAddCacheDirectoryWithoutConfig(): void
    {
        $config = [];

        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo('config'))
                  ->willReturn($config);

        $serializerBuilder = new SerializerBuilder();
        $expectedSerializerBuilder = clone $serializerBuilder;

        $factory = new SerializerFactory();
        $this->invokeMethod($factory, 'addCacheDirectory', $container, $serializerBuilder);

        $this->assertEquals($expectedSerializerBuilder, $serializerBuilder);
    }
}
