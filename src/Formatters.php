<?php

namespace Differ\Formatters;

use function Differ\Formatters\FormatStylish\formatStylishType;
use function Differ\Formatters\FormatPlain\formatPlainType;

function format(array $data, string $type): string
{
    switch ($type) {
        case 'stylish':
            return formatStylishType($data);
        case 'plain':
            return formatPlainType($data);
        case 'json':
            return json_encode($data);
        default:
            throw new \Exception("Incorrect format type: {$type}");
    }
}
