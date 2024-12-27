# Поиск улиц, городов регионов
### Запуск проекта (php, nginx, postgres)

```bash
   docker-compose up nginx -d
```
Composer
```bash
    docker-compose run composer install
```
Запуск мигрцаии
```bash
    docker-compose run artisan migrate
```
Пример запуска Seeder
```bash
    docker-compose run artisan db:seed --class=StreetsSeeder
```
Node.js
```bash
    docker-compose run node npm i
    docker-compose run node npm run build
```

### Примечание
Была проблема с permission denied при попытке laravel открыть кэш страницы.
В рамках докера вроде бы поправил эту ошибку, но если вдруг она возникнет 
воспользуетесь командами ниже
```bash
   docker exec -u root -it laravel-docker-php-1 bash
   chown -R www-data:www-data /var/www/laravel
   exit
```



