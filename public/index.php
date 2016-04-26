<?php
session_start();
require_once __DIR__ . '/../app/bootstrap.php';

$url = isset($_GET['url']) ? $_GET['url'] : null;
$app = (new \App\Core\App())->run($url);

