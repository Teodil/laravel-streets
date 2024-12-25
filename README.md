# Поиск улиц, городов регионов
### Запуск проекта (php, nginx, postgres)

```bash
   docker-compose nginx -d
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



