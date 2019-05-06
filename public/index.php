<?php
session_start();
use \Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';
require '../src/config/db.php';
require '../src/routes/routes.php';

$app->run();
