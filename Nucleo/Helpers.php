<?php

namespace sistema\nucleo;

use sistema\Db;
use PDO;
use sistema\Login;

class Helpers
{


    public static function validaCredencial(): bool
    {
        if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {

            $token = $_SESSION['token'];
            $id = $_SESSION['idFuncionario'];
            $testeToken = (new Login(null))->retornaToken($id);

            if ($testeToken == $token) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public static function retornaCargo($cargo): string
    {
        switch ($cargo) {
            case '1':
                return 'medico';
                break;
            case '2':
                return 'enfermeiro';
                break;
            case '3':
                return 'atendente';
                break;
            case '4':
                return 'adm';
                break;
            default:
                //  ERRO PARA MOSTRAR NO LOGIN
                header("Location:" . Helpers::getServer('login'));
                break;
        }
    }

    public static function mostrarArray($valor): void
    {
        echo "<pre>";
        print_r($valor);
        echo "</pre>";
    }

    public static function selecionarTodasTabelas()
    {
        $sql = "SELECT * FROM dados_temporarios as dt JOIN 
        paciente p ON (dt.id_paciente = p.id) JOIN 
        triagem AS t ON (dt.id_triagem = t.id) LIMIT 100";

        $query = Db::preparar($sql);
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function selecionarDadosTemporarios($id)
    {
        $sql = "SELECT * FROM dados_temporarios as dt JOIN 
        paciente p ON (dt.id_paciente = p.id) JOIN 
        triagem AS t ON (dt.id_triagem = t.id) 
        WHERE dt.id_paciente = $id LIMIT 100";

        $query = Db::preparar($sql);
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    /**
     * Exibe a data atual formatada com o nome do dia da semana, o dia do mês e o mês por extenso.
     *
     * @return void
     */
    public static function dataFormatada()
    {
        $d = date('w');
        $dm = date('d');
        $ds = date('n') - 1;
        $y = date('Y');

        $Meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        $DiasSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];

        echo "$DiasSemana[$d],  $dm  $Meses[$ds] de $y";
    }


    /**
     * Obtém a URL completa do servidor com base no ambiente (desenvolvimento ou produção).
     *
     * @param string|null $url URL a ser concatenada com o ambiente. Se for nula, apenas o ambiente será retornado.
     * @return string URL completa com base no ambiente e na URL fornecida.
     */
    public static function getServer(string $url = null): string
    {
        $servidor = $_SERVER['SERVER_NAME'];
        $ambiente = $servidor == 'localhost' ? URL_DESENVOLVIMENTO : null;

        if (!str_starts_with($url, "/"))
            return $ambiente . '/' . $url;

        return $ambiente . $url;
    }


    /**
     * Calcula a diferença de tempo entre a data fornecida e o momento atual.
     *
     * @param string|null $data A data inicial no formato "Y-m-d H:i:s" (padrão: null).
     * @return string A diferença de tempo formatada como string.
     */
    public static function diferencaTempo(string $data = null): string
    {
        $dataRecebida = strtotime($data);
        $agora = strtotime(date("Y-m-d H:i:s"));

        $segundos = $agora - $dataRecebida;
        $minutos = round(($segundos / 60));
        $horas = round(($minutos / 60));
        $dias = round(($horas / 24));
        $mes = round(($dias / 30.4167));
        $ano = round(($mes / 12));

        if ($minutos < 1) {
            return round($segundos) == 1 ? "Há 1 Segundo" : "Há $segundos Segundos";
        } else if ($horas < 1) {
            return round($minutos) == 1 ? "Há 1 minuto" : "Há $minutos minutos";
        } else if ($dias < 1) {
            return round($horas) == 1 ? "Há 1 hora" : "Há $horas horas";
        } else if ($mes < 1) {
            return round($dias) == 1 ? "Ontem" : "Há $dias dias";
        } else if ($ano < 1) {
            return round($mes) == 1 ? "Há 1 mês" : "Há $mes mêses";
        } else if ($ano >= 1) {
            return round($ano) == 1 ? "Há 1 ano" : "Há $ano anos";
        }
    }

    public static function limpaArrayPost(array $dados): array | bool
    {
        if (!empty($dados)) {

            foreach ($dados as $key => $value) {
                $dados[$key] = Helpers::LimpaDados($value);
            }

            return $dados;
        } else {
            return false;
        }
    }


    public static function LimpaDados($dados)
    {
        $dados = trim($dados);
        $dados = stripslashes($dados);
        $dados = strip_tags($dados);
        $dados = htmlspecialchars($dados);
        return $dados;
    }
}