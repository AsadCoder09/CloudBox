# Deployment Guide (Oracle Cloud VPS)

## Server Provisioning

1. Create an Oracle Cloud VPS (Ubuntu 22.04).
2. Open ports 80 and 443.
3. Create a non-root user and enable sudo.

## System Packages

```bash
sudo apt update
sudo apt install -y nginx mysql-server php8.2 php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip unzip
```

## Application Setup

```bash
sudo mkdir -p /var/www/cloudbox
sudo chown -R $USER:$USER /var/www/cloudbox
```

Deploy from `main` only:

```bash
git clone -b main <repo-url> /var/www/cloudbox
cd /var/www/cloudbox
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate
php artisan migrate --force
```

## Nginx Config

Create `/etc/nginx/sites-available/cloudbox`:

```
server {
    listen 80;
    server_name example.com;

    root /var/www/cloudbox/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    }
}
```

Enable and test:

```bash
sudo ln -s /etc/nginx/sites-available/cloudbox /etc/nginx/sites-enabled/cloudbox
sudo nginx -t
sudo systemctl reload nginx
```

## SSL (Let's Encrypt)

```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d example.com
```

## Environment Variables

Configure in `.env`:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `SIGNED_URL_SECRET`
- `ENCRYPTION_KEY`
- Object storage credentials if used

## HTTPS Enforcement

Use middleware to redirect HTTP to HTTPS in production.
