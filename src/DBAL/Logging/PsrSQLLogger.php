<?php declare(strict_types=1);
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
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Class PsrSQLLogger
 *
 * @package CoiSA\Doctrine\DBAL\Logging
 */
final class PsrSQLLogger extends DebugStack
{
    /** @var LoggerInterface */
    private $logger;

    /** @var string */
    private $level;

    /**
     * SQLLoggerMiddleware constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger, string $level = LogLevel::INFO)
    {
        $this->logger = $logger;
        $this->level  = $level;
    }

    /**
     * Log queries to PSR Logger
     */
    public function stopQuery(): void
    {
        parent::stopQuery();

        if ($this->enabled) {
            $context = $this->queries[$this->currentQuery];
            unset($context['sql']);

            $this->logger->log(
                $this->level,
                $this->queries[$this->currentQuery]['sql'],
                $context
            );
        }
    }
}
