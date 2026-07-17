<?php

$path = sys_get_temp_dir().DIRECTORY_SEPARATOR.'CustomBadWords-'.getmypid().'.json';
$customBadWords = json_decode((string) file_get_contents($path));

if (is_array($customBadWords)) {
    $badwords = array_merge($badwords, $customBadWords);
}
