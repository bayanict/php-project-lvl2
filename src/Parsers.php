<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse($content, $type)
{
    switch ($type) {
        case 'json':
            return json_decode($content, true);
        case 'yml':
        case 'yaml':
            return Yaml::parse($content);
    }
}