<?php

namespace App;

use InvalidArgumentException;

/**
 * Class Parser
 * @package App
 */
class Parser
{
    /**
     * @param string $xml_string
     * @return EntryDto[]
     */
    public function parse(string $xml_string): array
    {
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_ERR_NONE);
        if ($xml === false) {
            $error = 'Could not parse XML string: ' . $xml_string;
            throw new InvalidArgumentException($error);
        }
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
