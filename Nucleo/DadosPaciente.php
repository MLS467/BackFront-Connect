<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\Helpers;
use sistema\Paciente;

$cpf = Helpers::LimpaDados($_GET['cpf']);


$resultado = (new Paciente())->selecionarUmRegistroCpf($cpf, 'paciente');
echo json_encode(['paciente' => $resultado]);