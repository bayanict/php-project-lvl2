<?php

namespace Differ\Formatters;

use function Differ\Formatters\FormatStylish\formatStylishType;

function format(array $data, string $type): string
{
    switch ($type) {
        case 'stylish':
            return formatStylishType($data);
        case 'plain':
            return formatPlainType($data);
        default:
            throw new \Exception("Incorrect format type: {$type}");
    }
}
