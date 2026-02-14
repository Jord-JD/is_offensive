<?php

namespace JordJD\IsOffensive\Tests;

use PHPUnit\Framework\TestCase;

class IsOffensiveTest extends TestCase
{
    public function ifOffensiveProvider()
    {
        return [
            ['fuck'],
            ['fuk'],
            ['fuker'],
            ['motherfucker'],
            ['mutherfuker'],
            ['cunt'],
            ['tit'],
        ];
    }

    /**
     * @dataProvider ifOffensiveProvider
     */
    public function testIfOffensive($word)
    {
        $this->assertTrue(is_offensive($word));
    }

    public function ifNotOffensiveProvider()
    {
        return [
            ['duck'],
            ['cat'],
            ['greetings'],
            ['cheese'],
        ];
    }

    /**
     * @dataProvider ifNotOffensiveProvider
     */
    public function testIfNotOffensive($word)
    {
        $this->assertFalse(is_offensive($word));
    }

    public function whitelistedWordsProvider()
    {
        return [
            ['hello'],
            ['Hello'],
            ['HELLO'],
            ['middlesex'],
            ['tittesworth'],
            ['scunthorpe'],
        ];
    }

    /**
     * @dataProvider whitelistedWordsProvider
     */
    public function testWhitelistedWords($word)
    {
        $this->assertFalse(is_offensive($word));
    }
}
