<?php

namespace Test\App;

use App\ReservationDto;
use App\Formatter;
use PHPUnit\Framework\TestCase;

class FormatterTest extends TestCase
{
    public function testFormatWorksCorrectly(): void
    {
        $formatter = new Formatter();
        $formattedText = $formatter->format($this->getReservationDto());
        $expected = "Anreise 2022-08-24, Abreise 2022-08-26 (also 2 Nächte) in Zimmer 'room_1'. "
            . "Gesamtpreis = 131.87 + 119.44 = 251.31";
        $this->assertEquals($expected, $formattedText);
    }

    public function testFormatWorksCorrectlyForOneNight(): void
    {
        $formatter = new Formatter();
        $formattedText = $formatter->format($this->getReservationDto());
        $expected = "Anreise 2022-08-24, Abreise 2022-08-26 (also 2 Nächte) in Zimmer 'room_1'. "
            . "Gesamtpreis = 131.87 + 119.44 = 251.31";
        $this->assertEquals($expected, $formattedText);
    }

    public function testFormatWorksForOneResult(): void
    {
        $formatter = new Formatter();
        $formattedText = $formatter->format($this->getOneNightReservationDto());
        $expected = "Anreise 2022-08-24, Abreise 2022-08-25 (also 1 Nacht) in Zimmer 'room_1'. Gesamtpreis = 131.87";
        $this->assertEquals($expected, $formattedText);
    }

    public function testFormatWorksForNoResults(): void
    {
        $formatter = new Formatter();
        $formattedText = $formatter->format($this->getEmptyReservationDto());
        $expected = 'Cheapest room is not available';
        $this->assertEquals($expected, $formattedText);
    }

    public function getReservationDto(): ReservationDto
    {
        return new ReservationDto(
            '2022-08-24',
            '2022-08-26',
            'room_1',
            [131.87, 119.44],
            2
        );
    }

    public function getOneNightReservationDto(): ReservationDto
    {
        return new ReservationDto(
            '2022-08-24',
            '2022-08-25',
            'room_1',
            [131.87],
            1
        );
    }

    public function getEmptyReservationDto(): ReservationDto
    {
        return new ReservationDto(
            '2022-08-24',
            '2022-08-24',
            '',
            [],
            0
        );
    }
}
