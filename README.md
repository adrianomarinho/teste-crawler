
# Crawler de Exemplo

Este crawler obtem um resultado de uma rota e exibe na tela.



## Instalação

Instale my-project com npm

```bash
  git clone git@github.com:adrianomarinho/teste-crawler.git
  cd teste-crawler
  docker-compose up -d
  docker exec -it crawler-app bash
  
  php artisan key:generate
```


    
## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
  docker exec -it crawler-app bash
  ./vendor/bin/phpunit
```


## Autores

- [@adrianomarinho](https://www.github.com/adrianomarinho)

