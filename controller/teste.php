<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\DadosTemporarios;

print_r((new DadosTemporarios())->criar(1, '1'));