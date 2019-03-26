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

namespace CoiSA\Doctrine\DBAL;

use Doctrine\Common\Cache\Cache;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Logging\SQLLogger;
use Psr\Container\ContainerInterface;

/**
 * Class ConfigurationFactory
 *
 * @package CoiSA\Doctrine\DBAL
 */
final class ConfigurationFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @throws \Doctrine\DBAL\DBALException
     *
     * @return Connection
     */
    public function __invoke(ContainerInterface $container): Configuration
    {
        $configuration = new Configuration();

        if ($container->has(SQLLogger::class)) {
            $sqlLogger = $container->get(SQLLogger::class);
            $configuration->setSQLLogger($sqlLogger);
        }

        if ($container->has(Cache::class)) {
            $cache = $container->get(Cache::class);
            $configuration->setResultCacheImpl($cache);
        }

        return $configuration;
    }
}
