FROM php:8.2-fpm

WORKDIR /var/www

RUN rm -rf /var/www/html

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    apt-utils \
    libonig-dev \
    libavif-bin \
    ghostscript \
    libxml2-dev # Required for php-xml

# Install PHP extensions
RUN docker-php-ext-install zip pdo_mysql mbstring exif xml
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

RUN apt-get update; \
    apt-get install -y libmagickwand-dev; \
    pecl install imagick; \
    docker-php-ext-enable imagick;

# Install and enable Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN XDEBUG_MODE=coverage

# Install Redis PHP extension
RUN mkdir -p /usr/src/php/ext/redis; \
    curl -fsSL https://pecl.php.net/get/redis --ipv4 | tar xvz -C "/usr/src/php/ext/redis" --strip 1; \
    docker-php-ext-install redis;

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create and configure a non-root user
RUN groupadd -g 1000 laravel
RUN useradd -u 1000 -ms /bin/bash -g laravel user

# Set correct permissions and copy project files
COPY --chown=user:laravel . /var/www

USER user

# Expose the port and start PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
