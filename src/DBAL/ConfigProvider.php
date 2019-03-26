<?php declare(strict_types=1);
/*
 * This file is part of coisa/doctrine.
 *
 * (c) Felipe Sayão Lobato Abreu <github@felipeabreu.com.br>
 *
 * This source file is subject to the Apache v2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CoiSA\Doctrine\DBAL;

use CoiSA\Doctrine\DBAL\Logging\LoggerChainFactory;
use CoiSA\Doctrine\DBAL\Logging\PsrSQLLogger;
use CoiSA\Doctrine\DBAL\Logging\PsrSQLLoggerFactory;
use CoiSA\Doctrine\DBAL\Tools\Console\ApplicationDelegatorFactory;
use CoiSA\Doctrine\DBAL\Tools\Console\Helper\ConnectionHelperFactory;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Logging\DebugStack;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\SQLLogger;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Symfony\Component\Console\Application;

/**
 * Class ConfigProvider
 *
 * @package CoiSA\Doctrine\DBAL
 */
final class ConfigProvider
{
    /**
     * Provide component configurations
     *
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies()
        ];
    }

    /**
     * Provide component dependency mappings
     *
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            'aliases'    => [
                SQLLogger::class => LoggerChain::class,
            ],
            'invokables' => [
                DebugStack::class => DebugStack::class,
            ],
            'factories'  => [
                Connection::class       => ConnectionFactory::class,
                Configuration::class    => ConfigurationFactory::class,
                PsrSQLLogger::class     => PsrSQLLoggerFactory::class,
                LoggerChain::class      => LoggerChainFactory::class,
                ConnectionHelper::class => ConnectionHelperFactory::class,
            ],
            'delegators' => [
                Application::class => [
                    ApplicationDelegatorFactory::class
                ]
            ],
        ];
    }
}
