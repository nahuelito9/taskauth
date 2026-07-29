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

## 🌐 API REST
 
TaskAuth incluye una API REST para gestionar tareas mediante peticiones HTTP. Todas las rutas de tareas requieren autenticación por token (Laravel Sanctum).
 
### Autenticación
 
Para obtener un token, envía tus credenciales al endpoint de login:
 
```http
POST /api/login
Content-Type: application/json
 
{
    "email": "tu@email.com",
    "password": "tu_contraseña"
}
```
 
**Respuesta:**
 
```json
{
    "token": "1|aBcDeF123456..."
}
```
 
Guarda ese token y envíalo en cada petición protegida mediante la cabecera `Authorization`:
 
```http
Authorization: Bearer 1|aBcDeF123456...
```
 
### Endpoints
 
Todos los endpoints siguientes requieren la cabecera `Authorization: Bearer {token}`.
 
| Método | Ruta | Descripción |
|--------|------|-------------|
| `GET` | `/api/tareas` | Lista todas las tareas del usuario autenticado |
| `POST` | `/api/tareas` | Crea una nueva tarea |
| `PATCH` | `/api/tareas/{id}/completar` | Marca una tarea como completada |
| `DELETE` | `/api/tareas/{id}` | Elimina una tarea |
 
### Ejemplos
 
**Listar tareas**
 
```http
GET /api/tareas
Authorization: Bearer {token}
```
 
Respuesta:
 
```json
[
    {
        "id": 1,
        "user_id": 1,
        "title": "Aprender APIs",
        "completed": false,
        "created_at": "2026-07-29T13:00:00.000000Z",
        "updated_at": "2026-07-29T13:00:00.000000Z"
    }
]
```
 
**Crear una tarea**
 
```http
POST /api/tareas
Authorization: Bearer {token}
Content-Type: application/json
 
{
    "title": "Nueva tarea"
}
```
 
Respuesta (código `201 Created`):
 
```json
{
    "id": 2,
    "user_id": 1,
    "title": "Nueva tarea",
    "completed": false,
    "created_at": "2026-07-29T14:00:00.000000Z",
    "updated_at": "2026-07-29T14:00:00.000000Z"
}
```
 
**Completar una tarea**
 
```http
PATCH /api/tareas/2/completar
Authorization: Bearer {token}
```
 
**Eliminar una tarea**
 
```http
DELETE /api/tareas/2
Authorization: Bearer {token}
```
 
Respuesta:
 
```json
{
    "message": "Tarea eliminada"
}
```
 
### Validación
 
El campo `title` es obligatorio, debe ser texto y no superar los 255 caracteres. Si no se cumple, la API responde con código `422 Unprocessable Entity` y los detalles del error.
 
### Seguridad
 
Cada usuario solo puede ver y modificar sus propias tareas. Si un usuario intenta acceder a una tarea que no le pertenece, la API responde con `404 Not Found`.
 
### Tests
 
La API está cubierta por tests automatizados (`tests/Feature/TaskApiTest.php`) que verifican la autenticación, el CRUD completo y el aislamiento de datos entre usuarios. Para ejecutarlos:
 
```bash
php artisan test --filter=TaskApiTest
```
 
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