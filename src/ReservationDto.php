<?php

namespace App;

class ReservationDto
{
    public string $checkin;
    public string $checkout;
    public string $room;
    /** @var float[] */
    public array $prices;
    public int $nights;

    public function __construct(
        string $checkin,
        string $checkout,
        string $room,
        /** @var float[] $prices */
        array $prices,
        int $nights
    ) {
        $this->checkin = $checkin;
        $this->checkout = $checkout;
        $this->room = $room;
        $this->prices = $prices;
        $this->nights = $nights;
    }
}
