<?php
// AQUI SERVE PARA DEBUG
use sistema\nucleo\Helpers;
use sistema\Paciente;

require_once __DIR__ . "/../vendor/autoload.php";
include "triagemController.php";

Helpers::mostrarArray(null, $triagem);

echo "TESTE";