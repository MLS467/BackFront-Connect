<?php

namespace sistema\nucleo;

/**
 * Classe para validação de dados
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
		$this->msg[2] = "Data em formato inválido (Ex: YYYY-MM-DD) <br />"; // DATA
		$this->msg[3] = "Telefone inválido (Ex: 01432363810) <br />"; // TELEFONE
		$this->msg[4] = "CPF inválido (Ex: 11111111111) <br />"; // CPF
		$this->msg[5] = "IP inválido (Ex: 192.168.10.1) <br />"; // IP
		$this->msg[6] = "Preencha o campo " . $campo . " com números <br />"; // APENAS NUMEROS
		$this->msg[7] = "URL especificada é inválida (Ex: http://www.google.com) <br />"; // URL
		$this->msg[8] = "Preencha o campo " . $campo . " <br />"; // CAMPO VAZIO
		$this->msg[9] = "O " . $campo . " deve ter no máximo " . $max . " caracteres <br />"; // MÁXIMO DE CARACTERES
		$this->msg[10] = "O " . $campo . " deve ter no mínimo " . $min . " caracteres <br />"; // MÍNIMO DE CARACTERES

		return $this->msg[$num];
	}

	public function validaNome(string $nome): bool
	{
		$regex = '/^[a-záàâãéèêíïóôõöúçñ ]+$/i';

		if (strlen($nome) <= 2 || empty($nome) || !preg_match($regex, $nome)) {
			return false;
		}

		return true;
	}

	// Validar Email
	public function validarEmail($email)
	{
		if (!preg_match('/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]+\.[a-z]{2,4}$/i', $email)) {
			return false;
		}
		return true;
	}

	// Validar CEP (XXXXX-XXX)
	public function validarCep($cep)
	{
		if (!preg_match('/^\d{5}-\d{3}$/', $cep)) {
			return false;
		}
		return true;
	}

	// Validar Datas (YYYY-MM-DD)
	public function validarData($data)
	{
		if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data)) {
			return false;
		}

		// Verifica se a data é válida
		$dataArray = explode('-', $data);
		$ano = (int)$dataArray[0];
		$mes = (int)$dataArray[1];
		$dia = (int)$dataArray[2];

		return checkdate($mes, $dia, $ano);
	}

	// Validar Telefone (01432363810)
	public function validarTelefone($telefone)
	{
		if (!preg_match('/^\d{11}$/', $telefone)) {
			return false;
		}
		return true;
	}

	// Validar CPF (11111111111)
	public function validarCpf($cpf)
	{
		if (!is_numeric($cpf)) {
			return false;
		}

		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

		if (strlen($cpf) != 11) {
			return false;
		}

		for ($i = 0; $i < 10; $i++) {
			if ($cpf == str_repeat($i, 11)) {
				return false;
			}
		}

		$soma = 0;
		$digito = 0;

		for ($i = 0; $i < 9; $i++) {
			$soma += $cpf[$i] * (10 - $i);
		}

		$resto = $soma % 11;
		$digito = $resto < 2 ? 0 : 11 - $resto;

		if ($cpf[9] != $digito) {
			return false;
		}

		$soma = 0;

		for ($i = 0; $i < 10; $i++) {
			$soma += $cpf[$i] * (11 - $i);
		}

		$resto = $soma % 11;
		$digito = $resto < 2 ? 0 : 11 - $resto;

		if ($cpf[10] != $digito) {
			return false;
		}

		return true;
	}

	// Validar IP (192.168.10.1)
	public function validarIp($ip)
	{
		if (!preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $ip)) {
			return false;
		}
		return true;
	}

	// Validar Numero
	public function validarNumero($campo, $numero)
	{
		if (!is_numeric($numero)) {
			return false;
		}
		return true;
	}

	// Validar URL
	public function validarUrl($url, $campo)
	{
		if (!preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url)) {
			return false;
		}
		return true;
	}

	// Validar Senha
	public function validarSenha($senha)
	{
		if (strlen($senha) < 6) {
			return false;
		}
		return true;
	}

	// Verificação simples (Campo vazio, máximo/mínimo de caracteres)
	public function validarCampo($campo, $valor, $max, $min)
	{
		$this->campo = $campo;
		if ($valor == "") {
			return $this->mensagens(8, $campo, $max, $min);
		} elseif (strlen($valor) > $max) {
			return $this->mensagens(9, $campo, $max, $min);
		} elseif (strlen($valor) < $min) {
			return $this->mensagens(10, $campo, $max, $min);
		}
	}

	// Verifica se há erros
	public function verifica()
	{
		return sizeof($this->msg) == 0;
	}
}