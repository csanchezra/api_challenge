Proyecto que obtiene de acuerdo a la ciudad o latitud y longitud te devuelve una lista de reproducción de acuerdo a la temperatura actual

La documentacion se entrega en la carpeta apidoc, abriendo en un navegador el index correspondiente

En cuanto a lo utilizado se requitirió utilizar el api de OpenWeatherMap y Spotify por lo cual se integró una solución de terceros para el último mencionado

Tecnologias usadas: php 8.1, laravel 8, mysql 8.0.13-4

Se requiere contar con composer para ejecutar diversos comandos en los siguientes pasos

Para utilizar el api en un entorno local se requiere descomprimir el proyecto en el entorno de su preferencia, ejecutar cp .env.copy .env y
tener la base de datos api challenge en MySQL, una vez creada correr la migracion con el
comando php artisan migrate, una vez realizado los pasos anteriores levantar el servicio correspondiente con el comando: php artisan serve

Se puede realizar solicitudes desde el siguiente link, de preferencia utilizar herramientas como Postman:

http://localhost:8000/api/v1/posts/find_playlist/?city=Puebla,mx

Campos

City: obligatorio si no se ingreso latitud y logitud, debe cumplir con la siguiente sintaxis: ciudad,abreviatura_pais (ejemplo:mx)

Lat: obligatorio si no se ingreso city, debe estar entre: -90.0 y +90.0

Lon: obligatorio si no se ingreso city, deben estar entre: -180.0 y +180.0

Si city es ingresado se ignora lat y lon
