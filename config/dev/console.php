<?php

declare(strict_types=1);

use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool;

return [
    'config' => [
        'console' => [
            'commands' => [
                ValidateSchemaCommand::class,
                SchemaTool\DropCommand::class,
            ]
        ]
    ]
];
