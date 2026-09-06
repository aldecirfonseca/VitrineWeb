# VitrineWeb

Projeto prático da disciplina **Frameworks II**, do curso de **Análise e Desenvolvimento de Sistemas** da **Faculdade Santa Marcelina — Muriaé/MG**, ministrada pelo Professor Especialista **Aldecir Fonseca**.

## Sobre a disciplina

- **Curso:** Análise e Desenvolvimento de Sistemas
- **Período:** 6º
- **Disciplina:** Frameworks II
- **Carga horária:** 40 horas
- **Ano letivo:** 2026
- **Professor:** Aldecir de Almeida Fonseca (aldecir.fonseca@santamarcelina.edu.br)

### Objetivo

Fornecer ao aluno, através do estudo das tecnologias e conceitos de frameworks de programação em PHP, os conhecimentos necessários para a criação, implantação e manutenção de aplicações web dinâmicas.

### Ementa

Frameworks de mercado, vantagens e desvantagens, principais diferenças entre os frameworks, conceitos e bibliotecas, com desenvolvimento de projeto prático de aplicação utilizando o framework **CodeIgniter 4**.

## Sobre o projeto

O **VitrineWeb** é o projeto prático da disciplina: um **mini e-commerce**, contemplando:

- Área administrativa;
- Catálogo de produtos e categorias;
- Carrinho de compras e pedidos.

O projeto é desenvolvido de forma incremental ao longo do semestre, acompanhando o conteúdo programático da disciplina.

## Conteúdo programático

1. **Introdução ao CodeIgniter** — requisitos mínimos, instalação, estrutura de arquivos e pastas, idioma das mensagens padrão, rotas.
2. **MVC** — carregamento de models, parâmetros via URL, nomes reservados, views, templates e validação de formulários.
3. **Sessões** — configuração e uso da library `session`, sessões permanentes e temporárias, destruição de sessões.
4. **Banco de dados** — configuração da conexão, migrations, consultas, Query Builder e CRUD, controle de transações.
5. **Upload de imagens.**
6. **Envio de e-mails.**
7. **Controle de acesso e permissões.**

## Tecnologias

- PHP 8.2+
- [CodeIgniter 4](https://codeigniter.com)
- MySQL

## Como executar

1. Copie o arquivo `env` para `.env` e configure a `baseURL` e os dados de conexão com o banco.
2. Instale as dependências:
   ```
   composer install
   ```
3. Rode as migrations (quando disponíveis):
   ```
   php spark migrate
   ```
4. Suba o servidor embutido do CodeIgniter:
   ```
   php spark serve
   ```

> O `index.php` fica dentro da pasta `public`. Aponte seu servidor web (ou virtual host) para essa pasta, e não para a raiz do projeto.

## Referências bibliográficas

**Básica**
- MILANI, André. *Construindo Aplicações Web com PHP e MySQL*. São Paulo: Novatec, 2017.
- DALL'OGLIO, Pablo. *PHP: Programando com orientação a objetos*. São Paulo: Novatec, 2017.
- LOCKHART, Josh. *PHP Moderno: Novos recursos e boas práticas*. São Paulo: Novatec, 2016.

**Complementar**
- SARAIVA, Maurício de Oliveira; BARRETO, Jeanine dos Santos. *Desenvolvimento de Sistemas com PHP*. Porto Alegre: Sagah, 2018.
- WEY, Estelle. *Mobile HTML 5: usando o que há de mais moderno atualmente*. São Paulo: Novatec, 2014.
