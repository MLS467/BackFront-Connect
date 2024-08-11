const estruturaDoc = `
<div class="container mt-5">
        <div class="mt-5">
            <div class="card">
                <div class="w-100">
                    <div class="card-header text-center w-100">
                        Informações Pessoais
                    </div>
                    <div id="backLogo">
                        <div class="card-body p-3">
                            <div>
                                <div id="logoDc">
                                    <div>
                                        <h3 class="mt-4">Dados Básicos</h3>
                                    </div>
                                    <div>
                                        <img id="popupLogo" src="public/assets/img/logopb.png" alt="logo">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="nomeJson"><strong>Nome: </strong></div>
                                <div><strong>Data de Nascimento:</strong> <span id="dataNascimento"></span></div>
                            </div>
                            <div class="form-group">
                                <div><strong>Sexo:</strong> <span id="sexo"></span></div>
                                <div><strong>Idade:</strong> <span id="idade"></span></div>
                            </div>
                            <div class="form-group">
                                <div><strong>Endereço:</strong> <span id="endereco"></span></div>
                                <div><strong>Telefone:</strong> <span id="telefone"></span></div>
                            </div>
                            <div class="form-group">
                                <div><strong>Email:</strong> <span id="email"></span></div>
                                <div><strong>Naturalidade:</strong> <span id="naturalidade"></span></div>
                            </div>
                            <div class="form-group">
                                <div><strong>CPF:</strong> <span id="cpf"></span></div>
                                <div><strong>Contato de Emergência:</strong> <span id="contatoEmergencia"></span></div>
                            </div>
                        </div>

                        <div class="p-3">
                            <h3 class="mt-4">Informações da Triagem</h3>
                            <div class="form-group">
                                <div><strong>Sintomas:</strong> <span id="sintomas"></span></div>
                                <div><strong>Gravidade:</strong> <span id="gravidade"></span></div>
                            </div>
                            <div class="form-group">
                                <div><strong>Tempo de Início:</strong> <span id="tempoInicio"></span></div>
                                <div><strong>Localização da Dor:</strong> <span id="localizacaoDor"></span></div>
                            </div>
                            <div class="form-group">
                                <div><strong>Pressão Arterial:</strong> <span id="pressaoArterial"></span> mmHg</div>
                                <div><strong>Frequência Cardíaca:</strong> <span id="frequenciaCardiaca"></span> bpm</div>
                            </div>
                            <div class="form-group">
                                <div><strong>Temperatura:</strong> <span id="temperatura"></span> °C</div>
                                <div><strong>Saturação:</strong> <span id="saturacao"></span> %</div>
                            </div>
                            <div class="form-group">
                                <div><strong>Frequência Respiratória:</strong> <span id="frequenciaRespiratoria"></span> rpm</div>
                                <div><strong>Intensidade da Dor:</strong> <span id="intensidadeDor"></span></div>
                            </div>
                            <div class="form-group">
                                <div><strong>Observações:</strong> <span id="observacoes"></span></div>
                                <div><strong>Natureza da Dor:</strong> <span id="naturezaDor"></span></div>
                            </div>
                            <p><strong>ID da Triagem:</strong> <span id="idTriagem"></span></p>
                        </div>
                    </div>

                </div>
                <div class="w-100"></div>
                <div class="card-footer text-start w-100 mt-2">
                    <div class="text-center my-2">
                        <a id="consultar" href="/PROJETO_INTEGRADO_FRONT_E_BACK/consulta" class="btn btn-success">Consultar</a>
                        <a href="#" class="btn btn-warning">Enfermagem</a>
                        <a href="#" class="btn btn-info">Imprimir</a>
                        <a id="cancelarDoc" href="#" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
      `

export { estruturaDoc };