<?php

namespace App;

class Main
{
    public function getCheapestRoom(string $json, string $checkin, string $checkout): ReservationDto
    {
        $array = json_decode($json, true);
        $prices = [];
        $sum = [];
        foreach ($array as $day => $data) {
            foreach ($data['rooms'] as $room => $price) {
                if ($checkin <= $day && $day < $checkout) {
                    $prices[$room][] = $price;
                    if (!array_key_exists($room, $sum)) {
                        $sum[$room] = 0;
                    }
                    $sum[$room] += $price;
                }
            }
        }
        if (empty($sum)) {
            return new ReservationDto(
                $checkin,
                $checkout,
                '',
                [],
                0
            );
        }
        $min_room = array_search(min($sum), $sum);

        return new ReservationDto(
            $checkin,
            $checkout,
            (string)$min_room,
            $prices[$min_room],
            count($prices[$min_room])
        );
    }
}
