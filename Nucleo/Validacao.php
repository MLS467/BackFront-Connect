<?php

namespace sistema\nucleo;

/**
 * Classe para valida��o de dados
 * author faael
 * copyright 2008
 * https://rafaelcouto.com.br/classe-para-validacao-de-dados-com-php/
 */

class Validacao
{
	private $campo;
	private $valor;
	private $msg = array();

	// Mensagens de erro
	public function mensagens($num, $campo, $max, $min)
	{

		$this->msg[0] = "Preencha o campo com um email válido <br />"; // EMAIL
		$this->msg[1] = "CEP com formato inválido (Ex: XXXXX-XXX) <br />"; // CEP
		$this->msg[2] = "Data em formato inválido (Ex: DD/MM/AAAA) <br />"; // DATA
		$this->msg[3] = "Telefone inválido (Ex: 01433333333) <br />"; // TELEFONE
		$this->msg[4] = "CPF inválido (Ex: 11111111111) <br />"; // CPF
		$this->msg[5] = "IP inválido (Ex: 192.168.10.1) <br />"; // IP
		$this->msg[6] = "Preencha o campo " . $campo . " com numeros <br />"; // APENAS NUMEROS
		$this->msg[7] = "URL especificada á inválida (Ex: http://www.google.com) <br />"; // URL
		$this->msg[8] = "Preencha o campo " . $campo . " <br />"; // CAMPO VAZIO
		$this->msg[9] = "O " . $campo . " deve ter no máximo " . $max . " caracteres <br />"; // MáXIMO DE CARACTERES
		$this->msg[10] = "O " . $campo . " deve ter no mánimo " . $min . " caracteres <br />"; // M�NIMO DE CARACTERES

		return $this->msg[$num];
	}

	// Validar Email
	public function validarEmail($email)
	{
		if (!preg_match('/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$/', $email)) {
			return $this->mensagens(0, 'email', null, null);
		}
	}

	// Validar CEP (xxxxx-xxx)
	public function validarCep($cep)
	{
		if (!preg_match('/^[0-9]{5}-[0-9]{3}$/', $cep)) {
			return $this->mensagens(1, 'cep', null, null);
		}
	}

	// Validar Datas (DD/MM/AAAA)
	public function validarData($data)
	{
		if (!preg_match('/^[0-9]{2}/[0-9]{2}/[0-9]{4}$/', $data)) {
			return $this->mensagens(2, 'data', null, null);
		}
	}

	// Validar Telefone (01432363810)
	public function validarTelefone($telefone)
	{
		if (!preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/', $telefone)) {
			return $this->mensagens(2, 'data', null, null);
		}
	}

	// Validar CPF (111111111111)
	public function validarCpf($cpf)
	{

		if (!is_numeric($cpf)) {
			$status = false;
		} else {
			# Pega o digito verificador
			$dv_informado = substr($cpf, 9, 2);

			for ($i = 0; $i <= 8; $i++) {
				$digito[$i] = substr($cpf, $i, 1);
			}
			# Calcula o valor do 10� digito de verifica��o
			$posicao = 10;
			$soma = 0;

			for ($i = 0; $i <= 8; $i++) {
				$soma = $soma + $digito[$i] * $posicao;
				$posicao = $posicao - 1;
			}

			$digito[9] = $soma % 11;

			if ($digito[9] < 2) {
				$digito[9] = 0;
			} else {
				$digito[9] = 11 - $digito[9];
			}

			# Calcula o valor do 11� digito de verifica��o
			$posicao = 11;
			$soma = 0;

			for ($i = 0; $i <= 9; $i++) {
				$soma = $soma + $digito[$i] * $posicao;
				$posicao = $posicao - 1;
			}

			$digito[10] = $soma % 11;

			if ($digito[10] < 2) {
				$digito[10] = 0;
			} else {
				$digito[10] = 11 - $digito[10];
			}

			# Verifica de o dv � igual ao informado
			$dv = $digito[9] * 10 + $digito[10];

			if ($dv != $dv_informado) {
				$status = false;
			} else
				$status = true;
		}

		# Se houver erro
		if (!$status) {
			return $this->mensagens(4, 'cpf', null, null);
		}
	}

	// Validar IP (200.200.200.200)
	public function validarIp($ip)
	{
		if (!preg_match("^([0-9]){1,3}.([0-9]){1,3}.([0-9]){1,3}.([0-9]){1,3}$", $ip)) {
			return $this->mensagens(5, 'ip', null, null);
		}
	}


	// Validar Numero
	public function validarNumero($campo, $numero)
	{
		if (!is_numeric($numero)) {
			return $this->mensagens(6, $campo, null, null);
		}
	}

	// Validar URL
	public function validarUrl($url, $campo)
	{
		if (!preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url)) {
			return $this->mensagens(7, $campo, null, null);
		}
	}

	// Verifica��o simples (Campo vazio, maximo/minimo de caracteres)
	public function validarCampo($campo, $valor, $max, $min)
	{
		$this->campo = $campo;
		if ($valor == "") {
			return $this->mensagens(8, $campo, $max, $min);
		} elseif (strlen($valor) > $max) {
			return $this->mensagens(9, $campo, $max, $min);
		} elseif (strlen($valor) < $min) {
			return $this->mensagens(10, $campo, $max, $min);
		} elseif (strlen($valor) < $min) {
			return $this->mensagens(10, $campo, $max, $min);
		}
	}


	// Verifica se h� erros
	public function verifica()
	{
		if (sizeof($this->msg) == 0) {
			return true;
		} else {
			return false;
		}
	}
}