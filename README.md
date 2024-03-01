# Welcome to Api Rest Full!

Hola, me llamo gustavo herrera y he construido el api rest full para laravel, usando mvc y colocando el sanctum para la proteccion de rutas.


# Requerimientos
Los requerimientos para correr el sistema es un servidor con la version  **php 8.2** y una base de datos mysql de versión 8.

Dentro de la carpeta public se encuentra la carpeta script alli se encuentra la carpeta del sql de la base de datos. El archivo se llama **api_rest_laravel_db.sql**


# Instrucciones para levantar

**Antes de iniciar se debe copiar el archivo .env.example para generar el .env en caso de no existir.**

1. Se debe verificar que la base de datos este levantada y verificar los parametros de conexión en el archivo .env donde encontraremos los datos, ejemplo:  
> DB_DATABASE = api_rest_laravel_db                                 
> DB_USERNAME = usuario-de-base-datos
> DB_PASSWORD= clave-de-base-datos
2. Dentro de la carpeta raiz del proyecto se debe correr php con el siguiente comando: ```php artisan serve``` este comando levantara el proyecto.

## Pruebas
Se encuentra en la carpeta public la colleccion del postman para realizar las pruebas. La carpeta se llama postman-collection.