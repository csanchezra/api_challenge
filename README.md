Proyecto que obtiene de acuerdo a la ciudad o latitud y longitud te devuelve una lista de reproducción de acuerdo a la temperatura actual

La documentacion se entrega en la carpeta apidoc, abriendo en un navegador el index correspondiente

En cuanto a lo utilizado se requitirió utilizar el api de OpenWeatherMap y Spotify por lo cual se integró una solución de terceros para el ultimo mencionado

Tecnologias usadas: php 8.1, laravel 8, mysql 10.4.24

Se requiere contar con composer para ejecutar diversos comandos en los siguientes pasos

Para utilizar el api en un entorno local se requiere descomprimir el proyecto en el entorno de su preferencia y
tener la base de datos api challenge en MySQL, una vez creada correr la migracion con el
comando php artisan migrate, una vez realizado los pasos anteriores levantar el servicio correspondiente con el comando php artisan serve

Se puede realizar solicitudes desde el siguiente link, de preferencia utilizar herramientas como Postman:

http://localhost:8000/api/v1/posts/find_playlist/?city=Puebla,mx
