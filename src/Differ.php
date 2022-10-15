<?php

namespace Differ\Differ;

use function Functional\sort;
use function Differ\Parsers\parse;
use function Differ\Analyze\analyzeFiles;
use function Differ\Format\format;

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
