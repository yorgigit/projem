<?php
return array
(
    'default' => array
    (
        'type'       => 'PDO',
        'connection' => array(
            'dsn'        => 'mysql:host=localhost;dbname=fef',
            'username'   => 'root',
            'password'   => 'yorgi',
            'persistent' => FALSE,
        ),
        'table_prefix' => 't_',
        'charset'      => 'utf8',
        'profiling'    => TRUE,
    ),
);