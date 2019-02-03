<?php

namespace App\Services\Rss;


class TestRssGetter implements RssGetterInterface
{
    public function get(): string
    {
        return file_get_contents(base_path('tests' . DIRECTORY_SEPARATOR . 'rss.txt'));
    }

}
