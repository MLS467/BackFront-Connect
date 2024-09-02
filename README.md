# Sistema de Pronto-Socorro

Este é um sistema automatizado para gerenciar o fluxo de atendimento em um pronto-socorro. O sistema permite que atendentes, enfermeiros e médicos registrem e acessem dados dos pacientes, desde a triagem até o diagnóstico final e prescrição de medicamentos.

## Requisitos

Antes de começar, certifique-se de ter o [Composer](https://getcomposer.org/) instalado em seu ambiente de desenvolvimento.

### Dependências

1. **Simple Router:**
   - Para o roteamento das requisições, utilize o pacote `pecee/simple-router`.
   - Instruções de instalação e uso estão disponíveis na [página do Packagist](https://packagist.org/packages/pecee/simple-router).

2. **Twig Template Engine:**
   - Para renderização das views, utilize o [Twig](https://twig.symfony.com/doc/3.x/installation.html).
   - Siga as instruções de instalação para integrar o Twig ao seu projeto.

## Instalação

1. Clone o repositório do projeto:
    ```bash
    git clone <url-do-repositorio>
    cd nome-do-diretorio
    ```

2. Instale as dependências usando o Composer:
    ```bash
    composer install
    ```

## Estrutura do Banco de Dados

O sistema utiliza um banco de dados relacional para armazenar as informações dos pacientes e os dados das consultas. Abaixo está o diagrama entidade-relacionamento (ER) que mostra o fluxo de chaves primárias (PK) e chaves estrangeiras (FK):

- [Diagrama ER - Fluxo de Dados](https://drive.google.com/file/d/1jmFTqsnDxADCpBIsd-Xe7jqLeXUO8N-z/view?usp=sharing)

## Diagrama de Classes

Para entender melhor a arquitetura do sistema, você pode consultar o diagrama de classes que detalha as relações entre as diferentes classes utilizadas no projeto:

- [Diagrama de Classes](https://drive.google.com/file/d/1jkte_nUumuz6ht76JGb2MlzgaHawbX1i/view?usp=sharing)

## Fluxo de Trabalho

1. **Atendente:**
   - Preenche o formulário com os dados básicos do paciente.
   - Envia o formulário para o enfermeiro.

2. **Enfermeiro:**
   - Recebe os dados do paciente.
   - Realiza a triagem e preenche os sinais vitais.
   - Envia os dados para o médico.

3. **Médico:**
   - Acessa os dados do paciente e a triagem.
   - Realiza a consulta e insere o diagnóstico e a prescrição de medicamentos.

## Contribuição

Se você quiser contribuir com este projeto, sinta-se à vontade para abrir issues ou enviar pull requests.
