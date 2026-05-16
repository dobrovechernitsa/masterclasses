# Описание пайплайна
Запускается автоматически при push и pull request в ветки main, dev, qa.

# 1. Tests
Запуск тестов:
- Команда: `php artisan test --coverage --min=50`

# 2. Static Analysis
Проверка кода через PHPStan:
- Команда: `vendor/bin/phpstan analyse`

# 3. Linting
Проверка форматирования через Laravel Pint:
- Команда: `vendor/bin/pint --test`

# 4. Deploy
Копирует соответствующий .env файл
- dev → .env.dev
- qa → .env.uat
- main → .env.prod

# 5. Notify
Вывод статуса пайплайна

# Среды

- Ветка main - файл .env.prod - Production
- Ветка dev - файл .env.dev - Development
- Ветка qa - файл .env.uat - User Acceptance Testing

# Конфигурационные файлы
- `.env.ci` — для тестов в пайплайне (SQLite in-memory)
- `.env.dev` — разработка
- `.env.uat` — тестирование
- `.env.prod` — продакшн
