FROM php:8.2-fpm

# Обновляем систему и устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql

RUN apt-get install -y nodejs npm

# Настройка рабочего каталога
RUN mkdir -p /var/www/laravel
RUN mkdir -p /var/www/.npm

WORKDIR /var/www/laravel
# Устанавливаем владельца и права доступа
RUN chown -R www-data:www-data /var/www/laravel
RUN chown -R www-data:www-data /var/www/.npm

COPY phpentrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

USER www-data


# Указываем, что будет запущено по умолчанию
CMD bash -c "cd /var/www/laravel && npm install && php-fpm"

# Открываем порт для PHP-FPM
EXPOSE 9000