let contidadePessoas = 12;

const gerarDados = async () => {
    (await fetch('/PROJETO_INTEGRADO_FRONT_E_BACK/automatizarCadastro.json')).json()
        .then(res => {
            let numPessoa = Math.floor((Math.random() * (contidadePessoas)));
            document.getElementById('nomeCompleto').value = res.pessoas[numPessoa].nomeCompleto;
            document.getElementById('cpf').value = res.pessoas[numPessoa].cpf;
            document.getElementById('dataNascimento').value = res.pessoas[numPessoa].dataNascimento;
            document.getElementById('genero').value = res.pessoas[numPessoa].genero;
            document.getElementById('cepCadastraPac').value = res.pessoas[numPessoa].cep;
            document.getElementById('bairro').value = res.pessoas[numPessoa].bairro;
            document.getElementById('rua').value = res.pessoas[numPessoa].rua;
            document.getElementById('numero').value = res.pessoas[numPessoa].numero;
            document.getElementById('complemento').value = res.pessoas[numPessoa].complemento;
            document.getElementById('cidade').value = res.pessoas[numPessoa].cidade;
            document.getElementById('naturalidade').value = res.pessoas[numPessoa].naturalidade;
            document.getElementById('telefone').value = res.pessoas[numPessoa].telefone;
            document.getElementById('email').value = res.pessoas[numPessoa].email;
            document.getElementById('alergia').value = res.pessoas[numPessoa].alergia;
            document.getElementById('historicoCirurgia').value = res.pessoas[numPessoa].historicoCirurgia;
            document.getElementById('contatoEmergencia').value = res.pessoas[numPessoa].contatoEmergencia;

        });
}

document.getElementById('cadastroAleatorio').addEventListener('click', gerarDados);