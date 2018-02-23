FROM php:57
RUN apt-get update -y \
  && apt-get install -y sudo \
  && apt-get install -y libpq-dev libpng-dev openssl zip unzip git vim \
  && docker-php-ext-install pdo pdo_pgsql \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
  
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app
RUN composer update
CMD php artisan key:generate
CMD php artisan migrate --seed
CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000