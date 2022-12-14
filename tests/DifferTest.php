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

        $resultYmlDiff = genDiff(__DIR__ . "/fixtures/file1.yaml", __DIR__ . "/fixtures/file2.yaml");
        $this->assertStringEqualsFile(__DIR__ . "/fixtures/correctStylish", $resultYmlDiff);

        $resultJsonPlain = gendiff(__DIR__ . "/fixtures/file1.json", __DIR__ . "/fixtures/file2.json", "plain");
        $this->assertStringEqualsFile(__DIR__ . "/fixtures/correctPlain", $resultJsonPlain);

        $resultYmlPlain = gendiff(__DIR__ . "/fixtures/file1.yaml", __DIR__ . "/fixtures/file2.yaml", "plain");
        $this->assertStringEqualsFile(__DIR__ . "/fixtures/correctPlain", $resultYmlPlain);

        $resultJsonJson = gendiff(__DIR__ . "/fixtures/file1.json", __DIR__ . "/fixtures/file2.json", "json");
        $this->assertStringEqualsFile(__DIR__ . "/fixtures/correctJson", $resultJsonJson);

        $resultYmlJson = gendiff(__DIR__ . "/fixtures/file1.yaml", __DIR__ . "/fixtures/file2.yaml", "json");
        $this->assertStringEqualsFile(__DIR__ . "/fixtures/correctJson", $resultYmlJson);
    }
}
