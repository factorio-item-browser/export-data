<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData;

use BluePsyduck\JmsSerializerFactory\JmsSerializerFactory;
use FactorioItemBrowser\ExportData\Constant\ConfigKey;
use FactorioItemBrowser\ExportData\Serializer\Construction\ObjectConstructor;
use FactorioItemBrowser\ExportData\Serializer\Handler\ChunkedCollectionHandler;
use FactorioItemBrowser\ExportData\Serializer\Handler\LocalisedStringHandler;
use Interop\Container\ContainerInterface;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;

/**
 * The test case for the serializing and deserializing of objects.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
abstract class SerializerTestCase extends TestCase
{
    private SerializerInterface $serializer;

    /**
     * @throws ContainerExceptionInterface
     */
    protected function setUp(): void
    {
        $config = require(__DIR__ . '/../../config/export-data.php');

        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->any())
                  ->method('get')
                  ->willReturnMap([
                      ['config', $config],
                      [ChunkedCollectionHandler::class, new ChunkedCollectionHandler()],
                      [IdenticalPropertyNamingStrategy::class, new IdenticalPropertyNamingStrategy()],
                      [LocalisedStringHandler::class, new LocalisedStringHandler()],
                      [ObjectConstructor::class, new ObjectConstructor()],
                  ]);

        $serializerFactory = new JmsSerializerFactory(ConfigKey::MAIN, ConfigKey::SERIALIZER);
        $this->serializer = $serializerFactory($container, SerializerInterface::class); // @phpstan-ignore-line
    }

    public function testSerialize(): void
    {
        $object = $this->getObject();
        $expectedData = $this->getData();

        $result = $this->serializer->serialize($object, 'json');

        $this->assertEquals($expectedData, json_decode($result, true));
    }

    public function testSerializeHash(): void
    {
        $object = $this->getObject();
        $expectedData = $this->getHashData();

        $result = $this->serializer->serialize($object, 'json', SerializationContext::create()->setGroups(['Hash']));

        $this->assertEquals($expectedData, json_decode($result, true));
    }

    public function testDeserialize(): void
    {
        $data = $this->getData();
        $expectedObject = $this->getObject();

        $result = $this->serializer->deserialize((string) json_encode($data), get_class($expectedObject), 'json');

        $this->assertEquals($expectedObject, $result);
    }

    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    abstract protected function getObject(): object;

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    abstract protected function getData(): array;

    /**
     * Returns the serialized data in case of hashing.
     * @return array<mixed>
     */
    abstract protected function getHashData(): array;
}
