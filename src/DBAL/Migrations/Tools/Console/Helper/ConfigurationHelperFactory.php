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

namespace CoiSA\Doctrine\DBAL\Migrations\Tools\Console\Helper;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Psr\Container\ContainerInterface;

/**
 * Class ConfigurationHelperFactory
 *
 * @package CoiSA\Doctrine\DBAL\Migrations\Tools\Console\Helper
 */
class ConfigurationHelperFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ConfigurationHelper
     */
    public function __invoke(ContainerInterface $container): ConfigurationHelper
    {
        $connection    = $container->has(Connection::class) ? $container->get(Connection::class) : null;
        $configuration = $container->get(Configuration::class);

        return new ConfigurationHelper(
            $connection,
            $configuration
        );
    }
}
