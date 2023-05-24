
FROM php:8.2 as base
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
COPY --from=composer/composer /usr/bin/composer /usr/bin/composer
RUN install-php-extensions zip
ENV PATH ${PATH}:/app/vendor/bin/

FROM base as dev
RUN apt-get update && apt-get install -y watch
RUN install-php-extensions xdebug
