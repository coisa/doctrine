<?php

declare(strict_types=1);
/*
 * This file is part of coisa/doctrine.
 *
 * (c) Felipe Sayão Lobato Abreu <github@felipeabreu.com.br>
 *
 * This source file is subject to the Apache v2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CoiSA\Doctrine\DBAL\Migrations\Configuration;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Migrations\Configuration\AbstractFileConfiguration;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\Finder\MigrationFinderInterface;
use Doctrine\DBAL\Migrations\OutputWriter;
use Doctrine\DBAL\Migrations\QueryWriter;
use Psr\Container\ContainerInterface;

/**
 * Class ConfigurationFactory
 *
 * @package CoiSA\Doctrine\DBAL\Migrations\Configuration
 */
final class ConfigurationFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @throws \Doctrine\DBAL\Migrations\MigrationException
     *
     * @return AbstractFileConfiguration
     */
    public function __invoke(ContainerInterface $container): Configuration
    {
        $connection = $container->get(Connection::class);

        $outputWriter    = $container->has(OutputWriter::class) ? $container->get(OutputWriter::class) : null;
        $migrationFinder = $container->has(MigrationFinderInterface::class) ? $container->get(MigrationFinderInterface::class) : null;
        $queryWriter     = $container->has(QueryWriter::class) ? $container->get(QueryWriter::class) : null;

        $config = $container->has('config') ? $container->get('config') : null;

        if (\is_array($config)
            && \array_key_exists(Configuration::class, $config)
        ) {
            $configuration = new AbstractFileConfiguration(
                $connection,
                $outputWriter,
                $migrationFinder,
                $queryWriter
            );

            $configuration->setConfiguration($config[Configuration::class]);

            return $configuration;
        }

        return new Configuration(
            $connection,
            $outputWriter,
            $migrationFinder,
            $queryWriter
        );
    }
}
