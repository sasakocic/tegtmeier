<?php

namespace App;

use App\ReservationDto;

class Formatter
{
    public function format(ReservationDto $dto): string
    {
        if ($dto->room != '') {

            $sum_text = implode(' + ', $dto->prices) . ' = ' . array_sum($dto->prices);

            return "Anreise {$dto->checkin}, Abreise {$dto->checkout} (also {$dto->nights} Nächte) in Zimmer '{$dto->room}'. Gesamtpreis = {$sum_text}";
        } else {
            return 'Cheapest room is not available';
        }
    }
}
