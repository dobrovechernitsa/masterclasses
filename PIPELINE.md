# Описание пайплайна
Запускается автоматически при push и pull request в ветки main, dev, qa.

# 1. Tests
Запуск тестов Laravel с проверкой покрытия кода.
- Команда: `php artisan test --coverage --min=50`
- Пайплайн падает, если покрытие < 50% или есть упавшие тесты

# 2. Static Analysis
Проверка кода через PHPStan (Larastan).
- Команда: `vendor/bin/phpstan analyse`
- Пайплайн падает при любой ошибке

# 3. Linting
Проверка форматирования кода через Laravel Pint (PSR-12).
- Команда: `vendor/bin/pint --test`
- Пайплайн падает при любом нарушении правил

# 4. Deploy
Симуляция деплоя — копирует соответствующий .env файл.
- dev → .env.dev
- qa → .env.uat
- main → .env.prod
- Для main требуется ручное подтверждение (manual approval)

# 5. Notify
Вывод статуса пайплайна после завершения.

# Среды

Ветка main - файл .env.prod - Production
Ветка dev - файл .env.dev - Development
Ветка qa - файл .env.uat - User Acceptance Testing

# Конфигурационные файлы
- `.env.ci` — для тестов в пайплайне (SQLite in-memory)
- `.env.dev` — разработка
- `.env.uat` — тестирование
- `.env.prod` — продакшн