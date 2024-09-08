<?php

namespace sistema\rotas;

use DateTime;
use sistema\Atendente;
use sistema\controlador\Controlador;
use sistema\Enfermeiro;
use sistema\Medico;
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


    public function cadastrarPaciente(): void
    {
        if (Helpers::validaCredencial()) {
            $funcionario = !empty($_SESSION['idFuncionario']) ? $_SESSION['idFuncionario'] : null;
            $res = (new Atendente(null))->selecionarUmRegistro($funcionario);
            $res['img'] = !empty($res['img']) ? $res['img'] : null;

            echo $this->template->renderizar('cadastrarPacienteView.html', ['isForm' => true, 'img' => $res]);
        } else
            header("Location:" . Helpers::getServer('404'));
    }
    public function listar_funcionario(): void
    {
        if (Helpers::validaCredencial()) {
            $funcionario = !empty($_SESSION['idFuncionario']) ? $_SESSION['idFuncionario'] : null;
            $res = (new Atendente(null))->selecionarUmRegistro($funcionario);
            $res['img'] = !empty($res['img']) ? $res['img'] : null;


            $dados = array(
                (new Medico(null))->selecionarTodosRegistros(),
                (new Enfermeiro(null))->selecionarTodosRegistros(),
                (new Atendente(null))->selecionarTodosRegistros()
            );

            $resultado = array_merge($dados[0], $dados[1], $dados[2]);

            echo $this->template->renderizar('listagemFuncionarioView.html', ['isForm' => true, 'dados' => $resultado, 'img' => $res]);
        } else
            header("Location:" . Helpers::getServer('404'));
    }

    public function cadastrarFuncionario(): void
    {
        if (Helpers::validaCredencial()) {
            $funcionario = !empty($_SESSION['idFuncionario']) ? $_SESSION['idFuncionario'] : null;
            $res = (new Atendente(null))->selecionarUmRegistro($funcionario);
            $res['img'] = !empty($res['img']) ? $res['img'] : null;


            echo $this->template->renderizar('cadastrarFuncionarioView.html', ['teste' => 'teste', 'img' => $res]);
        } else
            header("Location:" . Helpers::getServer('404'));
    }

    public function triagem(): void
    {
        if (Helpers::validaCredencial()) {
            $funcionario = !empty($_SESSION['idFuncionario']) ? $_SESSION['idFuncionario'] : null;
            $res = (new Enfermeiro(null))->selecionarUmRegistro($funcionario);
            $res['img'] = !empty($res['img']) ? $res['img'] : null;

            echo $this->template->renderizar('TriagemView.html', ['isForm' => true, 'img' => $res]);
        } else
            header("Location:" . Helpers::getServer('404'));
    }

    public function notFound(): void
    {
        echo $this->template->renderizar('notFound.html', ['erro' => 'Página não encontrada!']);
    }

    public function consulta(): void
    {
        if (Helpers::validaCredencial()) {
            $funcionario = !empty($_SESSION['idFuncionario']) ? $_SESSION['idFuncionario'] : null;
            $res = (new Medico(null))->selecionarUmRegistro($funcionario);
            $res['img'] = !empty($res['img']) ? $res['img'] : null;

            echo $this->template->renderizar('consultaView.html', [
                'isForm' => true,
                'img' => $res,
                'agora' => date('Y-m-d H:i:s')
            ]);
        } else
            header("Location:" . Helpers::getServer('404'));
    }

    public function login(): void
    {
        $id = null;
        echo $this->template->renderizar('LoginView.html', ['erro' => $id, 'login' => true, 'isForm' => false]);
    }

    public function visualizar(): void
    {

        if (Helpers::validaCredencial()) {
            $funcionario = !empty($_SESSION['idFuncionario']) ? $_SESSION['idFuncionario'] : null;
            $res = (new Medico(null))->selecionarUmRegistro($funcionario);
            $res['img'] = !empty($res['img']) ? $res['img'] : null;

            echo $this->template->renderizar('visualizarRegistrosMedicoView.html', ['res' => Helpers::selecionarTodasTabelas(), 'isForm' => true, 'img' => $res]);
        } else
            header("Location:" . Helpers::getServer('404'));
    }

    public function consultar_dados(): void
    {
        if (Helpers::validaCredencial()) {
            $funcionario = !empty($_SESSION['idFuncionario']) ? $_SESSION['idFuncionario'] : null;
            $res = (new Atendente(null))->selecionarUmRegistro($funcionario);
            $res['img'] = !empty($res['img']) ? $res['img'] : null;

            echo $this->template->renderizar('DadosPacienteView.html', ['isForm' => true, 'login' => false, 'img' => $res]);
        } else
            header("Location:" . Helpers::getServer('404'));
    }

    public function visualizarRegistro(): void
    {
        if (Helpers::validaCredencial()) {
            $funcionario = !empty($_SESSION['idFuncionario']) ? $_SESSION['idFuncionario'] : null;
            $result = (new Enfermeiro(null))->selecionarUmRegistro($funcionario);
            $result['img'] = !empty($result['img']) ? $result['img'] : null;


            $res = (new Paciente())->selecionarPorStatus('Ativo');
            echo $this->template->renderizar('visualizarRegistrosView.html', ['isForm' => true, 'login' => false, 'res' => $res, 'img' => $result]);
        } else
            header("Location:" . Helpers::getServer('404'));
    }

    public function dashboard(): void
    {
        if (Helpers::validaCredencial()) {
            $funcionario = !empty($_SESSION['idFuncionario']) ? $_SESSION['idFuncionario'] : null;
            $res = (new Atendente(null))->selecionarUmRegistro($funcionario);
            // Verifica se a imagem existe, senão define $res['img'] como null
            $res['img'] = !empty($res['img']) ? $res['img'] : null;

            echo $this->template->renderizar('dashboardView.html', ['isForm' => true, 'login' => false, 'img' => $res]);
        } else
            header("Location:" . Helpers::getServer('404'));
    }

    public function consultaRealizada(): void
    {
        if (Helpers::validaCredencial()) {
            echo $this->template->renderizar('consultaRealizadaView.html', ['isForm' => true, 'login' => false]);
        } else
            header("Location:" . Helpers::getServer('404'));
    }
}