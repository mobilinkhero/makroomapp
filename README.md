# Makroom Laravel Admin Panel

Professional admin panel for managing the Makroom mobile app with country-based configuration switching.

## 🚀 Features

### Admin Panel
- **Dashboard** - Statistics and quick actions
- **Country Management** - Bulk whitelist management with visual cards
- **UI Settings** - Control app behavior (contact admin button, messages, features)
- **Configurations** - Manage Config A (SIM Owner) and Config B (Room Search)
- **Records** - CRUD operations for app content
- **App Texts** - Manage text strings

### API Endpoints
- `GET /api/config` - Get app configuration based on country
- `POST /api/search` - Search records
- `GET /api/health` - Health check

### Key Features
- Country-based config switching (Config A for whitelisted, Config B for others)
- Server-driven UI architecture
- Bulk country management
- UI settings control (contact admin button, messages, etc.)
- SQLite database
- Modern Tailwind CSS design
- RESTful API for Flutter app

## 📋 Requirements

- PHP 8.2+
- Composer
- SQLite

## 🛠️ Installation

### 1. Clone the repository
```bash
git clone https://github.com/mobilinkhero/makroomapp.git
cd makroomapp
```

### 2. Install dependencies
```bash
composer install
```

### 3. Set up environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Create database
```bash
touch database/database.sqlite
```

### 5. Run migrations
```bash
php artisan migrate
```

### 6. Seed database
```bash
php artisan db:seed --class=CountrySeeder
php artisan db:seed --class=AppConfigSeeder
php artisan db:seed --class=AppTextSeeder
php artisan db:seed --class=RecordSeeder
php artisan db:seed --class=UISettingSeeder
```

### 7. Start server
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

## 🌐 Access

### Admin Panel
```
http://localhost:8000/admin
```

### API Endpoints
```
GET  http://localhost:8000/api/config
POST http://localhost:8000/api/search
GET  http://localhost:8000/api/health
```

## 📊 Database Structure

### Tables
- `countries` - Country list with whitelist status
- `app_configs` - Config A and Config B settings
- `records` - App content (SIM details or rooms)
- `app_texts` - Text strings for the app
- `ui_settings` - UI behavior settings

### Sample Data
- 40 countries (5 whitelisted, 35 not)
- 2 app configurations
- 9 sample records
- 8 app text strings
- 8 UI settings

## 🎯 How It Works

### Country-Based Config Switching

1. Mobile app requests config: `GET /api/config`
2. Server checks country code (from header `X-Country-Code`)
3. If country is whitelisted → Returns Config A (SIM Owner Details)
4. If country is NOT whitelisted → Returns Config B (Room Search)
5. App renders UI based on config

### Admin Panel Workflow

1. **Manage Countries**: Select multiple countries and add to Config A or move to Config B
2. **UI Settings**: Toggle contact admin button, set messages, enable/disable features
3. **Records**: Create, edit, delete content for both configs
4. **Configurations**: Edit app title, search placeholder, components, feature flags

## 🔧 Configuration

### Whitelisted Countries (Config A)
- United States (US)
- United Kingdom (GB)
- Canada (CA)
- Australia (AU)
- Germany (DE)

### Config A - SIM Owner Details App
- For whitelisted countries
- Search placeholder: "Enter phone number or SIM details..."
- Features: Advanced search, Export, Notifications

### Config B - Room Finder App
- For non-whitelisted countries
- Search placeholder: "Search for rooms..."
- Features: Advanced search, Favorites

## 📱 Mobile App Integration

The API returns configuration with UI settings:

```json
{
  "version": "1.0.0",
  "components": [...],
  "featureFlags": {...},
  "uiSettings": {
    "show_contact_admin_button": true,
    "contact_admin_email": "admin@simowner.com",
    "no_results_message": "No SIM owner details found. Please contact admin for assistance.",
    "enable_advanced_search": true
  }
}
```

## 🎨 Admin Panel Features

### Dashboard
- Total countries count
- Whitelisted countries count
- Total records count
- Active records count
- Config A vs Config B breakdown

### Country Management
- Visual card-based layout
- Bulk selection with checkboxes
- "Select All" / "Deselect All" buttons
- Bulk actions for Config A/B
- Color-coded cards (Blue = Config A, Purple = Config B)

### UI Settings
- Toggle "Contact Admin" button ON/OFF
- Set contact admin email
- Customize "No Results" message
- Enable/disable features
- Separate settings for Config A and Config B

## 🚀 API Usage

### Get Configuration
```bash
curl -H "X-Country-Code: US" http://localhost:8000/api/config
```

### Search Records
```bash
curl -X POST http://localhost:8000/api/search \
  -H "Content-Type: application/json" \
  -d '{"query":"office","config_type":"config_b"}'
```

### Health Check
```bash
curl http://localhost:8000/api/health
```

## 📝 Development

### Add New Country
```php
Country::create([
    'name' => 'France',
    'code' => 'FR',
    'is_whitelisted' => false
]);
```

### Add New Record
```php
Record::create([
    'config_type' => 'config_b',
    'title' => 'Meeting Room',
    'description' => 'Professional meeting space',
    'is_active' => true,
    'data' => json_encode([
        'capacity' => ['type' => 'number', 'value' => 10],
        'rating' => ['type' => 'number', 'value' => 4.5]
    ])
]);
```

### Add New UI Setting
```php
UISetting::create([
    'key' => 'config_a_show_help_button',
    'config_type' => 'config_a',
    'setting_type' => 'boolean',
    'value' => 'true',
    'label' => 'Show Help Button',
    'description' => 'Display help button in the app'
]);
```

## 🔒 Security

- CORS enabled for API endpoints
- Input validation on all forms
- SQL injection protection (Eloquent ORM)
- XSS protection (Blade templating)

## 📄 License

This project is proprietary software.

## 👥 Support

For support, email: admin@makroom.com

## 🎉 Credits

Built with Laravel 11, Tailwind CSS, and modern web technologies.
