<?php

namespace Differ\Formatters\FormatPlain;

function formatPlainType(array $data): string
{
    $lines = formatToPlain($data);
    return implode(PHP_EOL, $lines);
}

function formatToPlain(array $diffTree, string $trace = ''): array
{
    $result = array_map(function ($node) use ($trace) {
        $currentTrace = "{$trace}{$node['key']}";
        switch ($node['type']) {
            case 'deleted':
                return "Property '{$currentTrace}' was removed";

            case 'added':
                $formattedValue = toString($node['value']);
                return "Property '{$currentTrace}' was added with value: {$formattedValue}";

            case 'unchanged':
                return "";

            case 'changed':
                $formattedValueOld = toString($node['oldValue']);
                $formattedValueNew = toString($node['newValue']);
                return "Property '{$currentTrace}' was updated. From {$formattedValueOld} to {$formattedValueNew}";

            case 'branch':
                $resultString = formatToPlain($node['children'], $currentTrace . '.');
                return implode(PHP_EOL, $resultString);

            default:
                throw new \Exception("Incorrect node type: {$node['type']}");
        }
    }, $diffTree);
    return array_filter($result);
}

function toString(mixed $value): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if (is_numeric($value)) {
        return $value;
    }

    if (is_null($value)) {
        return 'null';
    }

    if (is_array($value)) {
        return "[complex value]";
    }

    return "'{$value}'";
}
