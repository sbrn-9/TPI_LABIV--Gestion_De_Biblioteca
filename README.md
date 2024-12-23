![Icon status project](http://img.shields.io/static/v1?label=STATUS&message=In%20development&color=RED&style=for-the-badge)

>[!IMPORTANT]
> Instrucciones:
> Antes de ejecutar hay que solucionar el error de clonacion de laravel con los siguientes pasos:
> 1) Primero ejecutar el comando Composer install
> 2) Ejecutar el comando "copy .env.example .env" (copiará todo lo que está en env.example a un nuevo archivo .env)
> 3) Colocar todos los datos de la base (nombre de la base y cambiar el db connection a mysql)
>- DB_CONNECTION=mysql
>- DB_HOST=127.0.0.1
>- DB_PORT=3306
>- DB_DATABASE=gestor_de_biblioteca
> 4) Cambiar la zona
 >- APP_TIMEZONE=America/Argentina/Buenos_Aires
 >- APP_URL=http://localhost
 >- APP_LOCALE=es
 >- APP_FALLBACK_LOCALE=es
>- APP_FAKER_LOCALE=es_ES
> 6) Generar una nueva key con el comando php artisan key:generate
> 7) Luego ejecutar npm install
> 8) Ejecutar el comando  "npm run build"
> 9) Ejecutar migraciones php artisan migrate
> 10) Correr seeders con el comando "php artisan db:seed"


>[!NOTE]
>- Usuarios (se le crearán automáticamente sus usuarios, puede probar registrarse pero será si o si un cliente, solo un admin puede crear admins): 
> - Admin email: profe@admin.com
> - Admin contraseña: 12345678
> - Cliente email: profe@cliente.com
> - Cliente contraseña: 12345678
> - Se preparó la aplicacion para que cada vez que se agregue un nuevo libro al negocio, se cargue con una imagen local de la maquina, por lo tanto con seeders no se cargan imágenes.
> - Al entrar a la aplicacion podra ver los préstamos cargados, y si ejecuta el comando 'php artisan app:actualizar-prestamo-atrasado'
    podrá ver como un préstamo activo con fecha de devolucion pasada se marca como atrasado.
# Contenidos
- [Tecnologías](#tecnologías)
- [DER](#der)
- [Colaboradores](#colaboradores)


## Tecnologías
<p align="center">
  <a href="https://skillicons.dev">
    <img src="https://skillicons.dev/icons?i=html,css,js,php,laravel,git&perline=3" />
  </a>
</p>

## MER
<p align="center">
  <img src="Gestor_De_Biblioteca/public/assets/img/DER- GESTOR DE BIBLIOTECA.drawio.png" width=800><br>
</p>



## Colaboradores
| [<img src="https://avatars.githubusercontent.com/u/113538071?v=4" width=115><br><sub>Sabrina Ayelen Arévalo</sub>](https://github.com/sbrn-9) |  [<img src="https://avatars.githubusercontent.com/u/128063237?v=4" width=115><br><sub>Guadalupe Sosa Fachinotti</sub>](https://github.com/GuadaFachinotti) |  [<img src="https://avatars.githubusercontent.com/u/163222282?v=4" width=115><br><sub>Juan Manuel Fernandez</sub>](https://github.com/jumanandez) |
| :---: | :---: | :---: |




