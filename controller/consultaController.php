<?php
require_once __DIR__ . "/../vendor/autoload.php";


use sistema\Consulta;
use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;
// pegando id do funcionario ao logar
$id_medico = $_SESSION['idFuncionario'];

// lendo os dados temporarios para concluir a consulta
$dadosRecuperados = (new DadosTemporarios())->lerTodosPorStatus('concluido');

if (isset($_POST) && !empty($_POST)) {
    // fazendo a limpeza dos dados recebidos
    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);
    // testando e pegando os dados para serem adicionados
    if (!empty($dadosRecuperados[0]) && !empty($id_medico)) {

        $dados = [
            'id_medico' => $id_medico,
            'id_paciente' => $dadosRecuperados[0]->id_paciente,
            'id_triagem' => $dadosRecuperados[0]->id_triagem,
            'dataHora' => date('Y-m-d H:i:s'),
            'diagnostico' => $input['diagnostico'],
            'tratamento' => $input['tratamento'],
            'observacoes' => $input['observacoes'],
            'status' => $input['status']
        ];

        // faz inserção dos dados e atualiza a tabela de dados temporarios caso controrio vai pra not found
        try {
            $consulta = new Consulta($dados);
            if ($consulta->inserirDados()) {
                $dadosConcluidos = (new DadosTemporarios())->lerTodosPorStatus('Paciente/Triagem');
                // deleta os dados temporarios por segurança e integridade dos dados
                (new DadosTemporarios())->deletar($dadosRecuperados[0]->id);
                header("Location:" . Helpers::getServer('consulta_realizada'));
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Erro ao inserir dados na consulta. Por favor, tente novamente.'
                ]);
            }
        } catch (\Throwable $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Erro inesperado: ' . $e->getMessage()
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Dados inválidos ou sessão expirada. Por favor, tente novamente.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Dados não recebidos. Por favor, tente novamente.'
    ]);
    Helpers::getServer('404');
}