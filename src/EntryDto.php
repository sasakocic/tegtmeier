<?php

namespace App;

class EntryDto
{
    public string $code;
    public string $date;
    public float $price;

    public function __construct(string $code, string $date, float $price)
    {
        $this->code = $code;
        $this->date = $date;
        $this->price = $price;
    }
}
