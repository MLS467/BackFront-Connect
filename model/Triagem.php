<?php

namespace sistema;

use sistema\Crud;
use PDOException;

class Triagem extends Crud
{

    private int $id;
    private int $id_sinais_vitais_fk;
    private int $id_dados_basicos_fk;

    public function __construct(array $dados)
    {
        $this->nomeTabela = 'triagem';
        $this->id_sinais_vitais_fk = $dados['id_sinais_vitais_fk'];
        $this->id_dados_basicos_fk = $dados['id_dados_basicos_fk'];
    }


    public function inserirDados(): bool
    {
        $sql = "INSERT INTO $this->nomeTabela (
        id_sinais_vitais_fk, id_dados_basicos_fk
    ) VALUES (?, ?)";

        try {
            $query = Db::preparar($sql);

            $result = $query->execute([
                $this->getIdSinaisVitaisFk(),
                $this->getIdDadosBasicosFk()
            ]);

            if ($result) {
                $this->setId(Db::conectar()->lastInsertId());
                return true;
            }
        } catch (PDOException $e) {
            echo 'Erro ao inserir dados: ' . $e->getMessage();
            return false;
        }
    }


    function atualizarDados($id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    // Getter e Setter para id_sinais_vitais_fk
    public function getIdSinaisVitaisFk(): int
    {
        return $this->id_sinais_vitais_fk;
    }

    public function setIdSinaisVitaisFk(int $id_sinais_vitais_fk): void
    {
        $this->id_sinais_vitais_fk = $id_sinais_vitais_fk;
    }

    // Getter e Setter para id_dados_basicos_fk
    public function getIdDadosBasicosFk(): int
    {
        return $this->id_dados_basicos_fk;
    }

    public function setIdDadosBasicosFk(int $id_dados_basicos_fk): void
    {
        $this->id_dados_basicos_fk = $id_dados_basicos_fk;
    }
}