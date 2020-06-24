# Agenda de Contatos Back-End em Laravel
PHP >= 7.1
MySql >= 5 ou Equivalente
Composer

# Instalação
- No terminal: git clone https://github.com/joaovosilva/agenda_de_contatos_full.git
- No terminal: cd agenda_de_contatos_full
- No terminal: composer install
- Copie o arquivo .env.example para .env e ajuste as configurações do banco de dados mysql
- Crie a base de dados informada no arquivo .env em seu servidor mysql
- No terminal: php artisan jwt:secret
- No terminal: php artisan migrate

- Para subir o servidor no terminal: php artisan serve
- Acesse localhost:8000
