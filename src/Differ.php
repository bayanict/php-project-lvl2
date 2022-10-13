<?php

namespace Differ\Differ;

use function Functional\sort;
use function Differ\Parsers\parse;
use function Differ\Analyze\analyzeFiles;

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
    $fileExtension1 = pathinfo($firstFile, PATHINFO_EXTENSION);

    $fileContent2 = file_get_contents($secondFile);
    $fileExtension2 = pathinfo($secondFile, PATHINFO_EXTENSION);

    $fileDecoded1 = parse($fileContent1, $fileExtension1);
    $fileDecoded2 = parse($fileContent2, $fileExtension2);

    $tree = analyzeFiles($fileDecoded1, $fileDecoded2);
    return format($tree);
}
