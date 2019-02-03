<?php

namespace Tests\Unit;

use App\Services\Rss\Rss;
use App\Services\Rss\TestRssGetter;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class RssTest extends TestCase
{

    private function getRssGetter() {
        return new TestRssGetter();
    }

    private function getRss() {
        return new Rss($this->getRssGetter());
    }

    public function testLoad() {
        $rss = $this->getRss();
        $rss2 = $rss->load();

        $this->assertEquals($rss, $rss2);
    }

    public function testGetXml() {
        $rss = $this->getRss()->load();

        $xml = $rss->getXml();

        $this->assertInstanceOf(\SimpleXMLElement::class, $xml);
    }

    public function testGetCollection() {
        $rss = $this->getRss()->load();

        $collection = $rss->getCollection();

        $this->assertInstanceOf(Collection::class, $collection);
    }

    public function testSearch() {
        $rss = $this->getRss()->load();

        $collection = $rss->search('some search');

        $this->assertInstanceOf(Collection::class, $collection);
    }

}
