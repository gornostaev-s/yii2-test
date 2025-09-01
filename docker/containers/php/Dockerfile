FROM php:8.1.1-fpm

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    git \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    libmcrypt-dev \
        && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
    	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd

# Install Supervisor.
RUN \
  apt-get update && \
  apt-get install -y supervisor && \
  rm -rf /var/lib/apt/lists/* && \
  sed -i 's/^\(\[supervisord\]\)$/\1\nnodaemon=true/' /etc/supervisor/supervisord.conf

RUN pecl install --force redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

EXPOSE 9000

# Указываем рабочую директорию для PHP
WORKDIR /var/www

CMD ["supervisord"]