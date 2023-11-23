<?php

namespace Test\App;

use App\Main;
use PHPUnit\Framework\TestCase;

class MainTest extends TestCase
{
    public function testGetCheapestRoom(): void
    {
        $main = new Main();
        $json = $this->provideJsonString();
        $checkin = '2022-08-24';
        $checkout = '2022-08-26';
        $reservation = $main->getCheapestRoom($json, $checkin, $checkout);
        $this->assertEquals('room_1', $reservation->room);
        $this->assertEquals(2, $reservation->nights);
        $this->assertEquals([131.87, 119.44], $reservation->prices);
    }

    public function provideJsonString(): string
    {
        return json_encode([
            '2022-08-24' =>
                [
                    'rooms' =>
                        [
                            'room_1' => 131.87,
                            'room_2' => 85.12,
                        ],
                ],
            '2022-08-25' =>
                [
                    'rooms' =>
                        [
                            'room_1' => 119.44,
                            'room_2' => 175.11,
                        ],
                ],
            '2022-08-26' =>
                [
                    'rooms' =>
                        [
                            'room_1' => 88.79,
                            'room_2' => 128.1,
                        ],
                ],
            '2022-08-27' =>
                [
                    'rooms' =>
                        [
                            'room_1' => 53.15,
                            'room_2' => 65.34,
                        ],
                ],
            '2022-08-28' =>
                [
                    'rooms' =>
                        [
                            'room_1' => 82.11,
                            'room_2' => 166.83,
                        ],
                ],
            '2022-08-29' =>
                [
                    'rooms' =>
                        [
                            175.21 => 'room_1',
                            51.6 => 'room_2',
                        ],
                ],
            '2022-08-30' =>
                [
                    'rooms' =>
                        [
                            'room_1' => 178.95,
                            'room_2' => 107.61,
                        ],
                ],
            '2022-08-31' =>
                [
                    'rooms' =>
                        [
                            'room_1' => 187.63,
                            'room_2' => 145.2,
                        ],
                ],
            '2022-09-01' =>
                [
                    'rooms' =>
                        [
                            'room_1' => 114.87,
                            'room_2' => 54.71,
                        ],
                ],
            '2022-09-02' =>
                [
                    'rooms' =>
                        [
                            'room_1' => 127.6,
                            'room_2' => 98.8,
                        ],
                ],
        ]);
    }
}
