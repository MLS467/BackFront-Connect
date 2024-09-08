let buscar = document.getElementById('buscarPac');
let encontrado = document.getElementById('EncontradoPac');

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
        buscar.classList.add('ocultarElemento');
        encontrado.classList.remove('ocultarElemento');
        limpaCampo();
        encontrado.addEventListener('click', async () => {
            const endpoint = `/PROJETO_INTEGRADO_FRONT_E_BACK/Controller/inserirPacienteJson.php?idPacienteEncontrado=${dados.id}`;
            let result = await fetch(endpoint, { method: "GET" });
            if (result.ok) {
                alert('Paciente enviado para lista de Triagem!');
            } else {
                alert('Houve um problema para enviar os dados!');
            }
        });
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

function limpaCampo() {
    document.getElementById('cpf').value = '';
    document.getElementById('cpf').focus();
}

