<?php

namespace Differ\Analyze;

use function Functional\sort;

function analyzeFiles(array $data1, array $data2): array
{
    $keysData = array_unique(array_merge(array_keys($data1), array_keys($data2)));
    $keysDataSorted = sort($keysData, fn ($left, $right) => $left <=> $right);

    $result = array_map(function ($key) use ($data1, $data2) {
        if (!array_key_exists($key, $data2)) {
            return [
                'key' => $key,
                'type' => 'deleted',
                'value' => $data1[$key]
            ];
        }

        if (!array_key_exists($key, $data1)) {
            return [
                'key' => $key,
                'type' => 'added',
                'value' => $data2[$key]
            ];
        }

        if ($data1[$key] === $data2[$key]) {
            return [
                'key' => $key,
                'type' => 'unchanged',
                'value' => $data1[$key]
            ];
        }

        if (is_array($data1[$key]) && is_array($data2[$key])) {
            return [
                'key' => $key,
                'type' => 'branch',
                'children' => analyzeFiles($data1[$key], $data2[$key])
            ];
        }

        return [
            'key' => $key,
            'type' => 'changed',
            'oldValue' => $data1[$key],
            'newValue' => $data2[$key]
        ];
    }, $keysDataSorted);

    return $result;
}
