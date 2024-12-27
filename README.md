# Поиск улиц, городов регионов
### Запуск проекта (php, nginx, postgres)

```bash
   docker-compose up nginx -d
```
Composer
```bash
    docker-compose run --rm composer install
```
Запуск мигрцаии
```bash
    docker-compose run --rm artisan migrate
```
Запуск Seeder
```bash
    docker-compose run --rm artisan db:seed --class=RegionsSeeder
```
```bash
    docker-compose run --rm artisan db:seed --class=CitiesSeeder
```
```bash
    docker-compose run --rm artisan db:seed --class=StreetsSeeder
```
Node.js
```bash
    docker-compose run --rm node npm i
    docker-compose run --rm node npm run build
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



