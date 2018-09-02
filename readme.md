## Test
### Задание для Фаст Финанс от Держаева Дмитрия

Скачать/клонировать/распаковать архив.

Создать .env
```sh
cp .env.example .env
```

Установить библиотеки/пакеты:
```sh
composer install
```

Сгерерировать ключ
```sh
php artisan key:generate
```

Настроить подключение к БД в файле .env (mysql)

```sh
DB_DATABASE=имя_базы
DB_USERNAME=логин
DB_PASSWORD=пароль
```

Запустить миграцию и сиды:

```sh
php artisan migrate --seed
```

Запуск приложения:
```sh
php artisan serve
```

Локально приложение будет доступно по адресу(если не занят порт):
```sh
http://127.0.0.1:8000
```

Чтобы установить состояние по-умолчанию для кошельков, продуктов и дисплея, нужно так же выполнить:
```sh
php artisan migrate --seed
```

## Структура

Структура задействованных в задании каталогов и файлов(вкратце)

Каталог | Файл | Комментарий
:--- | :---: | :---:
routes | web.php | Маршруты/роуты.
Http/Controllers | IndexController.php | Контроллер главной страницы
Models | Display.php | Модель для дисплея
Models | Money.php | Модель для кошельков vm и user
Models | Owners.php | Модель для владельцев
Models | Products.php | Модель для товара
Helpers | ModelTrait.php | Хелпер для моделей
database/migrations | * | Миграции
database/seeds | * | Сидеры
public/css | * | стили
public/js | * | скрипты
resources/views | * | blade шаблоны

