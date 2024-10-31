ARG PHP_VERSION=8.3
FROM php:${PHP_VERSION}-apache
RUN apt-get update && apt-get install -y locales && \
    echo "Europe/Moscow" > /etc/timezone && \
    sed -i -e "s/# ru_RU.UTF-8.*/ru_RU.UTF-8 UTF-8/" /etc/locale.gen && \
    dpkg-reconfigure --frontend=noninteractive locales && \
    update-locale LANG=ru_RU.UTF-8 && \
    rm -rf /etc/localtime && \
    ln -s /usr/share/zoneinfo/Europe/Moscow /etc/localtime
RUN apt-get install -y \
    unzip \
    wget \
    openssl \
    libpython3-stdlib libpython3.11-minimal libpython3.11-stdlib nodejs python3 \
    && apt-get clean \
    && pecl install redis \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable redis \
    && a2enmod rewrite && a2enmod headers && a2enmod remoteip \
    && a2enmod deflate && a2enmod status && a2enmod expires

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash
RUN apt update && apt install -y nodejs