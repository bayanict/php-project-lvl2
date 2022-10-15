<?php

namespace Differ\Formatters\FormatJson;

function formatJsonType(array $data): string
{
    return json_encode($data);
}
