# 🔐 TaskAuth
 
Una aplicación web de gestión de tareas **multiusuario** construida con **Laravel**. Cada usuario se registra, inicia sesión y gestiona sus propias tareas de forma privada y segura.
 
Este proyecto amplía un CRUD básico incorporando **autenticación de usuarios** y **relaciones entre tablas**, dos pilares de cualquier aplicación web real.
 
---
 
## ✨ Características
 
- 👤 **Registro e inicio de sesión** de usuarios
- 🔒 **Rutas protegidas**: solo usuarios autenticados acceden a sus tareas
- 🙈 **Aislamiento de datos**: cada usuario ve únicamente sus propias tareas
- ➕ **Crear** tareas
- ✅ **Completar** tareas
- 🗑️ **Eliminar** tareas
- 🚪 **Cerrar sesión**
- 🎨 Interfaz moderna y responsiva
---
 
## 🛠️ Tecnologías utilizadas
 
- **Laravel 13** — framework de PHP
- **PHP 8.5**
- **SQLite** — base de datos
- **Blade** — motor de plantillas
- **Livewire** — starter kit de autenticación
- **Eloquent ORM** — para datos y relaciones
- **HTML & CSS** — interfaz
---
 
## 🧠 Conceptos aplicados
 
Este proyecto demuestra el manejo de:
 
- **Autenticación** integrada de Laravel (registro, login, logout)
- **Middleware** (`auth`) para proteger rutas
- **Relaciones Eloquent**: `hasMany` y `belongsTo` (un usuario tiene muchas tareas; una tarea pertenece a un usuario)
- **Claves foráneas** (`foreignId`, `constrained`, `onDelete('cascade')`)
- **Aislamiento de datos por usuario** con `auth()->user()->tasks`
- Patrón **MVC** completo (Modelo - Vista - Controlador)
- **Rutas** con verbos HTTP (GET, POST, PATCH, DELETE)
- **Migraciones** y **modelos** Eloquent
- **Vistas Blade** con directivas (`@foreach`, `@if`, `@csrf`, `@method`)
---
 
## 🔗 La relación usuario–tarea
 
El corazón de este proyecto es cómo se conectan los usuarios con sus tareas:
 
```
   User (usuario)                 Task (tarea)
   hasMany  ─────────────►        belongsTo
   "tiene muchas tareas"          "pertenece a un usuario"
```
 
Gracias a la columna `user_id` en la tabla `tasks` y a las relaciones Eloquent, cada tarea sabe quién es su dueño, y cada usuario solo puede ver y modificar las suyas.
 
---
 
## 🚀 Instalación
 
```bash
# 1. Clona el repositorio
git clone https://github.com/nahuelito9/taskauth.git
 
# 2. Entra a la carpeta del proyecto
cd taskauth
 
# 3. Instala las dependencias de PHP
composer install
 
# 4. Instala las dependencias de frontend
npm install
 
# 5. Copia el archivo de entorno
cp .env.example .env
 
# 6. Genera la clave de la aplicación
php artisan key:generate
 
# 7. Ejecuta las migraciones (crea las tablas)
php artisan migrate
 
# 8. Compila los assets y enciende el servidor
npm run dev
php artisan serve
```
 
Luego abre tu navegador en `http://127.0.0.1:8000`, regístrate y empieza a gestionar tus tareas.
 
---
 
## 📸 Capturas de pantalla
 
<!-- Sube tus capturas al repositorio y enlázalas aquí, por ejemplo: -->
<!-- ![Login](docs/login.png) -->
<!-- ![Mis tareas](docs/tareas.png) -->
 
_Próximamente_
 
---
 
## 📌 Estado del proyecto
 
🚧 En desarrollo — proyecto de aprendizaje en evolución. Próximas mejoras posibles:
 
- Editar el título de las tareas
- Fechas de vencimiento y prioridades
- Contador de tareas pendientes/completadas
- Verificación de email
---
 
## 👤 Autor
 
Desarrollado por [nahuelito9](https://github.com/nahuelito9) como parte de mi camino aprendiendo desarrollo web con Laravel.
 
Este es mi segundo proyecto con Laravel, enfocado en autenticación y relaciones entre tablas.