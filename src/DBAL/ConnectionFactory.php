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

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Psr\Container\ContainerInterface;

/**
 * Class ConnectionFactory
 *
 * @package CoiSA\Doctrine\DBAL
 */
final class ConnectionFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @throws \Doctrine\DBAL\DBALException
     *
     * @return Connection
     */
    public function __invoke(ContainerInterface $container): Connection
    {
        $params = $this->getParams($container);

        $configuration = $container->has(Configuration::class) ? $container->get(Configuration::class) : null;
        $eventManager  = $container->has(EventManager::class) ? $container->get(EventManager::class) : null;

        // @TODO https://www.doctrine-project.org/projects/doctrine-dbal/en/2.8/reference/types.html#types

        return DriverManager::getConnection(
            $params,
            $configuration,
            $eventManager
        );
    }

    /**
     * @param ContainerInterface $container
     *
     * @return array
     */
    private function getParams(ContainerInterface $container): array
    {
        $config = $container->has('config') ? $container->get('config') : null;

        if (\is_array($config) && \array_key_exists(Connection::class, $config)) {
            return $config[Connection::class];
        }

        if ($container->has(\PDO::class)) {
            $pdo = $container->get(\PDO::class);

            return \compact('pdo');
        }

        return [
            'url' => 'sqlite:///:memory:'
        ];
    }
}
