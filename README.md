# testsummer

# Instalar la prueba
- El primero paso es descargar el codigo con las sentencias de GIT
- Se debe tener inatalado
    - **COMPOSER**
    - **DOCKER**

##Paso a paso
- Una vez descargado el repositorio entre desde consola a la carpeta SRC e instale composer, para poder instalar las dependencias de laravel


    cd src
    composer install

- Ahora salga de la carpeta SRC y ejecute el docker compose


    cd..
    docker-compose up -d
Asegurece de que  nginx y  php esten corriendo


    docker-compose ps
- De permisos a la carpeta STORAGE

      docker exec sellr_php chmod -R 777 storage/
      docker exec sellr_php chmod -R 777 storage/logs/
- Vaya a la URL http://localhost/, si sale un error de permisos vuelva a ejecutar

      docker exec sellr_php chmod -R 777 storage/
## RUTAS API
La api tiene un sistema de tokens en Auth2 para esto existe dos rutas con las que le usuario se puede loguear,
estas se visualizan en la carpeta routers/api.php

- POST api/registers
  - Espera un arreglo de objetos
  
    `   {
    "name":"test",
    "email":"tetswyit@test.com",
    "password":"12345678",
    "password_confirmation":"12345678"
    }`

![](https://raw.githubusercontent.com/Stivenson02/testsummer/main/src/resources/imgs/img1.png)

- POST api/login
  -Este espera un objeto con el correo y la contraseña

  ` {
  "email":"tets@test.com",
  "password":"12345678"
  }`


al igual que registre retorna la informacion del usuario y el token

![](https://raw.githubusercontent.com/Stivenson02/testsummer/main/src/resources/imgs/img2.png)


La logica del login por REST API se encuentra en los controlladores dentro de la carpeta API

        app/Http/Controllers/API

Se creo un mini CRUD para probar su funcionalidad:

En el archivo de _routers/api.php_, por medio de un midleware se controla que el usuario este logueado, por ende para las siguientes rutas es necesario pasar en los header el campo **Authorization** con "Beare "+Token 

## Rutas con auth

- GET api/user: Retorna la informacion del usario logueado
- POST api/user_detail: Existe una relacion Uno a Uno entre users y users_detail, en esta tabla se almacena informacion extra

El controlador de las rutas es Users/UserController.php en el se encuentra la logica para almacenar y mostrar informacion

la relacion de la tabla se encuentra en el modelo Models/UserDetail.php

![](https://raw.githubusercontent.com/Stivenson02/testsummer/main/src/resources/imgs/img3.png)
![](https://raw.githubusercontent.com/Stivenson02/testsummer/main/src/resources/imgs/img5.png)
![](https://raw.githubusercontent.com/Stivenson02/testsummer/main/src/resources/imgs/img4.png)

