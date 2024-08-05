<?php

namespace sistema;

require_once __DIR__ . "/../vendor/autoload.php";

use PDO;
use Exception;
use sistema\nucleo\Helpers;

class Login
{
    private ?string $nomeTabela;
    private ?string $email;
    private ?string $senha;
    private ?string $token;

    public function __construct(?array $dados = null)
    {
        $this->nomeTabela = $dados['nomeTabela'] ?? null;
        $this->email = $dados['email'] ?? null;
        $this->senha = $dados['senha'] ?? null;
        $this->token = $dados['token'] ?? null;
    }


    public function isAutenticar(): bool
    {
        $sql = "SELECT * FROM $this->nomeTabela WHERE email = ? AND senha=?";
        $sql = DB::preparar($sql);
        $sql->execute(array($this->email, $this->senha));
        $usuario = $sql->fetch(PDO::FETCH_OBJ);
        if ($usuario) {
            // FAZER A ATUALIZAÇÃO DO TOKEN
            $atualizar = "UPDATE $this->nomeTabela SET token = ? WHERE id = ?";
            $atualizar = DB::preparar($atualizar);
            $atualizar->execute(array($this->token, $usuario->id));
            $_SESSION['token'] = $this->token;
            $_SESSION['id'] = $usuario->id;
            $_SESSION['nomeTabela'] = $this->nomeTabela;
            return true;
        }

        return false;
    }


    public function isAutenticado(string $token)
    {
        $sql = "SELECT * FROM $this->nomeTabela WHERE token = ? ";
        $sql = DB::preparar($sql);
        $sql->execute(array($token));
        $usuario = $sql->fetch(PDO::FETCH_OBJ);

        if ($usuario) {
            if ($this->isValidaToken($usuario->token)) {
                return $usuario->token;
            }
        }

        return false;
    }


    public function isValidaToken(string $token): bool
    {
        if ($token == $_SESSION['Token']) {
            return true;
        }

        return false;
    }



    public function redirecionar(): void
    {
        switch ($this->nomeTabela) {
            case 'medico':
                header("Location:" . Helpers::getServer('consulta'));
                break;
            case 'enfermeiro':
                header("Location:" . Helpers::getServer('cadastro_sinais_vitais'));

                break;
            case 'administrador':
                header("Location:" . Helpers::getServer('administrador'));

                break;
            case 'atendente':
                header("Location:" . Helpers::getServer('dados_basicos'));
                break;

            default:
                echo new Exception("Error Processing Request", 1);
                break;
        }
    }



    public function retornaToken(int $id): string
    {
        $nomeTable = $_SESSION['nomeTabela'];
        $sql = "SELECT token FROM $nomeTable WHERE id = ? LIMIT 1";
        $sql = Db::preparar($sql);
        $sql->execute(array($id));

        $result = $sql->fetch(PDO::FETCH_OBJ);

        if ($result && isset($result->token)) {
            return $result->token;
        }

        return '';
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function getNomeTabela(): string
    {
        return $this->nomeTabela;
    }

    public function setNomeTabela(string $nomeTabela)
    {
        $this->nomeTabela = $nomeTabela;
    }
}