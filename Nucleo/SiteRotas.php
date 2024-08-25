<?php

namespace sistema\rotas;

use sistema\controlador\Controlador;
use sistema\Login;
use sistema\nucleo\Helpers;
use sistema\Paciente;
use sistema\nucleo\DadosTemporarios;

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


    public function cadastrarPaciente(): void
    {


        echo $this->template->renderizar('cadastrarPacienteView.html', ['isForm' => true]);


        // $token = $_SESSION['token'];
        // $id = $_SESSION['id'];
        // $testeToken = (new Login(null))->retornaToken($id);

        // if ($testeToken == $token) {
        //     $verificacao = true;
        // } else {
        //     $verificacao = false;
        // } 'verificar' => $verificacao
    }

    public function cadastrarFuncionario(): void
    {
        echo $this->template->renderizar('cadastrarFuncionarioView.html', ['teste' => 'teste']);
    }

    public function triagem(): void
    {
        // $token = $_SESSION['token'];
        // $id = $_SESSION['id'];
        // $testeToken = (new Login(null))->retornaToken($id);

        // if ($testeToken == $token) {
        //     $verificacao = true;
        // } else {
        //     $verificacao = false;
        // }


        echo $this->template->renderizar('TriagemView.html', ['isForm' => true]);
    }

    public function notFound(): void
    {
        echo $this->template->renderizar('notFound.html', ['erro' => 'Página não encontrada!']);
    }

    public function consulta(): void
    {
        // if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {

        //     $token = $_SESSION['token'];
        //     $id = $_SESSION['id'];
        //     $testeToken = (new Login(null))->retornaToken($id);

        //     if ($testeToken == $token) {
        //         $verificacao = true;
        //     } else {
        //         $verificacao = false;
        //     }
        // } else {
        //     $verificacao = false;
        // }


        echo $this->template->renderizar('consultaView.html', ['isForm' => true]);
    }

    public function login(): void
    {
        $id = null;
        echo $this->template->renderizar('LoginView.html', ['erro' => $id, 'login' => true]);
    }

    public function visualizar(): void
    {
        echo $this->template->renderizar('visualizarRegistrosMedicoView.html', ['res' => (new Paciente())->selecionarTodosRegistros(), 'isForm' => true]);
    }

    public function consultar_dados(): void
    {
        echo $this->template->renderizar('DadosPacienteView.html', ['isForm' => true, 'login' => true]);
    }

    public function visualizarRegistro(): void
    {
        $res = (new Paciente())->selecionarTodosRegistros();
        echo $this->template->renderizar('visualizarRegistrosView.html', [
            'isForm' => false,
            'login' => false,
            'res' => $res
        ]);
    }
}