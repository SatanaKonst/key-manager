ARG PHP_VERSION=8.2
ARG REVISION=10
FROM php:${PHP_VERSION}-apache
RUN apt-get update && apt-get install -y locales && \
    echo "Europe/Moscow" > /etc/timezone && \
    sed -i -e "s/# ru_RU.UTF-8.*/ru_RU.UTF-8 UTF-8/" /etc/locale.gen && \
    dpkg-reconfigure --frontend=noninteractive locales && \
    update-locale LANG=ru_RU.UTF-8 && \
    rm -rf /etc/localtime && \
    ln -s /usr/share/zoneinfo/Europe/Moscow /etc/localtime
RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev \
    zlib1g-dev \
    libzip-dev \
    libmagickwand-dev \
    jpegoptim \
    optipng \
    gifsicle \
    webp \
    unzip \
    xvfb \
    ghostscript \
    wget \
    openssl \
    libssl1.0 \
    wkhtmltopdf \
    iputils-ping \
    libmemcached-dev zlib1g-dev libssl-dev \
    aspell-ru \
    && apt-get clean \
    && pecl install imagick memcached redis \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd opcache mysqli pdo_mysql zip bcmath \
    && docker-php-ext-enable imagick memcached redis \
    && a2enmod rewrite && a2enmod headers && a2enmod remoteip \
    && a2enmod deflate && a2enmod status && a2enmod expires

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash
RUN apt update && apt install nodejs

RUN useradd -m bitrix && usermod -aG www-data bitrix
RUN mkdir "/var/www/bxTmp" && chown bitrix:bitrix /var/www/bxTmp
RUN mkdir "/home/bitrix/ext_www" && chown bitrix:bitrix /home/bitrix/ext_www
RUN mkdir "/home/bitrix/www" && chown bitrix:bitrix /home/bitrix/www
RUN rm /var/log/apache2/access.log /var/log/apache2/error.log /var/log/apache2/other_vhosts_access.log
WORKDIR "/home/bitrix/ext_www"
USER bitrix
RUN echo "HELLO" > /home/bitrix/www/index.html