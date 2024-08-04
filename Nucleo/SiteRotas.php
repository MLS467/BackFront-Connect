<?php

namespace sistema\rotas;

use sistema\controlador\Controlador;
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
        echo $this->template->renderizar('dadosBasicosView.html', ['teste' => 'Maisson']);
    }

    public function cadastrarPaciente(): void
    {
        echo $this->template->renderizar('cadastrarPacienteView.html', ['teste' => 'teste']);
    }

    public function cadastrarFuncionario(): void
    {
        echo $this->template->renderizar('cadastrarFuncionarioView.html', ['teste' => 'teste']);
    }

    public function cadastro_sv(): void
    {
        echo $this->template->renderizar('sinaisVitaisView.html', ['teste' => 'teste']);
    }

    public function notFound(): void
    {
        echo $this->template->renderizar('notFound.html', ['erro' => 'Página não encontrada!']);
    }

    public function consulta(): void
    {
        echo $this->template->renderizar('consultaView.html', ['erro' => 'Página não encontrada!']);
    }

    public function visualizar(): void
    {
        // print_r($conteudo);
        // echo $this->template->renderizar('visualizarRegistrosView.html', ['res' => $conteudo]);
    }
}