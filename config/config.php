<?php declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

$aggregator = new ConfigAggregator(
    [
        new PhpFileProvider('config/autoload/{{,*.}global,{,*.}local}.php'),
        # PDO
        CoiSA\Doctrine\Doctrine\PDO\ConfigProvider::class,
        # EventManager
        CoiSA\Doctrine\Doctrine\Common\ConfigProvider::class,
        # DBAL
        CoiSA\Doctrine\Doctrine\DBAL\ConfigProvider::class,
        # DBAL Migrations
        CoiSA\Doctrine\Doctrine\DBAL\Migrations\ConfigProvider::class,
    ]
);

return $aggregator->getMergedConfig();
