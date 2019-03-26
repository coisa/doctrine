<?php declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Zend\ServiceManager\ServiceManager;

// Load settings
$config = require __DIR__ . '/config.php';

// Build container
$container = new ServiceManager();

// Configure dependencies
$container->configure($config['dependencies']);

// Inject config
$container->setService('config', $config);

return $container;
