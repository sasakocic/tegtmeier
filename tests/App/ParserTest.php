<?php

namespace Test\App;

use App\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * @dataProvider provideXmlString
     */
    public function testParse(string $xml_string): void
    {
        $parser = new Parser();
        $entries = $parser->parse($xml_string);
        $this->assertCount(20, $entries);
        $entry = $entries[0];
        $this->assertEquals('room_1', $entry->code);
        $this->assertEquals('2022-08-24', $entry->date);
        $this->assertEquals(131.87, $entry->price);
    }

    public function testParseThrowsExceptionForInvalidXML(): void
    {
        $parser = new Parser();
        $this->expectException('InvalidArgumentException');
        $parser->parse('This is not a valid XML tag');
    }

    /**
     * @return array<int, array<int, string>>.
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
