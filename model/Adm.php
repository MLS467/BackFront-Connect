<?php

namespace sistema;

use sistema\Atendente;
use sistema\Enfermeiro;
use sistema\Medico;
use sistema\nucleo\Helpers;
use sistema\Pessoa;

class Adm extends Pessoa
{
    private ?string $Permissao;
    private ?string $data_inicio_trabalho;
    private ?string $data_termino_trabalho;

    public function __construct(?array $n)
    {
        parent::__construct($n);
        $this->nomeTabela = 'adm';
        $this->Permissao = $n['permissao'] ?? null;
        $this->data_inicio_trabalho = date("Y-m-d") ?? null;
        $this->data_termino_trabalho = null;
    }


    public function adicionarNovoFuncionario(string $tipo, array $n)
    {
        $tipo = strtolower($tipo);
        switch ($tipo) {
            case strtolower('atendente'):
                if ((new Atendente($n))->inserirDados())
                    return true;
                break;

            case strtolower('medico'):
                //MEDICO
                if ((new Medico($n))->inserirDados())
                    return true;
                break;

            case strtolower('enfermeiro'):
                //ENFERMEIRO
                if ((new Enfermeiro($n))->inserirDados())
                    return true;
                break;

            case 4:
                //adm
                if ((new Adm($n))->inserirDados())
                    return true;
                break;

            default:
                echo "Não deu bom!";
                break;
        }
    }

    public function getPermissao(): string
    {
        return $this->Permissao;
    }

    public function setPermissao(string $permissao): void
    {
        $this->Permissao = $permissao;
    }

    public function getDataInicioTrabalho(): ?string
    {
        return $this->data_inicio_trabalho;
    }

    // Setter para data_inicio_trabalho
    public function setDataInicioTrabalho(?string $data_inicio_trabalho): void
    {
        $this->data_inicio_trabalho = $data_inicio_trabalho;
    }

    // Getter para data_termino_trabalho
    public function getDataTerminoTrabalho(): ?string
    {
        return $this->data_termino_trabalho;
    }

    // Setter para data_termino_trabalho
    public function setDataTerminoTrabalho(?string $data_termino_trabalho): void
    {
        $this->data_termino_trabalho = $data_termino_trabalho;
    }
}