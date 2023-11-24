<?php

namespace App;

use App\ReservationDto;

class Formatter
{
    public function format(ReservationDto $dto): string
    {
        if ($dto->room != '') {
            $sum_text = count($dto->prices) > 1
                ? implode(' + ', $dto->prices) . ' = ' . array_sum($dto->prices)
                : $dto->prices[0];
            $nights = count($dto->prices) > 1
                ? "Nächte"
                : "Nacht";

            return "Anreise {$dto->checkin}, Abreise {$dto->checkout} (also {$dto->nights} {$nights})" .
                   " in Zimmer '{$dto->room}'. Gesamtpreis = {$sum_text}";
        } else {
            return 'Cheapest room is not available';
        }
    }
}
