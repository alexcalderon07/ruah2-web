FROM dunglas/frankenphp:php8.4-bookworm

RUN install-php-extensions \
    pdo_mysql \
    mysqli \
    pdo_sqlite \
    sqlite3

COPY . /app

CMD ["frankenphp", "run", "--config", "/app/Caddyfile"]
