# Deployment Guide for Cloudflare/Coolify

## 🚀 Quick Deploy

### Environment Variables

Set these in your Coolify/Cloudflare dashboard:

```env
APP_NAME=Makroom
APP_ENV=production
APP_KEY=base64:62H0whOgoWMJ1ENn7+/2+fu6Xd+rfHOgJbIAmZP2TG8=
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error

MAIL_MAILER=log
```

### Build Commands

```bash
# Install dependencies
composer install --no-dev --optimize-autoloader

# Generate key (if not set)
php artisan key:generate

# Create database
touch database/database.sqlite

# Run migrations
php artisan migrate --force

# Seed database
php artisan db:seed --class=CountrySeeder --force
php artisan db:seed --class=AppConfigSeeder --force
php artisan db:seed --class=AppTextSeeder --force
php artisan db:seed --class=RecordSeeder --force
php artisan db:seed --class=UISettingSeeder --force

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Start Command

```bash
php artisan serve --host=0.0.0.0 --port=3000
```

## 📋 Coolify Configuration

### 1. Create New Project
- Go to Coolify dashboard
- Click "New Resource"
- Select "Public Repository"
- Enter: `https://github.com/mobilinkhero/makroomapp.git`

### 2. Set Environment Variables
Go to Environment tab and add:

```
APP_KEY=base64:62H0whOgoWMJ1ENn7+/2+fu6Xd+rfHOgJbIAmZP2TG8=
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite
```

### 3. Build Configuration

**Build Pack:** PHP
**PHP Version:** 8.2

**Install Command:**
```bash
composer install --no-dev --optimize-autoloader
```

**Build Command:**
```bash
touch database/database.sqlite && \
php artisan migrate --force && \
php artisan db:seed --class=CountrySeeder --force && \
php artisan db:seed --class=AppConfigSeeder --force && \
php artisan db:seed --class=AppTextSeeder --force && \
php artisan db:seed --class=RecordSeeder --force && \
php artisan db:seed --class=UISettingSeeder --force && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache
```

**Start Command:**
```bash
php artisan serve --host=0.0.0.0 --port=3000
```

### 4. Port Configuration
- Set port to `3000`
- Enable public access

### 5. Deploy
Click "Deploy" button

## 🔧 Post-Deployment

### Access Admin Panel
```
https://your-domain.com/admin
```

### Test API
```bash
curl https://your-domain.com/api/health
curl https://your-domain.com/api/config
```

## 🐛 Troubleshooting

### Issue: APP_KEY not set
**Solution:** Set APP_KEY in environment variables:
```
APP_KEY=base64:62H0whOgoWMJ1ENn7+/2+fu6Xd+rfHOgJbIAmZP2TG8=
```

### Issue: Database not found
**Solution:** Ensure database path is correct:
```
DB_DATABASE=/app/database/database.sqlite
```

### Issue: Permission denied
**Solution:** Set proper permissions:
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Issue: Nginx duplicate location
**Solution:** This is a Coolify configuration issue. Check your nginx.conf or use the default Laravel configuration.

### Issue: Environment warnings
**Solution:** These are normal for optional services (Redis, AWS, etc.). You can ignore them or set them to null:
```
REDIS_HOST=null
AWS_ACCESS_KEY_ID=null
```

## 📝 Minimal .env for Production

```env
APP_NAME=Makroom
APP_ENV=production
APP_KEY=base64:62H0whOgoWMJ1ENn7+/2+fu6Xd+rfHOgJbIAmZP2TG8=
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite

SESSION_DRIVER=file
CACHE_STORE=file
LOG_CHANNEL=stack
LOG_LEVEL=error
```

## 🔒 Security Checklist

- ✅ Set `APP_DEBUG=false` in production
- ✅ Use strong `APP_KEY`
- ✅ Set proper `APP_URL`
- ✅ Enable HTTPS
- ✅ Set `LOG_LEVEL=error`
- ✅ Disable unnecessary services

## 📊 Database Persistence

### Important: SQLite Database
The SQLite database file is stored in `database/database.sqlite`. Make sure this directory is persistent across deployments.

In Coolify, add a persistent volume:
- Path: `/app/database`
- This ensures your data survives redeployments

## 🚀 One-Click Deploy Script

Create a file `deploy.sh`:

```bash
#!/bin/bash

echo "🚀 Deploying Makroom Admin Panel..."

# Install dependencies
composer install --no-dev --optimize-autoloader

# Create database if not exists
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
    php artisan migrate --force
    php artisan db:seed --class=CountrySeeder --force
    php artisan db:seed --class=AppConfigSeeder --force
    php artisan db:seed --class=AppTextSeeder --force
    php artisan db:seed --class=RecordSeeder --force
    php artisan db:seed --class=UISettingSeeder --force
fi

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment complete!"
```

Make it executable:
```bash
chmod +x deploy.sh
```

## 🎯 Success Indicators

After deployment, you should see:
- ✅ Server starting on port 3000
- ✅ No critical errors
- ✅ Admin panel accessible at `/admin`
- ✅ API responding at `/api/health`

## 📞 Support

If you encounter issues:
1. Check Coolify logs
2. Verify environment variables
3. Ensure database file exists
4. Check file permissions

## 🎉 You're Done!

Your Laravel admin panel is now live and ready to manage your Makroom mobile app!

Access it at: `https://your-domain.com/admin`
