FROM php:8.2-fpm

RUN apt-get update \
  && apt-get install -y git zip unzip libpq-dev \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN apt-get update && apt-get install -y wget \
  && wget https://get.symfony.com/cli/installer -O - | bash \
  && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

WORKDIR /app
COPY ./ /app