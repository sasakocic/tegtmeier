# Aufgabe: Hotelpreise Laden und Berechnen #

## Rohdaten ##
Gegeben ist eine XML-Datei mit Hotelpreisdaten. 
Diese enthält eine Liste von Preisdatensätzen die pro Datensatz 3 Informationen enthält, anhand denen der Tagespreis für ein bestimmtes Zimmer an einem Datum abgelesen werden kann.
* `code` \<string\>: zB 'room_1' Eindeutiger Bezeichner eines Zimmers für den der Preis gilt.
* `date`\<string\>: zB '2022-08-24' Datum an dem der Preis gültig ist.
* `price` \<float\>: zB '131.87' Tagespreis.

Siehe `hotel_prices.xml`.

## 1. Lesen und umwandeln der Daten ##

Die XML-Datei soll eingelesen werden und in einer neuen Struktur ausgegeben werden. Dabei sollen die Daten nach Datum aggregiert werden wie hier zu sehen:

    {
        "days": {
            "2022-08-24": {
                "rooms": {
                    "room_1": 131.87,
                    "room_2": 85.12
                }
            },
            "2022-08-25": {
                "rooms": {
                    "room_1": 119.44,
                    "room_2": 175.11
                }
            },
            "2022-08-26": {
                "rooms": {
                    "room_1": 88.79,
                    "room_2": 128.1
                }
            },
        },
    }

## 2. Berechnen des günstigsten Zimmers für einen bestimmten Zeitraum ##

Es soll eine Funktion, bzw. Klasse mit Methode bereitgestellt werden mit der man die günstigste Zimmerkategorie für einen bestimmten Zeitraum bestimmen kann.

Signatur Beispiel:
`function getCheapestRoom($json, $checkin, $checkout)`
* `json`: In Aufgabe 1. geladenen und umgewandelten Daten
* `checkin`: Datum Anreise
* `checkout`: Datum Abreise

Als Ergebnis soll der Zimmercode sowie dessen Gesamtpreis ausgegeben werden.

Hierbei wird pro Nacht abgerechnet, wobei der Preis des Tages vor der Nacht für die Übernachtung gilt.
Beispiel: Anreise 24.8.2022, Abreise 26.8.2022 (also 2 Nächte) in Zimmer 'room_1'. Gesamtpreis = 131.87 + 119.44 = 251.31

## Lösung

Die Idee ist einfach. Wir packen das JSON aus, iterieren durch die Zimmerpreise, begrenzen es auf das gegebene Zeitfenster und summieren die Preise pro Zimmer. Am Ende finden wir den kleinsten Preis und geben den ReservationDto zurück.

Code ist getestet mit 100% Code Coverage.
Einige Code Quality Tools waren reingeführt.

## Installation

### MacOS

- Prepare php version 7.4
  ```bash
  brew install php-version
  source $(brew --prefix php-version)/php-version.sh
  brew tap shivammathur/php
  brew install shivammathur/php/php@7.4
  php-version 7.4
  ```
- Install composer
  ```bash
  brew install composer
  ```
  
### Linux

Assuming PHP 7.4 is installed. If not, this should work on Ubuntu

```bash
sudo apt-get update
sudo apt -y install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt -y install php7.4
php -v
```

```bash
apt-get update && apt-get install -y libxml2-dev zlib1g-dev libpq-dev unzip wget
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer 
```

## Setup

- Install composer
  ```bash
  composer require --dev phpunit/phpunit
  ./vendor/bin/phpunit --version
  ./vendor/bin/phpunit --testdox tests
  ```

## Testing  

```bash
composer run tests
composer run coverage
```

## Install (optionally) tools for quality checking

### MacOS

```bash
brew install psalm
brew install phpstan
brew install php-code-sniffer
brew install php-cs-fixer
brew install phpmd
phpstan analyse src --level 7
phpcbf --extensions=php --standard=PSR12 -v ./src
wget -O /usr/local/bin/local-php-security-checker https://github.com/fabpot/local-php-security-checker/releases/download/v2.0.6/local-php-security-checker_2.0.6_darwin_arm64
chmod +x /usr/local/bin/local-php-security-checker
xattr -cr /usr/local/bin/local-php-security-checker
local-php-security-checker --path=./composer.lock
wget https://github.com/pdepend/pdepend/releases/download/2.15.1/pdepend.phar
mv pdepend.phar /usr/local/bin/pdepend
chmod +x /usr/local/bin/pdepend
wget https://github.com/phpmetrics/PhpMetrics/releases/download/v2.8.1/phpmetrics.phar
mv phpmetrics.phar /usr/local/bin/phpmetrics
chmod +x /usr/local/bin/phpmetrics
```

### Linux

```bash
wget --quiet -O /usr/local/bin/psalm https://github.com/vimeo/psalm/releases/latest/download/psalm.phar \
 && chmod +x /usr/local/bin/psalm
wget --quiet -O /usr/local/bin/phpstan https://github.com/phpstan/phpstan/releases/download/1.10.44/phpstan.phar \
 && chmod +x /usr/local/bin/phpstan
wget --quiet -O /usr/local/bin/phpcs https://github.com/squizlabs/PHP_CodeSniffer/releases/download/3.7.2/phpcs.phar \
 && chmod +x /usr/local/bin/phpcs
wget --quiet -O /usr/local/bin/phpcbf https://github.com/squizlabs/PHP_CodeSniffer/releases/download/3.7.2/phpcbf.phar \
 && chmod +x /usr/local/bin/phpcbf
wget --quiet -O /usr/local/bin/phpmd https://github.com/phpmd/phpmd/releases/download/2.14.1/phpmd.phar \
 && chmod +x /usr/local/bin/phpmd
wget --quiet -O /usr/local/bin/pdepend https://github.com/pdepend/pdepend/releases/download/2.15.1/pdepend.phar \
 && chmod +x /usr/local/bin/pdepend
wget --quiet -O /usr/local/bin/phpmetrics https://github.com/phpmetrics/PhpMetrics/releases/download/v2.8.1/phpmetrics.phar \
 && chmod +x /usr/local/bin/phpmetrics
 wget -O /usr/local/bin/local-php-security-checker https://github.com/fabpot/local-php-security-checker/releases/download/v2.0.6/local-php-security-checker_2.0.6_linux_amd64
chmod +x /usr/local/bin/local-php-security-checker
 ```

## Usage

```bash
composer run task
php public/index.php # composer run task
php -dxdebug.client_host=127.0.0.1 -dxdebug.client_port=9001 -dxdebug.discover_client_host=false -dxdebug.idekey="PHPSTORM" -dxdebug.mode=coverage,debug public/index.php # composer run xdebug
php -S 0.0.0.0:8000 public/index.php # composer run webserver
docker build -t registry.itspektar.com/tegtmeier .
docker push registry.itspektar.com/tegtmeier
docker run --rm -it registry.itspektar.com/tegtmeier
```

## Export

```bash
git archive --format=tar --output=sasa-kocic.tar HEAD
```
