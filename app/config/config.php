<?php

$default = [
    'path'     => 'http://127.0.0.1/cola-mvc/',
    'page'     => 'Main',
    'method'   => 'main',
    'unmethod' => '_lost'
];

$database = [
    'host'    => 'localhost',
    'user'    => 'root',
    'password'=> '',
    'database'=> '',
    'charset' => 'utf8'
];

$cookie = [
    'name'    => 'test',
    'value'   => 'empty',
    'expire'  => null,
    'path'    => '/',
    'domain'  => null,
    'secure'  => false,
    'httponly'=> false
];

$upload = [
    'maxFileSize'      => 5120000,
    'allowedFileTypes' => null,
    'fileName'         => null,
    'originalFileName' => false,
    'path'             => 'public/upload/',
    'override'         => true
];

$autoload = [
    'libraries' => [],
    'helpers'   => [],
    'plugins'   => []
];