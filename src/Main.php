<?php

namespace App;

use RuntimeException;

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
    public function getCheapestRoom(string $json, string $checkin, string $checkout): ReservationDto
    {
        $array = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Could not decode JSON');
        }
        $prices = [];
        $sum = [];
        foreach ($array as $day => $data) {
            if ($checkin <= $day && $day < $checkout) {
                foreach ($data['rooms'] as $room => $price) {
                    $prices[$room] = $prices[$room] ?? []; // Initialize the array if it doesn't exist
                    $prices[$room][] = $price;

                    $sum[$room] = $sum[$room] ?? 0; // Initialize the sum to 0 if it doesn't exist
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
