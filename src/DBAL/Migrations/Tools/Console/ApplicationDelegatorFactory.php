<?php declare(strict_types=1);
/*
 * This file is part of coisa/doctrine.
 *
 * (c) Felipe Sayão Lobato Abreu <github@felipeabreu.com.br>
 *
 * This source file is subject to the Apache v2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CoiSA\Doctrine\DBAL\Migrations\Tools\Console;

use Doctrine\DBAL\Migrations\Tools\Console\ConsoleRunner;
use Doctrine\DBAL\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

/**
 * Class ApplicationDelegatorFactory
 *
 * @package CoiSA\Doctrine\DBAL\Migrations\Tools\Console
 */
class ApplicationDelegatorFactory implements DelegatorFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $name
     * @param callable           $callback
     * @param null|array         $options
     *
     * @return Application|object
     */
    public function __invoke(
        ContainerInterface $container,
        $name,
        callable $callback,
        array $options = null
    ) {
        /** @var Application $application */
        $application = \call_user_func($callback);

        $helperSet           = $application->getHelperSet();
        $configurationHelper = $container->get(ConfigurationHelper::class);

        $helperSet->set($configurationHelper);

        ConsoleRunner::addCommands($application);

        return $application;
    }
}
