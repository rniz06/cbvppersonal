![Logo](http://www.bomberoscbvp.org.py/wp-content/uploads/2022/12/CBVP-escudo.png)

# Sistema de Gestión de Expedientes Electronicos

Sistema de Personal desarrollado con laravel utilizando ademas el paquete filament

## Tecnologías
- Laravel 11
- Filament 3 

## Requisitos previos

- PHP 8.2 o superior
- Composer
- Una base de datos compatible (MySQL, PostgreSQL, SQLite, etc.) por defecto usamos mysql

## Instalación

1. Clona el repositorio:

    ```bash
    git clone https://github.com/rniz06/cbvppersonal.git
    ```

2. En el directorio Instala las dependencias de Composer:
    ```bash
    composer install
    ```

3. Copia el archivo de configuración .env.example a .env y configura tus variables de entorno:
    ```bash
    cp .env.example .env
    ```

4. Genera una nueva clave de aplicación:
    ```bash
    php artisan key:generate
    ```

5. Realiza las migraciones y ejecuta los seeders:
    ```bash
    php artisan migrate --seed
    ```

6. Ejecutar el comando de shield para generar los roles y permisos para cada modulo:
    ```bash
    php artisan shield:install
    ```

¡Listo! Ahora puedes acceder al sistema en tu navegador web.

# OBSERVACIONES:

Verificar que los permisos, roles y policies del paquete se hallan generado correctamente, en caso que no, ejecutar los siguientes comandos:

```bash
php artisan shield:generate --all
```
Genera devuelta todos los permisos, roles y policies.

```bash
php artisan shield:super-admin
```

Comando para seleccionar usuario administrador.

# Uso

Una vez instalado, puedes iniciar sesión en el sistema utilizando las siguientes credenciales:

Correo: #
Contraseña: #

# Soporte

Ante dudas o consultas contactar al correo ronaldalexisniznunez@gmail.com