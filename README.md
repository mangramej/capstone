## MIlk Delivery System
A project that serves as a capstone for BSIT students of Our Lady of Fatima University.

### create a env file
Add your database and pusher credentials 

```
cp .env.example .env
```

### install dependencies
```
composer install
npm install && npm run build
```

### run artisan commands
```
php artisan key:generate
php artisan migrate --seed
php artisan storate:link
```

### run the server
```
php artisan serve
```
