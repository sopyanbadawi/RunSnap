FROM dunglas/frankenphp:php8.4

# Install python3, pip, and required system packages for OpenCV/InsightFace
RUN apt-get update && apt-get install -y --no-install-recommends \
    python3 \
    python3-pip \
    python3-venv \
    libgl1 \
    libglib2.0-0 \
    && rm -rf /var/lib/apt/lists/*

# Install python packages in system (using break system packages as required by debian pip)
RUN pip3 install --break-system-packages opencv-python-headless insightface onnxruntime numpy pillow

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

# Buat custom PHP configuration langsung saat build
RUN printf "upload_max_filesize = 100M\npost_max_size = 2G\nmax_file_uploads = 300\nmemory_limit = 2G\nmax_execution_time = 600\nmax_input_time = 600\n" > /usr/local/etc/php/conf.d/uploads.ini

# Berikan izin ke folder storage & bootstrap/cache (buat jika tidak ada karena diignore di .dockerignore)
RUN mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache && chmod -R 775 storage bootstrap/cache

# Jalankan server
CMD ["frankenphp", "php-server", "--root", "public/"]

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
