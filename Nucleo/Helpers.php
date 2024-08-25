<?php

namespace sistema\nucleo;

use sistema\Db;
use PDO;

class Helpers
{

    public static function mostrarArray(array $arr = null, object $obj = null): void
    {
        $valor = ($arr != null ? $arr : $obj);
        echo "<pre>";
        print_r($valor);
        echo "</pre>";
    }

    public static function selecionarTodasTabelas()
    {
        $sql = "SELECT 
        *,
        fa.id as ID_FA
            -- fa.*, 
            -- fa.id as 'id_fichaAtendimento',
            -- p.*, 
            -- t.*, 
            -- sv.*, 
            -- db.*, 
            -- e.*
        FROM ficha_atendimento AS fa
        INNER JOIN paciente p ON fa.idPaciente = p.id
        INNER JOIN triagem t ON fa.idTriagem = t.id
        INNER JOIN sinais_vitais sv ON t.id_sinais_vitais_fk = sv.id
        INNER JOIN dados_basicos db ON t.id_dados_basicos_fk = db.id
        INNER JOIN enfermeiro e ON sv.id_enfermeiro = e.id
        WHERE fa.status = 'pendente'
        LIMIT 100";



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