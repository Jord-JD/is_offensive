<?php

namespace JordJD\IsOffensive\Tests;

use JordJD\IsOffensive\OffensiveChecker;
use PHPUnit\Framework\TestCase;

class CustomListsTest extends TestCase
{
    public function testCustomBlacklist()
    {
        $blacklist = ['cheese'];

        $offensiveChecker = new OffensiveChecker($blacklist);

        $this->assertTrue($offensiveChecker->isOffensive('cheese'));
    }

    public function testCustomWhitelist()
    {
        $whitelist = ['fucky'];

        $offensiveChecker = new OffensiveChecker([], $whitelist);

        $this->assertFalse($offensiveChecker->isOffensive('fucky'));
    }

    public function testCustomBlackListAndWhiteList()
    {
        $blacklist = ['chick'];
        $whitelist = ['chicken'];

        $offensiveChecker = new OffensiveChecker($blacklist, $whitelist);

        $this->assertTrue($offensiveChecker->isOffensive('chick'));
        $this->assertTrue($offensiveChecker->isOffensive('chicks'));
        $this->assertFalse($offensiveChecker->isOffensive('chicken'));
        $this->assertFalse($offensiveChecker->isOffensive('chickens'));
    }
}
