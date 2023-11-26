# Aufgabe: Hotelpreise Laden und Berechnen #

[![Tester](https://github.com/sasakocic/tegtmeier/actions/workflows/test.yml/badge.svg)](https://github.com/sasakocic/tegtmeier/actions/workflows/test.yml)
[![ubuntu](https://img.shields.io/badge/Ubuntu-18.04_LTS_(bionic_beaver)-brightgreen.svg)](http://releases.ubuntu.com/18.04/)
[![PHP-Version](https://img.shields.io/badge/php-7.4-blue.svg)](https://packages.ubuntu.com/eoan/libapache2-mod-php7.4)

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

Prepare php version 7.4
  ```bash
  brew install php-version
  source $(brew --prefix php-version)/php-version.sh
  brew tap shivammathur/php
  brew install shivammathur/php/php@7.4
  php-version 7.4
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
```

## Testing  

```bash
./scripts/composer run tests
./scripts/composer run coverage
```

## Install (optionally) tools for quality checking

### MacOS

```bash
wget -O /usr/local/bin/local-php-security-checker https://github.com/fabpot/local-php-security-checker/releases/download/v2.0.6/local-php-security-checker_2.0.6_darwin_arm64
chmod +x /usr/local/bin/local-php-security-checker
xattr -cr /usr/local/bin/local-php-security-checker

```

### Linux

```bash
wget -O /usr/local/bin/local-php-security-checker https://github.com/fabpot/local-php-security-checker/releases/download/v2.0.6/local-php-security-checker_2.0.6_linux_amd64
chmod +x /usr/local/bin/local-php-security-checker
 ```

## Usage

```bash
./scripts/composer run task
php public/index.php # composer run task
php -dxdebug.client_host=127.0.0.1 -dxdebug.client_port=9001 -dxdebug.discover_client_host=false -dxdebug.idekey="PHPSTORM" -dxdebug.mode=coverage,debug public/index.php # composer run xdebug
php -S 0.0.0.0:8000 public/index.php # composer run webserver
docker build -t registry.itspektar.com/tegtmeier .
docker push registry.itspektar.com/tegtmeier
docker run --rm -it registry.itspektar.com/tegtmeier
# or build it multiplatform if we want to run on MacOS and Linux for example
docker buildx build --load --platform linux/amd64 -t registry.itspektar.com/tegtmeier .
docker buildx build --load --platform linux/arm64 -t registry.itspektar.com/tegtmeier .
docker push registry.itspektar.com/tegtmeier
```

## Export

```bash
git archive --format=tar --output=sasa-kocic.tar HEAD
```
