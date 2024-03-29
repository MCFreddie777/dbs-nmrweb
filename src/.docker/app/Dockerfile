FROM php:7-fpm

ARG uid=1000
ARG user=user

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
    git \
    curl \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sudo

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install docker pdo extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql &&  \
    docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Get Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Copy entrypoint & set permissions
COPY /.docker/app/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Set work directory
WORKDIR /var/www/html

USER $user

ENTRYPOINT ["/entrypoint.sh"]

CMD ["php-fpm"]
