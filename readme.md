# Teste BackEnd Melhor Envio

**Alexandre Specht Jansen**

###Andamento do teste
1. Criação do ambiente de desenvolvimento em máquina Linux com Ubuntu 18.04. Com instalação do PHP 7.2.16 e demais pacotes necessários,  MySQL 5.7, Apache, Composer e Git.
2. Instalação do Laravel através de composer create-project
3. Configurações gerais do Laravel e criação do banco de dados `melhorenvio`.
4. Para a criação das tabelas do banco de dados utilizei a ferramenta de migrations do Laravel.
5. Criação de rotas.
6. Criação dos controllers.
7. Criação das views.
8. Criação do form request com validações.
9. Estruturação do controller respeitando as regras de negócio.
 
###Tempo decorrido
 - Dia 20/03: Trabalho a partir das 16h às 18:30 e 20:30 às 0h
 - Dia 21/03: Trabalho a partir das 09h às 12h e 13h às 18h
  
###Dificuldades encontradas
Inicialmente perdi tempo com problemas para instalação das extensões mbstring no ambiente linux, mas maiores dificuldades encontradas foram em relação a problemas com pacotes do PHP e configuração de acesso do cURL. Tive problemas com o ambiente de desenvolvimento Linux em relação a extensões de PDO, onde não era possível realizar a conexão como o banco de dados pelo projeto e rodar comandos referentes a migrations pelo php artisan. 
Após algumas tentativas sem sucesso, resolvi criar um novo ambiente de dev na máquina Windows. Não tive problemas com o extensões de PDO, porém algo que me fez perder algum tempo foi um problema com permissões para criar requisições cURL. Consegui contornar baixando um novo pacote de certificados e linkando-o no php.ini, alterando o caminho dos certificados indicado originalmente.

Obrigado e quaisquer dúvidas, estou disposto a responder. :)