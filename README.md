# Dashboard Administrativo con Filament PHP

[![PHP Version](https://img.shields.io/badge/php-%5E8.2-8892BF.svg)](https://php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20.svg?logo=laravel)](https://laravel.com/)
[![Filament](https://img.shields.io/badge/Filament-3.x-4F46E5.svg)](https://filamentphp.com/)

Un sistema de gestión administrativa construido con Laravel y Filament PHP, diseñado para ofrecer una interfaz intuitiva y potente para la gestión de usuarios, productos, pedidos y clientes.

## 🚀 Características Principales

- Panel de administración completo con autenticación
- Gestión de usuarios y roles
- CRUD completo para productos, pedidos y clientes
- Widgets personalizados para estadísticas
- Interfaz moderna y responsiva
- Soporte multilingüe (Español/Inglés)
- Generación de carnets personalizados

## 🛠️ Requisitos Técnicos

- PHP 8.2 o superior
- Composer 2.0 o superior
- Node.js 16.x o superior y NPM
- Base de datos compatible con Laravel (MySQL/PostgreSQL/SQLite/SQL Server)
- Servidor web (Apache/Nginx) con soporte para PHP
- Extensión PHP GD para el procesamiento de imágenes

## 🚀 Instalación

1. Clonar el repositorio:
   ```bash
   git clone [URL_DEL_REPOSITORIO]
   cd Dashboard-Filament
   ```

2. Instalar dependencias de PHP:
   ```bash
   composer install
   ```

3. Instalar dependencias de Node.js:
   ```bash
   npm install
   npm run build
   ```

4. Configurar el archivo .env:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Configurar la base de datos en el archivo `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_base_datos
   DB_USERNAME=usuario
   DB_PASSWORD=contraseña
   ```

6. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```

7. Iniciar el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

8. Acceder al panel de administración:
   - URL: http://localhost:8000/admin
   - Usuario: admin@example.com
   - Contraseña: password

## 🏗️ Estructura del Proyecto

```
app/
├── Filament/
│   ├── Pages/         # Páginas personalizadas de Filament
│   ├── Resources/     # Recursos de Filament
│   └── Widgets/       # Widgets personalizados
├── Http/
│   └── Controllers/   # Controladores de la aplicación
└── Models/            # Modelos Eloquent
```

## 📊 Características Técnicas

- **Backend**: Laravel 10.x
- **Frontend**: Filament PHP 3.x, Tailwind CSS, Alpine.js
- **Base de datos**: MySQL/PostgreSQL
- **Autenticación**: Laravel Sanctum
- **Procesamiento de imágenes**: Intervention Image
- **Internacionalización**: Soporte para múltiples idiomas

## 📝 Licencia

Este proyecto está bajo la [Licencia MIT](LICENSE).

## 🤝 Contribución

Las contribuciones son bienvenidas. Por favor, lee las [guías de contribución](CONTRIBUTING.md) para más detalles.

## 📞 Soporte

Para soporte, por favor abre un issue en el repositorio o contacta al equipo de desarrollo.
