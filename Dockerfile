FROM php:7.4-fpm

COPY composer.json composer.lock ./

RUN apt-get update && apt-get install -y libxml2-dev zlib1g-dev libpq-dev

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');" \
 && php composer.phar install --no-dev

RUN apt-get install wget
RUN wget -O /usr/local/bin/psalm https://github.com/vimeo/psalm/releases/latest/download/psalm.phar \
 && chmod +x /usr/local/bin/psalm
RUN wget -O /usr/local/bin/phpstan https://github.com/phpstan/phpstan/releases/download/1.10.44/phpstan.phar \
 && chmod +x /usr/local/bin/phpstan
RUN wget -O /usr/local/bin/phpcs https://github.com/squizlabs/PHP_CodeSniffer/releases/download/3.7.2/phpcs.phar \
 && chmod +x /usr/local/bin/phpcs
RUN wget -O /usr/local/bin/phpcbf https://github.com/squizlabs/PHP_CodeSniffer/releases/download/3.7.2/phpcbf.phar \
 && chmod +x /usr/local/bin/phpcbf
RUN wget -O /usr/local/bin/phpmd https://github.com/phpmd/phpmd/releases/download/2.14.1/phpmd.phar \
 && chmod +x /usr/local/bin/phpmd
RUN wget -O /usr/local/bin/pdepend https://github.com/pdepend/pdepend/releases/download/2.15.1/pdepend.phar \
 && chmod +x /usr/local/bin/pdepend
RUN wget -O /usr/local/bin/phpmetrics https://github.com/phpmetrics/PhpMetrics/releases/download/v2.8.1/phpmetrics.phar \
 && chmod +x /usr/local/bin/phpmetrics
RUN mv composer.phar /usr/local/bin/composer

COPY . .

EXPOSE 80

CMD ["bash", "-c", "composer run analysis && composer run check && composer run mess-detector && composer run php-depend && composer run tests && composer run metrics && composer run task"]

