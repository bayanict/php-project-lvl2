<?php

namespace Differ\Differ;

use function Functional\sort;

function format(array $data)
{
    $lines = formatToStylish($data);
    return '{' . PHP_EOL . implode(PHP_EOL, $lines) . PHP_EOL . '}';
}

function formatToStylish(array $diffTree)
{
    $indent = '  ';

    $result = array_map(function ($node) use ($indent) {
        switch ($node['type']) {
            case 'deleted':
                $value = $node['value'];
                $formattedValue = toString($value);
                return "{$indent}- {$node['key']}: {$formattedValue}";

            case 'added':
                $value = $node['value'];
                $formattedValue = toString($value);
                return "{$indent}+ {$node['key']}: {$formattedValue}";

            case 'unchanged':
                $value = $node['value'];
                $formattedValue = toString($value);
                return "{$indent}  {$node['key']}: {$formattedValue}";

            case 'changed':
                $valueOld = $node['oldValue'];
                $formattedValueOld = toString($valueOld);
                $valueNew = $node['newValue'];
                $formattedValueNew = toString($valueNew);
                return "{$indent}- {$node['key']}: {$formattedValueOld}" . PHP_EOL .
                       "{$indent}+ {$node['key']}: {$formattedValueNew}";

            default:
                throw new \Exception("Incorrect node type: {$node['type']}");
        }
    }, $diffTree);
    return $result;
}

function toString($value)
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if (is_null($value)) {
        return 'null';
    }

    return "{$value}";
}

function genDiff(string $firstFile, string $secondFile)
{
    $fileContent1 = file_get_contents($firstFile);
    $fileContent2 = file_get_contents($secondFile);

    $fileDecoded1 = json_decode($fileContent1, true);
    $fileDecoded2 = json_decode($fileContent2, true);

    $keysData = array_unique(array_merge(array_keys($fileDecoded1), array_keys($fileDecoded2)));
    $keysDataSorted = sort($keysData, fn ($left, $right) => $left <=> $right);

    $result = array_map(function ($key) use ($fileDecoded1, $fileDecoded2) {
        if (!array_key_exists($key, $fileDecoded2)) {
            return ['key' => $key, 'type' => 'deleted', 'value' => $fileDecoded1[$key]];
        }
        if (!array_key_exists($key, $fileDecoded1)) {
            return ['key' => $key, 'type' => 'added', 'value' => $fileDecoded2[$key]];
        }

        if ($fileDecoded1[$key] === $fileDecoded2[$key]) {
            return ['key' => $key, 'type' => 'unchanged', 'value' => $fileDecoded1[$key]];
        }
        return ['key' => $key, 'type' => 'changed', 'oldValue' => $fileDecoded1[$key], 'newValue' => $fileDecoded2[$key]];
    }, $keysDataSorted);
    return format($result);
}
