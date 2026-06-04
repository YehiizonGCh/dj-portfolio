# 🎧 DJ Portfolio — Yehiizon GarroCh

Sitio web personal para DJ con panel de administración completo, construido con Laravel 13 y Tailwind CSS.

## 🚀 Stack

- **Backend:** Laravel 13 + PHP 8.3
- **Frontend:** Blade + Tailwind CSS
- **Base de datos:** SQLite
- **Assets:** Vite + pnpm

## ✨ Features

### Sitio público
- Hero con foto, bio y redes sociales
- Página de eventos (próximos y pasados)
- Player de mixes (SoundCloud, Mixcloud, YouTube)
- Galería de fotos y videos con lightbox y filtros
- Formulario de reservación de eventos
- Formulario de contacto

### Panel de administración
- Dashboard con estadísticas
- CRUD de Eventos (con flyer)
- CRUD de Mixes (embed externo)
- CRUD de Galería (fotos y videos)
- Gestión de Reservaciones
- Inbox de Mensajes
- Edición de Perfil completo

## 📦 Instalación local

```bash
# Clonar repositorio
git clone https://github.com/tu-usuario/dj-portfolio.git
cd dj-portfolio

# Instalar dependencias PHP
composer install

# Instalar dependencias JS
pnpm install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Migraciones
php artisan migrate

# Storage link
php artisan storage:link

# Build assets
pnpm run build

# Servidor de desarrollo
php artisan serve
```

## 🔐 Crear usuario administrador

```bash
php artisan tinker
```

```php
App\Models\User::create([
    'name' => 'Yehiizon',
    'email' => 'tu@email.com',
    'password' => bcrypt('tu_password'),
]);
```

## 🌐 Deploy

El proyecto está configurado para deploy en Railway o Render.

## 📁 Estructura
app/
├── Http/Controllers/
│   ├── Admin/          ← Controllers del panel admin
│   └── ...             ← Controllers del sitio público
├── Models/             ← Event, Mix, Gallery, Reservation, Message, Profile
database/
├── migrations/         ← Todas las migraciones
resources/
├── views/
│   ├── admin/          ← Vistas del panel admin
│   ├── public/         ← Vistas del sitio público
│   └── layouts/        ← Layouts admin y público

## 📝 Licencia

Proyecto personal — todos los derechos reservados.