document.getElementById('formEnviar').addEventListener('submit', async function (event) {
    event.preventDefault();

    let cpf = document.getElementById('cpf').value.trim();
    let resultDiv = document.getElementById('resultado');

    if (cpf.length == 0) {
        resultDiv.innerHTML = '<div class="alert alert-danger">CPF inválido. Por favor, insira um CPF válido.</div>';
        return;
    }

    let dados = await pegaDados(cpf);
    if (dados) {
        console.log(dados);
    } else {
        resultDiv.innerHTML = '<div class="alert alert-warning">Usuário não possui Cadastro! <a href="/PROJETO_INTEGRADO_FRONT_E_BACK/cadastro_paciente">cadastre aqui</a></div>';
    }
});

async function pegaDados(cpf) {
    let resultado = null;
    let endpoint = `/PROJETO_INTEGRADO_FRONT_E_BACK/Nucleo/DadosPaciente.php?cpf=${cpf}`;

    resultado = await fetch(endpoint, {
        method: "GET"
    })
        .then((res) => res.json())
        .then(res => {
            if (res.paciente) {

                return res.paciente
            }
            else
                return false;
        });

    return resultado;
}

