import { estruturaDoc } from "./estruturaDoc.js";

class Popup {

    destino = document.body;
    destEstilo = document.head;

    criarTela = () => {
        const telaEscura = document.createElement('div');
        telaEscura.setAttribute('id', 'CorpoTelaEscura');
        const estilo = document.createElement('style');
        estilo.innerHTML = this.estilo();
        this.destEstilo.appendChild(estilo);
        this.destino.prepend(telaEscura);
        telaEscura.innerHTML = estruturaDoc;

        document.querySelector('#cancelarDoc').addEventListener('click', (evt) => { this.ocultarDoc() });
    }

    ocultarDoc = () => {
        document.querySelector('#CorpoTelaEscura').remove();
    }

    estilo = () => {
        const estilo =
            `
    body {position: relative;max-width: 100%;height: 200vh;}
    .container {max-width: 1200px;margin: auto;padding: 15px;}
    .card {border: 1px solid #ddd;border-radius: 5px;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);margin-bottom: 20px;}
    .card-header {background-color: #f7f7f7;border-bottom: 1px solid #ddd;padding: 10px 15px;font-size: 18px;font-weight: bold;}
    .card-body {padding: 15px;}
    .form-group div { margin-bottom: 5px;}
    .form-group strong {color: #333;}
    h5 {font-size: 16px;color: #333;margin-top: 20px;margin-bottom: 15px;}
    p {font-size: 14px;color: #666;margin-top: 15px;}
    .borda { border: 2px solid red;}
    #CorpoTelaEscura {background-color: rgba(0, 0, 0, 0.75);display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;
    position: absolute;left: 0;top: 0;z-index:999;}
    #popupLogo {width: 200px;}
    #logoDc {display: flex;justify-content: space-between;align-items: center;flex-direction: row;}
    `;
        return estilo;
    }

    enviaId = ($id) => {

        // Construa a URL com parâmetros de consulta
        const url = `/PROJETO_INTEGRADO_FRONT_E_BACK/Nucleo/retornaJsonPacientes.php?id=${$id}`;

        fetch(url, {
            method: 'GET'
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.paciente[0].nomeCompleto);
                document.getElementById('nomeJson').innerHTML += data.paciente[0].nomeCompleto;
                document.getElementById('dataNascimento').innerText = data.paciente[0].dataNascimento;
                document.getElementById('sexo').innerText = data.paciente[0].sexo;
                document.getElementById('idade').innerText = data.paciente[0].idade;
                document.getElementById('endereco').innerText = `${data.paciente[0].bairro} ${data.paciente[0].rua} ${data.paciente[0].complemento}`;
                document.getElementById('telefone').innerText = data.paciente[0].contatoEmergencia;
                document.getElementById('email').innerText = data.paciente[0].email;
                document.getElementById('naturalidade').innerText = data.paciente[0].naturalidade;
                document.getElementById('cpf').innerText = data.paciente[0].cpf;
                document.getElementById('contatoEmergencia').innerText = data.paciente[0].telefone;
                document.getElementById('sintomas').innerText = data.paciente[0].sintomas;
                document.getElementById('gravidade').innerText = data.paciente[0].gravidade;
                document.getElementById('tempoInicio').innerText = data.paciente[0].tempo_inicio;
                document.getElementById('localizacaoDor').innerText = data.paciente[0].localizacao_dor;
                document.getElementById('pressaoArterial').innerText = data.paciente[0].pressao_arterial;
                document.getElementById('frequenciaCardiaca').innerText = data.paciente[0].frequencia_cardiaca;
                document.getElementById('temperatura').innerText = data.paciente[0].temperatura;
                document.getElementById('saturacao').innerText = data.paciente[0].saturacao;
                document.getElementById('frequenciaRespiratoria').innerText = data.paciente[0].frequencia_respiratoria;
                document.getElementById('intensidadeDor').innerText = data.paciente[0].intensidade_da_dor;
                document.getElementById('observacoes').innerText = data.paciente[0].observacoes;
                document.getElementById('naturezaDor').innerText = data.paciente[0].natureza_dor;
                document.getElementById('idTriagem').innerText = data.paciente[0].id;

            })
            .catch(error => {
                console.error('Erro:', error);
            });

    }



}

export { Popup };