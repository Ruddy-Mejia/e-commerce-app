# Requerimientos mínimos

- PHP: ^8.2
- Laravel: ^11.31
- NPM: ^10.9.*

# Instalación
Ejecutar los siguientes comandos para realizar la instación de las librerias requeridas.

```sh
composer install
npm install
php artisan key:generate
```
Ejecutar los siguientes comandos para migrar la base de datos. (mysql)

```sh
php artisan migrate
php artisan db:seed
```

Ejecutar el siguiente comando para usar la aplicación. (el puerto por defecto es el 8000)

```sh
php artisan serve
```

# Nota

Para una mejor comprensión y mejor manejo del sistema, te recomiendo visitar mi canal de YT @rmejiam_dev06