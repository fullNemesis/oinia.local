<?php
return [
    'database' => [
        'name' => 'cursophp',
        'username' => 'usercurso',
        'password' => 'php',
        'connection' => 'mysql:host=localhost',
        'options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        ]
    ],
    'mailer' => [
        'smtp_server' => 'smtp.hotmail.com',
        'smtp_port' => ' 587',
        'smtp_security' => 'tls',
        'username' => 'andreahernande_job@hotmail.com',
        'password' => 'Inmortal91.',   // no sé si está bien la contraseña !!!! 
        'email' => 'andreahernande_job@hotmail.com',
        'nombre' => 'info'
    ],
    'logs' => [
        'filename' => 'curso.log',
        'level' => \Monolog\Logger::INFO
    ],
    'routes' => [
        'filename' => 'routes.php'
    ],
    'project' => [
        'namespace' => 'dwes'
    ],
    'security' => [
        'roles' => [
        'ROLE_ADMIN' => 3,
        'ROLE_USER' => 2,
        'ROLE_ANONYMOUS' => 1
        ]
    ]
];
