<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Serializer;

use FactorioItemBrowser\ExportData\Constant\ConfigKey;
use FactorioItemBrowser\ExportData\Serializer\Handler\ChunkedCollectionHandler;
use Interop\Container\ContainerInterface;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * The factory for the JMS serializer.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SerializerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array<mixed>|null $options
     * @return SerializerInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): SerializerInterface
    {
        $builder = SerializerBuilder::create();
        $builder
            ->addMetadataDir(
                (string) realpath(__DIR__ . '/../../config/serializer'),
                'FactorioItemBrowser\ExportData'
            )
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
            ->addDefaultHandlers()
            ->configureHandlers(function (HandlerRegistry $registry): void {
                $registry->registerSubscribingHandler(new ChunkedCollectionHandler());
            });

        $this->addCacheDirectory($container, $builder);

        return $builder->build();
    }

    protected function addCacheDirectory(ContainerInterface $container, SerializerBuilder $builder): void
    {
        $config = $container->get('config');
        $libraryConfig = $config[ConfigKey::PROJECT][ConfigKey::EXPORT_DATA] ?? [];
        $cacheDir = (string) ($libraryConfig[ConfigKey::CACHE_DIR] ?? '');

        if ($cacheDir !== '') {
            $builder->setCacheDir($cacheDir);
        }
    }
}
