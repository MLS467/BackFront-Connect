<?php
require_once('../vendor/autoload.php');

use sistema\nucleo\Helpers;
use sistema\Triagem as Triagem;

$dados = array(
    'nome' => $_POST['nome'] ?? '',
    'idade' => $_POST['idade'] ?? '',
    'cpf' => $_POST['cpf'] ?? '',
    'contato_emergencia' => $_POST['contato_emergencia'] ?? '',
    'condicoes_medicas' => $_POST['condicoes_medicas'] ?? '',
    'alergias' => $_POST['alergias'] ?? '',
    'medicamentos' => $_POST['medicamentos'] ?? '',
    'historico_cirurgias' => $_POST['historico_cirurgias'] ?? '',
    'data_hora_chegada' => $_POST['data_hora_chegada'] ?? '',
    'motivo_visita' => $_POST['motivo_visita'] ?? ''
);

if ((new Triagem($dados))->inserirDados()) {
    $_SESSION['cpf'] = $dados['cpf'];
    header("location:" . Helpers::getServer('cadastro_sinais_vitais'));
} else {
    echo "Houve um problema para inserir os dados!";
}