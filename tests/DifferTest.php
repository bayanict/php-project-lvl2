<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testDiffer()
    {
        $resultJsonDiff = genDiff(__DIR__ . "/fixtures/file1.json", __DIR__ . "/fixtures/file2.json");
        $this->assertStringEqualsFile(__DIR__ . "/fixtures/correctStylish", $resultJsonDiff);

        $resultYmlDiff = genDiff(__DIR__ . "/fixtures/file1.yml", __DIR__ . "/fixtures/file2.yml");
        $this->assertStringEqualsFile(__DIR__ . "/fixtures/correctStylish", $resultYmlDiff);
    }
}