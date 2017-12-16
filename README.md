# Laravel 5 Shop Project

## Installation
1. Install Composer using detailed installation instructions [here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
2. Install Node.js using detailed installation instructions [here](https://nodejs.org/en/download/package-manager/)
3. Clone repository
    ```
    $ git clone https://github.com/werwolf41/larashop.git
    ```
4. Change into the working directory
    ```
    $ cd larashop
    ```
5. Copy `.env.example` to `.env` and modify according to your environment
    ```
    $ cp .env.example .env
    ```
6. Create folder
    ```
    $ cp .env.example .env 
    $ mkdir bootstrap/cache storage storage/framework 
    $ cd storage/framework 
    $ mkdir sessions views cache
    ```
7. Install composer dependencies
    ```
    $ composer install --prefer-dist
    ```
8. An application key can be generated with the command
    ```
    $ php artisan key:generate
    ```
9. Execute following commands to install other dependencies
    ```
    $ npm install
    $ npm run dev
    ```
10. Run these commands to create the tables within the defined database and populate seed data
    ```
    $ php artisan migrate --seed
    ```
