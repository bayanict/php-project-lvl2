<?php

namespace Differ\Differ;

function genDiff($firstFile, $secondFile)
{
    $firstFileContent = file_get_contents($firstFile);
    $secondFileContent = file_get_contents($secondFile);

    $firstFileDecoded = json_decode($firstFileContent, true);
    $secondFileDecoded = json_decode($secondFileContent, true);

    return [$firstFileDecoded["proxy"], $secondFileDecoded];
}
