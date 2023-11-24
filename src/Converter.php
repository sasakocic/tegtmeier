<?php

namespace App;

/**
 * Class Converter
 * @package App
 */
class Converter
{
    /** @var Parser */
    private Parser $parser;

    /**
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param string $xml_string
     * @return array<string, array<string, array<string, float>>>
     */
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
