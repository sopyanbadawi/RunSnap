FROM dunglas/frankenphp:php8.4-alpine

# Install python3 and py3-pillow inside Alpine container
RUN apk add --no-cache python3 py3-pillow

# Install ekstensi PHP yang dibutuhkan Laravel & MySQL
RUN install-php-extensions \
    pdo_mysql \
    gd \
    intl \
    zip \
    opcache

# Set working directory
WORKDIR /app

# Salin source code
COPY . .

# Berikan izin ke folder storage & bootstrap/cache (buat jika tidak ada karena diignore di .dockerignore)
RUN mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache && chmod -R 775 storage bootstrap/cache

# Jalankan server
CMD ["frankenphp", "php-server", "--root", "public/"]

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
