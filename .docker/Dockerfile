FROM jkaninda/nginx-php-fpm:8.2

COPY ./ /var/www/html
COPY ./.docker/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /var/www/html
ENTRYPOINT ["entrypoint.sh"]
