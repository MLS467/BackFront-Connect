export default class ValidaCampo {

    static validaNome(nome) {
        if (!nome) {
            return 'O nome não pode estar vazio.';
        }
        if (nome.length < 2 || nome.length > 50) {
            return 'O nome deve ter entre 2 e 50 caracteres.';
        }
        return true;
    }

    static validaTelefone(telefone) {
        const telefoneRegex = /^\+?\d{0,3}?[-.\s]?(\(?\d{2,4}\)?[-.\s]?)?\d{4,5}[-.\s]?\d{4}$/;
        if (!telefone) {
            return 'O telefone não pode estar vazio.';
        }
        if (!telefoneRegex.test(telefone)) {
            return 'O telefone deve estar no formato xxxxxxxxxxx.';
        }
        return true;
    }

    static validaEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email) {
            return 'O e-mail não pode estar vazio.';
        }
        if (!emailRegex.test(email)) {
            return 'O e-mail deve estar no formato válido.';
        }
        return true;
    }

    static validaSenha(senha) {
        if (!senha) {
            return 'A senha não pode estar vazia.';
        }
        if (senha.length < 6) {
            return 'A senha deve ter pelo menos 6 caracteres.';
        }
        return true;
    }

    static validaCPF(cpf) {
        let soma = 0;
        let resto;

        const strCPF = String(cpf).replace(/[^\d]/g, '');

        if (strCPF.length !== 11 || strCPF === "00000000000") {
            return 'CPF deve ter 11 dígitos e não pode ser uma sequência de números repetidos!';
        }

        for (let i = 1; i <= 9; i++) {
            soma += parseInt(strCPF.substring(i - 1, i)) * (11 - i);
        }

        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) {
            resto = 0;
        }
        if (resto !== parseInt(strCPF.substring(9, 10))) {
            return 'CPF inválido!';
        }

        soma = 0;
        for (let i = 1; i <= 10; i++) {
            soma += parseInt(strCPF.substring(i - 1, i)) * (12 - i);
        }

        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) {
            resto = 0;
        }
        if (resto !== parseInt(strCPF.substring(10, 11))) {
            return 'CPF inválido!';
        }

        return true;
    }
}
