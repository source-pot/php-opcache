<?php

$preload_files = explode("\n", file_get_contents(__DIR__.'/preload_files.list'));

foreach($preload_files as $file) {

    // ignore empty lines
    if(strlen(trim($file)) === 0 ) continue;

    // ignore comments
    if($file[0] === '#') continue;

    // assume all files listed relative to this script
    opcache_compile_file(__DIR__.'/'.$file);
}
