# Installation

```bash
# Установить зависимости
composer install

# Запустить контейнеры
sail up -d

# Настроить githooks
git config core.hooksPath .githooks
chmod -R +x .githooks

# Инициализировать приложение
sail artisan app:install
```

# Deployments
