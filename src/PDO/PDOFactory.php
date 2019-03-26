<?php
/**
 * @author Felipe Sayão Lobato Abreu <contato@felipeabreu.com.br>
 *
 * @package Console\Container\Factory
 */

declare(strict_types=1);
/*
 * This file is part of coisa/doctrine.
 *
 * (c) Felipe Sayão Lobato Abreu <github@felipeabreu.com.br>
 *
 * This source file is subject to the Apache v2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CoiSA\Doctrine\PDO;

use Psr\Container\ContainerInterface;

/**
 * Class PDOFactory
 *
 * @package CoiSA\Doctrine\PDO
 */
final class PDOFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return \PDO
     */
    public function __invoke(ContainerInterface $container): \PDO
    {
        $config    = $container->get('config');
        $pdoConfig = $config[\PDO::class];

        return new \PDO(
            $pdoConfig['dsn'],
            $pdoConfig['username'],
            $pdoConfig['passwd'],
            $pdoConfig['options'] ?? []
        );
    }
}
