<?php
// Incluir a definição da classe Triagem, se não estiver carregada automaticamente
require_once('../vendor/autoload.php');

use sistema\Triagem as Triagem;
// Dados recebidos via $_POST (ou outro array associativo)
$dadosFormulario = [
    'idade' => isset($_POST['idade']) ? (int)$_POST['idade'] : null,
    'contato_emergencia' => $_POST['contato_emergencia'] ?? null,
    'condicoes_medicas' => $_POST['condicoes_medicas'] ?? null,
    'alergias' => $_POST['alergias'] ?? null,
    'medicamentos' => $_POST['medicamentos'] ?? null,
    'historico_cirurgias' => $_POST['historico_cirurgias'] ?? null,
    'data_hora_chegada' => $_POST['data_hora_chegada'] ?? null,
    'motivo_visita' => $_POST['motivo_visita'] ?? null,
    'sintomas' => $_POST['sintomas'] ?? null,
    'gravidade' => isset($_POST['gravidade']) ? (int)$_POST['gravidade'] : null,
    'tempo_inicio' => $_POST['tempo_inicio'] ?? null,
    'localizacao_dor' => $_POST['localizacao_dor'] ?? null,
    'sintomas_associados' => $_POST['sintomas_associados'] ?? null,
    'pressao_arterial' => $_POST['pressao_arterial'] ?? null,
    'frequencia_cardiaca' => $_POST['frequencia_cardiaca'] ?? null,
    'temperatura' => $_POST['temperatura'] ?? null,
    'saturacao' => $_POST['saturacao'] ?? null,
    'frequencia_respiratoria' => $_POST['frequencia_respiratoria'] ?? null,
    'intensidade_dor' => isset($_POST['intensidade_dor']) ? (int)$_POST['intensidade_dor'] : null,
    'natureza_dor' => $_POST['natureza_dor'] ?? null,
    'observacoes' => $_POST['observacoes'] ?? null,
    'cpf' => $_POST['cpf'] ?? null
];

if ((new Triagem($dadosFormulario))->inserirDados()) {
    $_SESSION['cpf'] = $dadosFormulario['cpf'];
    header("location:../view/html/cadastrarPacienteView.html");
} else {
    echo "Houve um problema para inserir os dados!";
}