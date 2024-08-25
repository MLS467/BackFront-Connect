<?php

use sistema\Atendente;
use sistema\Enfermeiro;
use sistema\Medico;
use sistema\Pessoa;

class Adm extends Pessoa
{
    private string $Permissao;
    private string $data_inicio_trabalho;
    private ?string $data_termino_trabalho;

    public function __construct(?array $n)
    {
        parent::__construct($n);
        $this->Permissao = $n['permissao'];
        $this->data_inicio_trabalho = date("Y-m-d");
        $this->data_termino_trabalho = null;
    }


    private function adicionarNovoFuncionario(int $tipo, array $n)
    {
        switch ($tipo) {
            case 1:
                //ATENDENTE
                ((new Atendente($n))->inserirDados());

                break;
            case 2:
                //Medico
                ((new Medico($n))->inserirDados());
                break;
            case 3:
                //Medico
                ((new Enfermeiro($n))->inserirDados());
                break;
            case 4:
                //adm
                ((new Adm($n))->inserirDados());
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