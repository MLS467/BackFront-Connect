<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\Adm;
use sistema\nucleo\Helpers;

$input = filter_input(INPUT_POST, FILTER_DEFAULT);
$input = Helpers::limpaArrayPost($_POST);
Helpers::mostrarArray($input);
if (
    isset($input['cargo']) and
    isset($input) and
    !empty($input) and
    !empty($input['cargo'])
) {
    if ((new Adm(null))->adicionarNovoFuncionario($input['cargo'], $input)) {
        header("Location:" . Helpers::getServer('listar_funcionario'));
    } else {
        echo "Deu ruim 1";
        exit;
    };
} else {
    echo "Deu ruim 2";
    exit;
}