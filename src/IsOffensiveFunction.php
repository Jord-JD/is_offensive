<?php

use JordJD\IsOffensive\OffensiveChecker;

if (!function_exists('is_offensive')) {
    function is_offensive($text)
    {
        return (new OffensiveChecker())->isOffensive($text);
    }
}
