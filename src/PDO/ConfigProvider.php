<?php declare(strict_types=1);
/*
 * This file is part of coisa/doctrine.
 *
 * (c) Felipe Sayão Lobato Abreu <github@felipeabreu.com.br>
 *
 * This source file is subject to the Apache v2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CoiSA\Doctrine\PDO;

/**
 * Class ConfigProvider
 *
 * @package CoiSA\Doctrine\PDO
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
            'factories'  => [
                \PDO::class => PDOFactory::class
            ],
        ];
    }
}
