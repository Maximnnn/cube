<?php
namespace App\Services\Rss;

class TVNETRssGetter implements RssGetterInterface
{
    private $url = 'http://www.tvnet.lv/rss/';

    public function get() :string {
        $rss = file_get_contents($this->url);
        return (string)$rss;
    }

}
