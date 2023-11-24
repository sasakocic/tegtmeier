<?php

namespace App;

/**
 * Class ReservationDto
 * @package App
 */
class ReservationDto
{
    /** @var string */
    public string $checkin;
    /** @var string */
    public string $checkout;
    /** @var string */
    public string $room;
    /** @var float[] */
    public array $prices;
    /** @var int */
    public int $nights;

    /**
     * @param string $checkin
     * @param string $checkout
     * @param string $room
     * @param float[] $prices
     * @param int $nights
     */
    public function __construct(
        string $checkin,
        string $checkout,
        string $room,
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
