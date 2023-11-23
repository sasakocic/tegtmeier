<?php

namespace Test\App;

use App\Parser;
use App\Converter;
use App\EntryDto;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    /**
     * @dataProvider provideXmlString
     */
    public function testConvert(string $xmlString): void
    {
        $parser = new Parser();
        $converter = new Converter($parser);
        $result = $converter->convert($xmlString);
        $this->assertCount(10, $result);
        $entries = $result['2022-08-24']['rooms'];
        $this->assertEquals(131.87, $entries['room_1']);
        $this->assertEquals(85.12, $entries['room_2']);
    }

    /**
     * @return array
     */
    public function provideXmlString(): array
    {
        return [
            [
                '<?xml version="1.0" encoding="UTF-8"?>
                    <message>
                        <entry>
                            <code>room_1</code>
                            <date>2022-08-24</date>
                            <price>131.87</price>
                        </entry>
                        <entry>
                            <code>room_1</code>
                            <date>2022-08-25</date>
                            <price>119.44</price>
                        </entry>
                        <entry>
                            <code>room_1</code>
                            <date>2022-08-26</date>
                            <price>88.79</price>
                        </entry>
                        <entry>
                            <code>room_1</code>
                            <date>2022-08-27</date>
                            <price>53.15</price>
                        </entry>
                        <entry>
                            <code>room_1</code>
                            <date>2022-08-28</date>
                            <price>82.11</price>
                        </entry>
                        <entry>
                            <code>room_1</code>
                            <date>2022-08-29</date>
                            <price>175.21</price>
                        </entry>
                        <entry>
                            <code>room_1</code>
                            <date>2022-08-30</date>
                            <price>178.95</price>
                        </entry>
                        <entry>
                            <code>room_1</code>
                            <date>2022-08-31</date>
                            <price>187.63</price>
                        </entry>
                        <entry>
                            <code>room_1</code>
                            <date>2022-09-01</date>
                            <price>114.87</price>
                        </entry>
                        <entry>
                            <code>room_1</code>
                            <date>2022-09-02</date>
                            <price>127.60</price>
                        </entry>
                        <entry>
                            <code>room_2</code>
                            <date>2022-08-24</date>
                            <price>85.12</price>
                        </entry>
                        <entry>
                            <code>room_2</code>
                            <date>2022-08-25</date>
                            <price>175.11</price>
                        </entry>
                        <entry>
                            <code>room_2</code>
                            <date>2022-08-26</date>
                            <price>128.10</price>
                        </entry>
                        <entry>
                            <code>room_2</code>
                            <date>2022-08-27</date>
                            <price>65.34</price>
                        </entry>
                        <entry>
                            <code>room_2</code>
                            <date>2022-08-28</date>
                            <price>166.83</price>
                        </entry>
                        <entry>
                            <code>room_2</code>
                            <date>2022-08-29</date>
                            <price>51.6</price>
                        </entry>
                        <entry>
                            <code>room_2</code>
                            <date>2022-08-30</date>
                            <price>107.61</price>
                        </entry>
                        <entry>
                            <code>room_2</code>
                            <date>2022-08-31</date>
                            <price>145.20</price>
                        </entry>
                        <entry>
                            <code>room_2</code>
                            <date>2022-09-01</date>
                            <price>54.71</price>
                        </entry>
                        <entry>
                            <code>room_2</code>
                            <date>2022-09-02</date>
                            <price>98.80</price>
                        </entry>
                    </message>
                    ',
            ],
        ];
    }
}
