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

namespace CoiSA\Doctrine\DBAL\Tools\Console\Helper;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Psr\Container\ContainerInterface;

/**
 * Class ConnectionHelperFactory
 *
 * @package CoiSA\Doctrine\DBAL\Tools\Console\Helper
 */
class ConnectionHelperFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ConnectionHelper
     */
    public function __invoke(ContainerInterface $container): ConnectionHelper
    {
        $connection = $container->get(Connection::class);

        return new ConnectionHelper($connection);
    }
}
