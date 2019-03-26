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

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Class PsrSQLLoggerFactory
 *
 * @package CoiSA\Doctrine\DBAL\Logging
 */
final class PsrSQLLoggerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return PsrSQLLogger
     */
    public function __invoke(ContainerInterface $container): PsrSQLLogger
    {
        $logger = $container->get(LoggerInterface::class);
        $config = $container->has('config') ? $container->get('config') : [];

        return new PsrSQLLogger(
            $logger,
            $config[PsrSQLLogger::class]['level'] ?? LogLevel::INFO
        );
    }
}
