FROM php:8.2.35-zts-trixie

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /app

COPY . /app

EXPOSE 8000

CMD ["php","-S","0.0.0.0:8000","-t","/app"]