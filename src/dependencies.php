<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//Init database
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule();
$capsule->addConnection([
    'driver'   => 'mysql',
    'host'     => '127.0.0.1',
    'database' => 'php',
    'username' => 'php',
    'password' => 'php_course',
    'charset'  => 'utf8',
    'collation'=> 'utf8_unicode_ci',
    'prefix'   =>'',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
