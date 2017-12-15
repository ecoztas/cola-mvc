<?php

define('DIRECTORY_SEPERATOR', '/');
define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPERATOR);
define('APP_PATH', ROOT_PATH .'app' . DIRECTORY_SEPERATOR);
define('CORE_PATH', ROOT_PATH .'core' . DIRECTORY_SEPERATOR);
define('ERROR_PATH', CORE_PATH . 'errors' . DIRECTORY_SEPERATOR . 'error.php');
define('VERSION', '0.0.1 Alfa-1');

require_once(APP_PATH . 'config' . DIRECTORY_SEPERATOR . 'PHPini.php');
require_once(CORE_PATH . 'system' . DIRECTORY_SEPERATOR . 'Cola.php');

Cola::run();