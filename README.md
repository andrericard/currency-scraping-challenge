# currency-scraping-challenge

Desafio de Web Scraping de moedas ISO 4217.

## Requisitos

- Linux ou WSL 2
- Docker
- Make

> Use o comando ```sudo apt install make``` para instalar o Make

## Instalando

Clone o projeto ```git clone https://github.com/andrericard/currency-scraping-challenge.git```

Acesse a pasta ```src``` do projeto.

No terminal, execute o comando ```make up``` para subir o container.

Em seguida, execute o comando ```make init``` para instalar as dependências.

A aplicação deverá rodar no seguinte endereço: [http://localhost:8384/api/currencies](http://localhost:8384/api/currencies)

## Testando

No terminal, execute o comando ```make test``` para executar os testes.

> Você precisa acessar a pasta ```src``` para utilizar os comandos do Makefile

## Comandos Make

| Comando     | Ação                          |
|-------------|-------------------------------|
| install     | Instala as dependências       |
| up          | Inicia o container            |
| down        | Desliga o container           |
| restart     | Reinicia o container          |
| permissions | Altera permissões de arquivos |
| clear       | Limpa o cache                 |
| php         | Acessa o container do PHP     |
| test        | Executa os testes             |
| tinker      | Acessa o Tinker               |

** As permissões são apenas para fins de desenvolvimento.
