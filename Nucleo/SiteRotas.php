<?php

namespace sistema\rotas;

use sistema\controlador\Controlador;
use sistema\Login;
use sistema\nucleo\Helpers;
use sistema\Paciente;

class SiteRotas extends Controlador
{
    public function __construct()
    {
        parent::__construct('view/html');
    }

    public function home(): void
    {
        echo $this->template->renderizar('home.html', ['titulo' => 'Home']);
    }

    public function dados_basicos(): void
    {
        $token = $_SESSION['token'];
        $id = $_SESSION['id'];
        $testeToken = (new Login(null))->retornaToken($id);

        if ($testeToken == $token) {
            $verificacao = true;
        } else {
            $verificacao = false;
        }
        echo $this->template->renderizar('dadosBasicosView.html', ['verificar' => $verificacao, 'isForm' => true]);
    }

    public function cadastrarPaciente(): void
    {
        $token = $_SESSION['token'];
        $id = $_SESSION['id'];
        $testeToken = (new Login(null))->retornaToken($id);

        if ($testeToken == $token) {
            $verificacao = true;
        } else {
            $verificacao = false;
        }
        echo $this->template->renderizar('cadastrarPacienteView.html', ['verificar' => $verificacao, 'isForm' => true]);
    }

    public function cadastrarFuncionario(): void
    {
        echo $this->template->renderizar('cadastrarFuncionarioView.html', ['teste' => 'teste']);
    }

    public function cadastro_sv(): void
    {
        $token = $_SESSION['token'];
        $id = $_SESSION['id'];
        $testeToken = (new Login(null))->retornaToken($id);

        if ($testeToken == $token) {
            $verificacao = true;
        } else {
            $verificacao = false;
        }

        echo $this->template->renderizar('sinaisVitaisView.html', ['verificar' => $verificacao, 'isForm' => true]);
    }

    public function notFound(): void
    {
        echo $this->template->renderizar('notFound.html', ['erro' => 'Página não encontrada!']);
    }

    public function consulta(): void
    {
        if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {

            $token = $_SESSION['token'];
            $id = $_SESSION['id'];
            $testeToken = (new Login(null))->retornaToken($id);

            if ($testeToken == $token) {
                $verificacao = true;
            } else {
                $verificacao = false;
            }
        } else {
            $verificacao = false;
        }

        echo $this->template->renderizar('consultaView.html', ['verificar' => $verificacao, 'isForm' => true]);
    }

    public function login(): void
    {
        $id = null;
        echo $this->template->renderizar('LoginView.html', ['erro' => $id]);
    }

    public function visualizar(): void
    {

        $pacientes = array(
            array(
                'nome' => 'João Silva',
                'dataNascimento' => '1985-03-15',
                'sexo' => 'Masculino',
                'idade' => 39,
                'endereco' => 'Rua das Flores, 123, Centro',
                'telefone' => '(11) 98765-4321',
                'email' => 'joao.silva@example.com',
                'naturalidade' => 'São Paulo',
                'cpf' => '123.456.789-00',
                'contato_emergencia' => 'Maria Silva - (11) 91234-5678',
                'sintomas' => 'Dor de cabeça, febre',
                'gravidade' => 'Moderada',
                'tempo_inicio' => '2 horas',
                'localizacao_dor' => 'Frente da cabeça',
                'pressao_arterial' => '120/80 mmHg',
                'frequencia_cardiaca' => '80 bpm',
                'temperatura' => '37.8°C',
                'saturacao' => '98%',
                'frequencia_respiratoria' => '16 rpm',
                'intensidade_da_dor' => '3',
                'observacoes' => 'Paciente apresenta sinais de gripe.',
                'natureza_dor' => 'Latejante',
                'id_triagem' => 101
            ),
            array(
                'nome' => 'Ana Oliveira',
                'dataNascimento' => '1990-07-22',
                'sexo' => 'Feminino',
                'idade' => 33,
                'endereco' => 'Avenida Brasil, 456, Jardim das Palmeiras',
                'telefone' => '(21) 99876-5432',
                'email' => 'ana.oliveira@example.com',
                'naturalidade' => 'Rio de Janeiro',
                'cpf' => '987.654.321-00',
                'contato_emergencia' => 'Carlos Oliveira - (21) 97654-3210',
                'sintomas' => 'Dor abdominal, náuseas',
                'gravidade' => 'Alta',
                'tempo_inicio' => '30 minutos',
                'localizacao_dor' => 'Abdômen inferior',
                'pressao_arterial' => '110/70 mmHg',
                'frequencia_cardiaca' => '90 bpm',
                'temperatura' => '38.5°C',
                'saturacao' => '97%',
                'frequencia_respiratoria' => '18 rpm',
                'intensidade_da_dor' => '7',
                'observacoes' => 'Paciente com histórico de gastrite.',
                'natureza_dor' => 'Cólica',
                'id_triagem' => 102
            )
        );

        echo $this->template->renderizar('visualizarRegistrosView.html', ['res' => $pacientes]);
    }
}