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

## Installation and usage

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
  composer require --dev phpunit/phpunit
  ./vendor/bin/phpunit --version
  ./vendor/bin/phpunit --testdox tests
  ```
- Testing  
  ```bash
  composer run tests
  composer run coverage
  ```
- Install (optionally) tools for quality checking
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
  ```
- Usage
  ```bash
  composer run task
  php public/index.php # composer run task
  php -dxdebug.client_host=127.0.0.1 -dxdebug.client_port=9001 -dxdebug.discover_client_host=false -dxdebug.idekey="PHPSTORM" -dxdebug.mode=coverage,debug public/index.php # composer run xdebug
  php -S 0.0.0.0:8000 public/index.php # composer run webserver
  ```
- Export
  ```bash
  git archive --format=tar --output=sasa-kocic.tar HEAD
  ```
