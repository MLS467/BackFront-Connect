<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\Helpers;
//faz a sanitização dos dados advindos do formulário
$input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$input = Helpers::limpaArrayPost($input);
$img = $_FILES['img']['name'];

try {
    // tenta e tasta o dados vindo do input após a limpeza
    if (!empty($input) and isset($input)) {
        $input['img'] = !empty($img) ? $img : 'NULL';
        $op = strtolower($input['cargo']);
        // faz um switch de acordo com o cargo
        switch ($op) {
            case 'medico':
                // chama a função de atualizaçãp 
                if (atualizaDeAcordo($input['id'], $input['cargo'], $input))
                    header("Location:" . Helpers::getServer('listar_funcionario'));
                break;
            case 'enfermeiro':
                if (atualizaDeAcordo($input['id'], $input['cargo'], $input))
                    header("Location:" . Helpers::getServer('listar_funcionario'));
                break;
            case 'atendente':
                Helpers::mostrarArray($input);
                if (atualizaDeAcordo($input['id'], $input['cargo'], $input))
                    header("Location:" . Helpers::getServer('listar_funcionario'));
                break;

            default:
                header("Location:" . Helpers::getServer('404'));
                break;
        }
    }
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Erro inesperado: ' . $e->getMessage()
    ]);
}

// funçao para atualizar os dados de acordo com o cargo
function atualizaDeAcordo($id, $cargo, $dados): bool
{
    try {
        $namespace = "sistema\\";
        $classe = $namespace . ucfirst($cargo);

        if (class_exists($classe)) {
            $classeVaria = new $classe($dados);

            if ($classeVaria->atualizarDados($id)) {
                echo json_encode(['resposta' => 'Dados atualizados com sucesso!']);
                return true;
            } else {
                echo json_encode(['resposta' => 'Erro ao atualizar!']);
                return false;
            }
        } else {
            echo json_encode(['resposta' => 'Classe não encontrada!']);
            return false;
        }
    } catch (PDOException $e) {
        echo json_encode(['resposta' => 'Erro ao atualizar: ' . $e->getMessage()]);
        return false;
    }
}