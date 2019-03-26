<?php declare(strict_types=1);
/*
 * This file is part of coisa/doctrine.
 *
 * (c) Felipe Sayão Lobato Abreu <github@felipeabreu.com.br>
 *
 * This source file is subject to the Apache v2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CoiSA\Doctrine\DBAL\Migrations;

use CoiSA\Doctrine\DBAL\Migrations\Configuration\ConfigurationFactory;
use CoiSA\Doctrine\DBAL\Migrations\Tools\Console\ApplicationDelegatorFactory;
use CoiSA\Doctrine\DBAL\Migrations\Tools\Console\Helper\ConfigurationHelperFactory;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Symfony\Component\Console\Application;

/**
 * Class ConfigProvider
 *
 * @package CoiSA\Doctrine\DBAL\Migrations
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
            'factories' => [
                Configuration::class       => ConfigurationFactory::class,
                ConfigurationHelper::class => ConfigurationHelperFactory::class
            ],
            'delegators' => [
                Application::class => [
                    ApplicationDelegatorFactory::class
                ]
            ],
        ];
    }
}
