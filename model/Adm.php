<?php

use sistema\Atendente;
use sistema\Enfermeiro;
use sistema\Funcionario;
use sistema\Medico;

class Adm extends Funcionario
{

    public function __construct($n)
    {
        parent::__construct($n);
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
}