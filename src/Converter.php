<?php

namespace App;

class Converter
{
    private Parser $parser;
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function convert(string $xml_string): array
    {
        $hotel_prices = $this->parser->parse($xml_string);
        $days = [];
        foreach ($hotel_prices as $entryDto) {
            if (!array_key_exists($entryDto->date, $days)) {
                $days[$entryDto->date]['rooms'] = [];
            }
            $days[$entryDto->date]['rooms'][$entryDto->code] = $entryDto->price;
        }

        return $days;
    }
}
