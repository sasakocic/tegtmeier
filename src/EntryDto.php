<?php

namespace App;

/**
 * Class EntryDto
 * @package App
 */
class EntryDto
{
    /** @var string */
    public string $code;
    /** @var string */
    public string $date;
    /** @var float */
    public float $price;

    /**
     * @param string $code
     * @param string $date
     * @param float $price
     */
    public function __construct(string $code, string $date, float $price)
    {
        $this->code = $code;
        $this->date = $date;
        $this->price = $price;
    }
}
