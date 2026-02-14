<?php

namespace JordJD\IsOffensive\Tests;

use PHPUnit\Framework\TestCase;

class FalsePositiveTextsTest extends TestCase
{
    public function forFalsePositivesInTextsProvider()
    {
        $files = glob(__DIR__.'/texts/*.txt');
        $dataProvider = [];

        foreach ($files as $file) {
            $dataProvider[] = [$file];
        }

        return $dataProvider;
    }

    /**
     * @dataProvider forFalsePositivesInTextsProvider
     */
    public function testForFalsePositivesInTexts($file)
    {
        $content = file_get_contents($file);

        $this->assertFalse(is_offensive($content));
    }
}
