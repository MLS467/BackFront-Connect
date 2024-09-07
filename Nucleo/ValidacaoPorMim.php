<?php

namespace sistema\nucleo;

use PDO;
use PDOException;

class ValidacaoPorMim
{

    public function ValidaArq($imgExt, $imgTam)
    {
        $controle = true;

        if ((!empty($imgExt)) && (!empty($imgTam))) {
            $tamanhoMax = "2097152";
            if ($imgTam > $tamanhoMax) {
                $controle = false;
            }


            $extSet = [".jpg", ".jpeg", ".png"];
            $extensao = strrchr($imgExt, ".");
            if (!in_array($extensao, $extSet)) {
                $controle = false;
            }
        } else {
            $controle = false;
        }

        return $controle;
    }



    public function validaForm($nome, $email, $sexo)
    {
        if ((!empty($nome)) and (!empty($email)) and (!empty($sexo))) {

            if (!preg_match("/^[a-zA-Zá-ú ]+$/", $nome)) {
                return  false;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
        }
        return true;
    }

    public function validarLogin($email, $senha)
    {

        if (empty($email) or empty($senha)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if (strlen($senha) < 6) {
            return false;
        }

        return true;
    }
}