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
        echo $this->template->renderizar('LoginView.html', ['erro' => $id, 'login' => true]);
    }

    public function visualizar(): void
    {

        echo $this->template->renderizar('visualizarRegistrosView.html', ['res' => Helpers::selecionarTodasTabelas(), 'isForm' => true]);
    }
}