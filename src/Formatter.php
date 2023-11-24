<?php

namespace App;

use App\ReservationDto;

/**
 * Class Formatter
 * @package App
 */
class Formatter
{
    /**
     * @param \App\ReservationDto $dto
     * @return string
     */
    public function format(ReservationDto $dto): string
    {
        if ($dto->room === '') {
            return 'Cheapest room is not available';
        }
        $sum_text = count($dto->prices) > 1
            ? implode(' + ', $dto->prices) . ' = ' . array_sum($dto->prices)
            : $dto->prices[0];
        $nights = count($dto->prices) > 1
            ? "Nächte"
            : "Nacht";

        return "Anreise {$dto->checkin}, Abreise {$dto->checkout} (also {$dto->nights} {$nights})" .
               " in Zimmer '{$dto->room}'. Gesamtpreis = {$sum_text}";
    }
}
