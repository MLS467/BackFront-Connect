import { Caixa } from "./caixa.js";

//INSTANCIEI A CLASSE CONSEGUI PEGAR PORQUE O ARQUIVO DA CLASSE VEM ANTES 

// CHAMADA DO MÉTODOS PELO BOTÕES BTNS 
document.getElementById("btn").addEventListener("click", () => {
    const config = { // CONFIG QUE VAI COMO PARAMETRO PARA A MÉTODO DE CONFIGURAÇÃO
        cor: "#007acc"
    }
    Caixa.config(config);
    Caixa.mostrar("Caixa de msg", "Caixa de msg personalizavel");
})

document.getElementById("btn1").addEventListener("click", () => {
    const config = {
        cor: "red"
    }
    Caixa.config(config);
    Caixa.mostrar("JAVASCRIPT", "Caixa de msg personalizavel JAVASCRIPT");
})

document.getElementById("btn2").addEventListener("click", () => {
    const config = {
        cor: "green"
    }
    Caixa.config(config);
    Caixa.mostrar("Caixa de msg PHP", "Caixa de msg personalizavel PHP");
})