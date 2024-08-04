<?php
require_once('../vendor/autoload.php');
$_SESSION['atendente'] = 1;
$idAtendente = $_SESSION['atendente'];

use sistema\Atendente;
use sistema\nucleo\Helpers;
use sistema\DadosBasicos as DB;
use sistema\nucleo\DadosTemporarios;

$dados = array(
    'nome' => $_POST['nome'] ?? '',
    'idade' => $_POST['idade'] ?? '',
    'cpf' => $_POST['cpf'] ?? '',
    'contato_emergencia' => $_POST['contato_emergencia'] ?? '',
    'condicoes_medicas' => $_POST['condicoes_medicas'] ?? '',
    'alergias' => $_POST['alergias'] ?? '',
    'medicamentos_em_uso' => $_POST['medicamentos'] ?? '',
    'historico_de_cirurgia' => $_POST['historico_cirurgias'] ?? '',
    'data_hora_chegada' => $_POST['data_hora_chegada'] ?? '',
    'motivo_da_visita' => $_POST['motivo_visita'] ?? '',
    'id_atendente_fk' => $idAtendente
);


$dadosBasicos = new DB($dados);

echo "<pre>";
print_r($dados);
echo "</pre>";

if ($dadosBasicos->inserirDados()) {
    if ((new DadosTemporarios())->criar($dadosBasicos->getId(), $dadosBasicos->getId()))
        header("location:" . Helpers::getServer('cadastro_sinais_vitais'));
    else
        echo "Houve um problema para inserir os dados!";
} else {
    echo "Houve um problema para inserir os dados!";
}