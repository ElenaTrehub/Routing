<?php
require_once '../vendor/autoload.php';



$app = new \app\core\Route();
$app->SetPath($_SERVER['REQUEST_URI']);
$app->Start();
