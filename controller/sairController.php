<?php

use sistema\nucleo\Helpers;
// destroi as session 
require_once __DIR__ . "/../vendor/autoload.php";
session_unset();
session_destroy();
header("Location:" . Helpers::getServer('login'));