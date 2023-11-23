<?php

namespace Test\App;

use App\EntryDto;
use PHPUnit\Framework\TestCase;

class EntryDtoTest extends TestCase
{
    public function testCanCreateEntryDtoWithValidData(): void
    {
        $code = 'ABC123';
        $date = '2023-10-04';
        $price = 123.45;

        $entryDto = new EntryDto($code, $date, $price);

        $this->assertEquals($code, $entryDto->code);
        $this->assertEquals($date, $entryDto->date);
        $this->assertEquals($price, $entryDto->price);
    }


    /** @psalm-suppress InvalidReturnType */
    public function testCannotCreateEntryDtoWithInvalidPrice(): void
    {
        $this->expectException(\TypeError::class);

        $code = 'ABC123';
        $date = '2023-10-04';
        $price = 'INVALID';

        new EntryDto($code, $date, $price);
    }
}
