🌤️ WeatherApp - Documentación de Instalación y Uso

WeatherApp es una aplicación web construida con Laravel 8 modularizada con nWidart/laravel-modules. Permite registrar usuarios, autenticar con Sanctum, consultar el clima actual de ciudades, guardar favoritas, ver historial y consumir una API documentada con Swagger.

✅ Requisitos del sistema

PHP >= 8.0

Composer

Node.js y NPM

SQLite o MySQL

🚀 Instalación del proyecto

Clonar el repositorio:

 git clone https://github.com/tuusuario/weather-app.git
 cd weather-app

Instalar dependencias:

composer install
npm install && npm run dev

Copiar archivo de entorno y configurar:

cp .env.example .env
php artisan key:generate

Editar .env:
Configurar los siguientes valores:

DB_CONNECTION=sqlite
DB_DATABASE=/ruta/absoluta/a/database/database.sqlite
WEATHER_API_KEY=tu_clave_api_de_weatherapi.com

Crear base de datos si usas SQLite:

touch database/database.sqlite

Ejecutar migraciones y seeders:

php artisan migrate --seed

Publicar assets de los módulos (si aplica):

php artisan module:publish

🧩 Paquetes utilizados

laravel/sanctum: Autenticación API por token

nwidart/laravel-modules: Estructura modular

knuckleswtf/scribe: Documentación de API (Swagger)

nnjeim/world: Listado de países y ciudades

spatie/laravel-permission: Roles y permisos (en desarrollo)

🔐 Autenticación

Registro de usuario

Login y generación de token con Laravel Sanctum

Middleware auth:sanctum para proteger rutas

Middleware personalizado check-token-expiration

Logout y expiración de token

🔧 Módulos disponibles

UserModule: Registro, login, logout, home

Weather: Consulta de clima con WeatherAPI

Favorite: Agregar/Quitar ciudades favoritas, listar y verificar

History: Mostrar búsquedas recientes

📦 Endpoints principales (Swagger en /docs)

Auth

POST /api/usermodule/register

POST /api/usermodule/login

GET /api/usermodule/home

POST /api/usermodule/logout

Weather

POST /api/weather/weatherclimate

Favoritos

POST /api/favorites/toggleFavorite

POST /api/favorites/add

POST /api/favorites/remove

POST /api/favorites/isFavorite

GET /api/favorites/listFavoritesApi

Historial

POST /api/history/history

🧪 Pruebas con PHPUnit

Crear archivo de prueba:

php artisan make:test NombreTest --unit

Ejecutar pruebas:

php artisan test

Ejecutar prueba individual:

php artisan test --filter NombreDelMetodoDePrueba

📑 Documentación Swagger

Generar documentación:

php artisan scribe:generate

Acceder en el navegador:

http://localhost:8000/docs

🌐 Interfaz web

Interfaz construida con Blade, TailwindCSS y componentes Alpine.js

Formulario minimalista de login y registro

Dashboard con consulta de clima y favoritos

Vista de historial y favoritos

📁 Estructura modular (ejemplo)

Modules/
  User/
    Http/
    Models/
    Routes/
  Weather/
  Favorite/
  History/

✨ Extras

Multiidioma parcial (lang/es/validation.php)

Control de errores con validaciones y respuestas JSON

Animaciones y feedback visual con SweetAlert y Select2

📬 Contacto

Desarrollado por Gabriel Rodriguez

¡Gracias por usar WeatherApp! 🌦️
