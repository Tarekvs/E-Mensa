<?php
require_once (__DIR__ . '/../vendor/illuminate/database/Capsule/Manager.php');
use \Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "localhost",
    "database" => "emensawerbeseite",
    "username" => "root",
    "password" => "root",
    'charset' => 'utf8'
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
