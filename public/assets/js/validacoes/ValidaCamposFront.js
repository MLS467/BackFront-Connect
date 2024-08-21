export default class ValidaCampo {

    static nome = '';
    static telefone = '';
    static email = '';
    static senha = '';
    static cpf = '';

    static mensagens = {
        nome: '',
        telefone: '',
        email: '',
        senha: '',
        cpf: ''
    };

    // Define os dados para validação
    static definirDados(dados) {
        this.nome = dados.nome || '';
        this.telefone = dados.telefone || '';
        this.email = dados.email || '';
        this.senha = dados.senha || '';
        this.limparMensagens();
    }

    // Limpa mensagens de erro
    static limparMensagens() {
        this.mensagens = {
            nome: '',
            telefone: '',
            email: '',
            senha: ''
        };
    }

    // Valida o nome (não deve estar vazio e pode ter entre 2 e 50 caracteres)
    static validaNome() {
        if (!this.nome) {
            this.mensagens.nome = 'O nome não pode estar vazio.';
            return false;
        }
        if (this.nome.length < 2 || this.nome.length > 50) {
            this.mensagens.nome = 'O nome deve ter entre 2 e 50 caracteres.';
            return false;
        }
        return true;
    }

    // Valida o telefone (formato básico: (xx) xxxxx-xxxx)
    static validaTelefone() {
        const telefoneRegex = /^\(\d{2}\) \d{5}-\d{4}$/;
        if (!this.telefone) {
            this.mensagens.telefone = 'O telefone não pode estar vazio.';
            return false;
        }
        if (!telefoneRegex.test(this.telefone)) {
            this.mensagens.telefone = 'O telefone deve estar no formato (xx) xxxxx-xxxx.';
            return false;
        }
        return true;
    }

    // Valida o e-mail (formato básico de e-mail)
    static validaEmail() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!this.email) {
            this.mensagens.email = 'O e-mail não pode estar vazio.';
            return false;
        }
        if (!emailRegex.test(this.email)) {
            this.mensagens.email = 'O e-mail deve estar no formato válido.';
            return false;
        }
        return true;
    }

    // Valida a senha (mínimo de 6 caracteres)
    static validaSenha() {
        if (!this.senha) {
            this.mensagens.senha = 'A senha não pode estar vazia.';
            return false;
        }
        if (this.senha.length < 6) {
            this.mensagens.senha = 'A senha deve ter pelo menos 6 caracteres.';
            return false;
        }
        return true;
    }

    // Valida todos os campos de uma vez e retorna as mensagens de erro
    static validaCampos() {
        this.limparMensagens();
        this.validaNome();
        this.validaTelefone();
        this.validaEmail();
        this.validaSenha();
        return this.mensagens;
    }


    static validaCPF(cpf) {
        var Soma = 0
        var Resto

        var strCPF = String(cpf).replace(/[^\d]/g, '')

        if (strCPF.length !== 11 || strCPF.length == 0) {
            this.mensagens.cpf = 'Cpf deve ter 11 dígitos!';
            return false
        }

        if ([
            '00000000000',
            '11111111111',
            '22222222222',
            '33333333333',
            '44444444444',
            '55555555555',
            '66666666666',
            '77777777777',
            '88888888888',
            '99999999999',
        ].indexOf(strCPF) !== -1) {
            this.mensagens.cpf = 'Dígito inválido!'
            return false
        }

        for (i = 1; i <= 9; i++)
            Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);

        Resto = (Soma * 10) % 11

        if ((Resto == 10) || (Resto == 11))
            Resto = 0

        if (Resto != parseInt(strCPF.substring(9, 10)))
            return false

        Soma = 0

        for (i = 1; i <= 10; i++)
            Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i)

        Resto = (Soma * 10) % 11

        if ((Resto == 10) || (Resto == 11))
            Resto = 0

        if (Resto != parseInt(strCPF.substring(10, 11))) {
            this.mensagens.cpf = 'Cpf inválido!'
            return false
        }

        return true
    }

}
