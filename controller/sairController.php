<?php

use sistema\nucleo\Helpers;

require_once __DIR__ . "/../vendor/autoload.php";
session_unset();
session_destroy();
header("Location:" . Helpers::getServer('login'));