FROM nginx:1.17-alpine

COPY docker/nginx/conf.d /etc/nginx/conf.d/
COPY public /var/www/symfony/public
COPY docker/nginx/ssl /etc/ssl
