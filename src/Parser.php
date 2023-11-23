<?php

namespace App;

class Parser
{
    /**
     * @param string $xml_string
     * @return EntryDto[]
     */

    public function parse(string $xml_string): array
    {
        $xml = simplexml_load_string($xml_string);
        $entries = [];
        foreach ($xml->entry as $entry) {
            $entries[] = new EntryDto(
                (string)$entry->code,
                (string)$entry->date,
                (float)$entry->price
            );
        }
        return $entries;
    }
}
