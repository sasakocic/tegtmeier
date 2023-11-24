<?php

namespace App;

/**
 * Class Main
 * @package App
 */
class Main
{
    /**
     * @param string $json
     * @param string $checkin
     * @param string $checkout
     * @return ReservationDto
     */
    public function getCheapestRoom(string $json, string $checkin, string $checkout)
    : ReservationDto
    {
        $array = json_decode($json, true);
        $prices = [];
        $sum = [];
        foreach ($array as $day => $data) {
            if ($checkin <= $day && $day < $checkout) {
                foreach ($data['rooms'] as $room => $price) {
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
