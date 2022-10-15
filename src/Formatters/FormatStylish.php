<?php

namespace Differ\Formatters\FormatStylish;

const TAB = '    ';

function formatStylishType(array $data)
{
    $lines = formatToStylish($data);
    return '{' . PHP_EOL . implode(PHP_EOL, $lines) . PHP_EOL . '}';
}

function formatToStylish(array $diffTree, int $depth = 0): array
{
    $tab = getTab($depth);
    $newDepth = $depth + 1;

    $result = array_map(function ($node) use ($tab, $newDepth) {
        switch ($node['type']) {
            case 'deleted':
                $value = $node['value'];
                $formattedValue = toString($value, $newDepth);
                return "{$tab}  - {$node['key']}: {$formattedValue}";

            case 'added':
                $value = $node['value'];
                $formattedValue = toString($value, $newDepth);
                return "{$tab}  + {$node['key']}: {$formattedValue}";

            case 'unchanged':
                $value = $node['value'];
                $formattedValue = toString($value, $newDepth);
                return "{$tab}    {$node['key']}: {$formattedValue}";

            case 'changed':
                $valueOld = $node['oldValue'];
                $formattedValueOld = toString($valueOld, $newDepth);
                $valueNew = $node['newValue'];
                $formattedValueNew = toString($valueNew, $newDepth);
                return "{$tab}  - {$node['key']}: {$formattedValueOld}" . PHP_EOL .
                       "{$tab}  + {$node['key']}: {$formattedValueNew}";

            case 'branch':
                $resultString = implode(PHP_EOL, formatToStylish($node['children'], $newDepth));
                return "{$tab}    {$node['key']}: {" . PHP_EOL . "{$resultString}" . PHP_EOL . "{$tab}    }";

            default:
                throw new \Exception("Incorrect node type: {$node['type']}");
        }
    }, $diffTree);
    return $result;
}

function toString($value, $depth)
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if (is_null($value)) {
        return 'null';
    }

    if (is_array($value)) {
        $result = convertToString($value, $depth);
        $tab = getTab($depth);
        return "{{$result}" . PHP_EOL . "{$tab}}";
    }

    return "{$value}";
}

function convertToString(array $array, $depth)
{
    $newDepth = $depth + 1;
    $keys = array_keys($array);
    $result = array_map(function ($key) use ($array, $newDepth) {
        $value = toString($array[$key], $newDepth);
        $tab = getTab($newDepth);
        return PHP_EOL . "{$tab}{$key}: {$value}";
    }, $keys);
    return implode('', $result);
}

function getTab(int $number)
{
    return str_repeat(TAB, $number);
}
