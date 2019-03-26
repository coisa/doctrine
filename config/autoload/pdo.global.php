<?php

declare(strict_types=1);

return [
    \PDO::class                    => [
        'dsn'      => getenv('PDO_DSN') ?: 'sqlite::memory:',
        'username' => getenv('PDO_USERNAME'),
        'passwd'   => getenv('PDO_PASSWD')
    ]
];
