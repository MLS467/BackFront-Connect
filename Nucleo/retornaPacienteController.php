<?php

use sistema\nucleo\Helpers;
use sistema\Paciente;

if (isset($_POST) and !empty($_POST)) {

    $cpf = $_POST['cpf'];

    if ((new Paciente())->selecionarUmRegistroCpf($cpf)) {
        echo json_encode(['teste' => true]);
        Helpers::getServer('cadastro_paciente');
    } else {
        echo json_encode(['teste' => false]);
    }
}