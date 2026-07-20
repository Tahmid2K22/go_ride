<p align="center"><strong>GoRide</strong> — A full-stack ride-hailing web application built with Laravel, Tailwind CSS, and Leaflet.js</p>

## About GoRide

GoRide is a ride-hailing platform (similar to Uber/Pathao) designed for the Bangladesh market. It supports three user roles — **Rider**, **Driver**, and **Admin** — with real-time map-based ride booking, dynamic fare calculation, driver onboarding, and an admin approval workflow.

## Features

- **Interactive Ride Booking** — Leaflet.js maps with OSRM routing for pickup/dropoff selection and real-time distance calculation
- **Dynamic Fare Calculation** — Base fare + per-km pricing based on vehicle type (Moto, Car AC, Parcel)
- **Multi-Role Authentication** — Rider, Driver, Admin with role-based access control
- **Driver Onboarding** — 2-step application form with admin approval workflow
- **Driver Dashboard** — Online/offline toggle, pending ride requests, earnings tracking, active ride management
- **Admin Panel** — Application review, approve/reject with email notification, dashboard stats
- **Ride Lifecycle** — pending → accepted → ongoing → completed/cancelled with automatic history archival
- **Bilingual Support** — English and Bengali via URL parameter (`?lang=bn`)
- **Payment Methods** — Cash and bKash
- **Mobile-Responsive UI** — Bottom navbar, gradient design, Tailwind CSS

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 11, PHP 8.2+ |
| Frontend | Blade, Tailwind CSS, Alpine.js |
| Maps | Leaflet.js 1.9.4, OSRM Routing, Nominatim Geocoding |
| Build | Vite 8, PostCSS, Autoprefixer |
| Database | MySQL |
| Admin | Custom Blade views + Filament (SPA panel) |
| Mail | SMTP (Gmail) |

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8+
- npm or yarn

## Installation

```bash
# Clone the repository
git clone <repository-url>
cd go_ride

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=go_ride
DB_USERNAME=root
DB_PASSWORD=

# Run migrations and seed demo data
php artisan migrate:fresh --seed

# Create storage symlink for public access
php artisan storage:link

# Build frontend assets
npm run build

# Start the development server
php artisan serve
```

The app will be available at `http://localhost:8000`.

## Demo Accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@goride.com.bd | password |
| Rider | rider@goride.com.bd | password |
| Driver (Bike) | driver.bike@goride.com.bd | password |
| Driver (Car) | driver.car@goride.com.bd | password |

## Project Structure

```
go_ride/
├── app/
│   ├── Http/Controllers/      # 8 controllers
│   │   ├── AuthController         # Login, register, logout
│   │   ├── RideController         # Book ride, store request
│   │   ├── DriverApplicationController  # 2-step driver application
│   │   ├── DriverDashboardController    # Driver dashboard + ride actions
│   │   ├── AdminApplicationController   # Approve/reject applications
│   │   └── DashboardController          # Rider dashboard
│   ├── Models/                # User, Ride, Service, DriverProfile, RiderApplication, RideHistory
│   ├── Services/
│   │   └── RideCalculator     # Haversine distance + fare calculation
│   ├── Mail/
│   │   └── DriverCredentials  # Mailable for approved driver credentials
│   └── Filament/              # Filament admin panel resources
├── database/
│   ├── migrations/            # 15 migrations (8 tables)
│   └── seeders/               # ServiceSeeder, UserSeeder, RideSeeder
├── lang/
│   ├── en/app.php             # English translations (187+ keys)
│   └── bn/app.php             # Bengali translations
├── resources/
│   ├── views/
│   │   ├── layouts/           # app, guest, navigation
│   │   ├── components/        # Bottom navbar, forms, modals (16+ components)
│   │   ├── admin/             # Admin dashboard, application views
│   │   ├── driver-application/ # Step 1, Step 2, success
│   │   ├── auth/              # Login, register
│   │   └── emails/            # Driver credentials email template
│   ├── css/
│   └── js/
└── routes/web.php             # All routes
```

## Database Schema

| Table | Description |
|-------|-------------|
| `users` | Users with role enum (rider, driver, admin, pending_rider), phone (+880), is_active |
| `services` | Ride types with base_fare and per_km_rate |
| `rides` | Ride requests with pickup/dropoff, distance, fare, status |
| `driver_profiles` | Driver vehicle info, verification status, rating, online status |
| `rider_applications` | Driver applications with status workflow |
| `ride_histories` | Archived rides (auto-populated via MySQL trigger) |

## Ride Services & Pricing

| Service | Base Fare (TK) | Per KM (TK) |
|---------|---------------|-------------|
| Moto | 30 | 12 |
| Car AC | 100 | 35 |
| Parcel | 50 | 15 |

## Routes

| Route | Description |
|-------|-------------|
| `GET /` | Landing page |
| `GET /book-ride` | Ride booking page (rider) |
| `GET /dashboard` | Rider dashboard |
| `GET /driver/dashboard` | Driver dashboard |
| `GET /admin/dashboard` | Admin dashboard |
| `GET /apply-to-drive` | Driver application form |
| `GET /admin/applications` | Admin application list |

## Environment Variables

```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=go_ride
DB_USERNAME=root
DB_PASSWORD=

# Mail (Gmail SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password

# Optional: OpenRouteService API key for advanced routing
OPENROUTESERVICE_API_KEY=your-key
```

## License

This project is for educational purposes.
