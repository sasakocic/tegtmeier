<?php

require_once __DIR__ . '/../vendor/autoload.php';

//namespace App;
use App\Converter;
use App\Main;
use App\Formatter;
use App\Parser;

$converter = new Converter(new Parser());
$main = new Main();
$formatter = new Formatter();

$xmlString = file_get_contents('hotel_prices.xml');
if ($xmlString === false) {
    throw new RuntimeException('Could not parse XML file');
}
$converted = $converter->convert($xmlString);
$json = json_encode($converted);
if ($json === false) {
    throw new RuntimeException('Could not encode XML file');
}
echo $json;

$reservationDto = $main->getCheapestRoom($json, '2022-08-24', '2022-08-26');
echo $formatter->format($reservationDto);
