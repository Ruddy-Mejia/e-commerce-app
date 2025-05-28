# Requerimientos mínimos - Minimum requirements

- PHP: ^8.2
- Laravel: ^11.31
- NPM: ^10.9.*

# Instalación - Instalation
Ejecutar los siguientes comandos para realizar la instación de las librerias requeridas.
Execute the following commands to perform the installation of the required libraries.

```sh
composer install
npm install
php artisan key:generate
php artisan storage:link
```

Ejecutar los siguientes comandos para migrar la base de datos. (mysql)
Execute the following commands to migrate the database. (mysql)

```sh
php artisan migrate
php artisan db:seed
```

Ejecutar el siguiente comando para usar la aplicación. (el puerto por defecto es el 8000)
Execute the following command to use the application. (the default port is 8000)

```sh
php artisan serve
```