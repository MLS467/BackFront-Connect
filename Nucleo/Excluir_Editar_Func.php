<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\Atendente;
use sistema\Enfermeiro;
use sistema\Medico;
use sistema\nucleo\Helpers;

$id = $_GET['E_E_Funcionario'];
$cargo = strtolower($_GET['cargo']);

function excluiTudo($id, $objClass, $cargoMsg)
{
    // Cria uma instância da classe
    $instancia = new $objClass(null);

    $foto = $instancia->selecionarUmRegistro($id);
    Helpers::mostrarArray($foto);
    Helpers::excluiImg($foto['img']);
    if ($instancia->deletarUmRegistro($id)) {
        echo json_encode(['resposta' => $cargoMsg . ' excluído com sucesso!']);
    } else {
        echo json_encode(['resposta' => 'Falha ao excluir imagem do ' . $cargoMsg . '!']);
    }
}

switch ($cargo) {
    case 'medico':
        excluiTudo($id, 'sistema\Medico', 'médico');
        break;

    case 'enfermeiro':
        excluiTudo($id, 'sistema\Enfermeiro', 'enfermeiro');
        break;

    case 'atendente':
        excluiTudo($id, 'sistema\Atendente', 'atendente');
        break;

    default:
        echo json_encode(['resposta' => 'Cargo inválido ou não reconhecido!']);
        break;
}