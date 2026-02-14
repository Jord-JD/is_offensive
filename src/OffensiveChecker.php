<?php

namespace JordJD\IsOffensive;

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
            file_put_contents('/tmp/CustomBadWords.json', json_encode($blacklist));
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
