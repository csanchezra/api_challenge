# Challenge API


> ### Microservicio capaz de aceptar solicitudes REST que recibe como parámetro el nombre de la ciudad o las coordenadas (latitud y longitud) y devuelve una sugerencia de lista de reproducción de acuerdo con la temperatura actual.

----------

# Empezando

## Instalación

Previamente se debe contar con docker 

Clone the repository

    git clone https://github.com/csanchezra/api_challenge.git

Ingresar a la carpeta del repositorio

    cd api_challenge
    
Ingresar a la carpeta src

    cd src    

Instalar las dependencias usando composer

    composer update

Copie el archivo env de ejemplo

    cp .env.example .env
 
Levantar el API
 
    php artisan serve  

## Docker

Para instalar con [Docker](https://www.docker.com):

Regresar a la carpeta raíz

    cd ..  

Ejecutar el proyecto en docker y esperar la instalacion unos minutos

    docker-compose up -d

Puede acceder al servidor en http://localhost:8080/


## Base de datos

**La base de datos es remota y no se requiere realizar migraciones**

## Especificaciones del API

Tipo de peticiones aceptadas: GET

Sólo se puede acceder al endpoint proporcionado

----------

# Descripción general del código

## Folders

- `app` - Carpeta que contiene el núcleo del API
- `app/Http/Controllers/Api/v1` - Contiene los controladores del API
- `app/Http/Requests/v1` - Contiene los requests del API
- `app/Lib` - Contiene blibliotecas internas para la conexión con Spotify
- `app/Http/Models` - Contiene los modelos para la persistencia de datos en BD
- `config` - Contiene todos los archivos de configuración del API
- `routes` - Contiene todas las rutas del API definidas en api.php, adicionalmete en web.php se adecuo para mostrar 404 en cualquier otra ruta
- `tests` - Contiene los test creados para el API

## Variables de entorno

- `.env` - Variables de entorno para el uso del API

- SPOTIFY_CLIENT_ID
- SPOTIFY_CLIENT_SECRET
- SPOTIFY_URL
- WEATHER_APPID
- WEATHER_URL

----------

## APIS utilizadas 

- Clima: https://openweathermap.org/api
- Playlist: 	https://api.spotify.com/v1/

## El API puede ser accedido desde

    http://localhost:8080/api/v1/posts/find_playlist/?city=Tehuacan&lat=30.489772&lon=-99.771335

Request headers

| **Required** 	| **Identificador**              	| **Valor**            	|
|----------	|------------------	|------------------	|
| Optional 	| city     	| text 	|
| Optional 	| lat 	| int   	|
| Optional 	| lon    	| int      	|

Consideraciones de headers

city: obligatorio si no se ingreso latitud y logitud, debe cumplir con la siguiente sintaxis: ciudad

lat: obligatorio si no se ingreso city, debe estar entre: -90.0 y +90.0

lon: obligatorio si no se ingreso city, deben estar entre: -180.0 y +180.0

----------


 
