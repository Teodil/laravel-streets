FROM php:8.2-fpm

# Обновляем систему и устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql

# Настройка рабочего каталога
RUN mkdir -p /var/www/laravel

WORKDIR /var/www/laravel
# Устанавливаем владельца и права доступа
RUN chown -R www-data:www-data /var/www/laravel

USER www-data


# Указываем, что будет запущено по умолчанию
CMD ["php-fpm"]

# Открываем порт для PHP-FPM
EXPOSE 9000
