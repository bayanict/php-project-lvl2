<?php

namespace Differ\Formatters;

use function Differ\Formatters\FormatStylish\formatStylishType;
use function Differ\Formatters\FormatPlain\formatPlainType;
use function Differ\Formatters\FormatJson\formatJsonType;

function format(array $data, string $type): string
{
    switch ($type) {
        case 'stylish':
            return formatStylishType($data);
        case 'plain':
            return formatPlainType($data);
        case 'json':
            return formatJsonType($data);
        default:
            throw new \Exception("Incorrect format type: {$type}");
    }
}
