import { Popup } from "./VisualizarClasse.js";


const btn = [...document.querySelectorAll('.Visualizar')];

btn.forEach((e) => {
    e.addEventListener('click', (evt) => {
        const teste = new Popup();
        teste.criarTela();
    });
});