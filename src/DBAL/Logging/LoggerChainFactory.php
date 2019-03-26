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

namespace CoiSA\Doctrine\DBAL\Logging;

use Doctrine\DBAL\Logging\DebugStack;
use Doctrine\DBAL\Logging\EchoSQLLogger;
use Doctrine\DBAL\Logging\LoggerChain;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class PsrSQLLoggerFactory
 *
 * @package CoiSA\Doctrine\DBAL\Logging
 */
final class LoggerChainFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return LoggerChain
     */
    public function __invoke(ContainerInterface $container): LoggerChain
    {
        $loggerChain = new LoggerChain();

        if ($container->has(LoggerInterface::class)
            && $container->has(PsrSQLLogger::class)
        ) {
            $logger = $container->get(PsrSQLLogger::class);
            $loggerChain->addLogger($logger);
        }

        if ($container->has(DebugStack::class)) {
            $logger = $container->get(DebugStack::class);
            $loggerChain->addLogger($logger);
        }

        if ($container->has(EchoSQLLogger::class)) {
            $logger = $container->get(EchoSQLLogger::class);
            $loggerChain->addLogger($logger);
        }

        return $loggerChain;
    }
}
