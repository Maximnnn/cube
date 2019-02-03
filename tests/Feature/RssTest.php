<?php

namespace Tests\Feature;


use App\Services\Rss\Rss;
use App\Services\Rss\TVNETRssGetter;
use Tests\TestCase;

class RssTest extends TestCase
{

    private function getRssGetter() {
        return new TVNETRssGetter();
    }

    private function getRss() {
        return new Rss($this->getRssGetter());
    }

    public function testLoad() {
        $rss = $this->getRss();

        $rssTest = $rss->load();

        $this->assertEquals($rss, $rssTest);
    }

}
