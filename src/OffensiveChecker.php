<?php

namespace JordJD\IsOffensive;

use RuntimeException;
use Snipe\BanBuilder\CensorWords;

class OffensiveChecker
{
    private $censor;

    public function __construct(array $blacklist = [], array $whitelist = [])
    {
        $this->censor = new CensorWords();

        $this->setupBadWords($blacklist);
        $this->setupWhiteList($whitelist);
    }

    private function setupBadWords(array $blacklist)
    {
        if ($blacklist) {
            $path = sys_get_temp_dir().DIRECTORY_SEPARATOR.'CustomBadWords-'.getmypid().'.json';
            if (file_put_contents($path, json_encode(array_values($blacklist)), LOCK_EX) === false) {
                throw new RuntimeException('Unable to write the custom bad-words dictionary.');
            }
            $this->censor->setDictionary([__DIR__.'/CustomBadWordsLoader.php']);
        } else {
            $this->censor->setDictionary([__DIR__.'/BadWordsLoader.php']);
        }
    }

    private function setupWhiteList(array $whitelist)
    {
        if ($whitelist) {
            $words = $whitelist;
        } else {
            $words = json_decode(file_get_contents(__DIR__.'/../resources/WhiteList.json'));
        }

        foreach ($words as $word) {
            $words[] = strtoupper($word);
            $words[] = ucwords($word);
        }

        $this->censor->addWhiteList($words);
    }

    public function isOffensive($text)
    {
        $results = $this->censor->censorString($text);

        return count($results['matched']) > 0;
    }
}
