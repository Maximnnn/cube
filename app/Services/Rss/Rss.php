<?php

namespace App\Services\Rss;

use Illuminate\Database\Eloquent\Collection;

class Rss
{
    protected $getter;

    protected $rss = null;

    /**@var $xml \SimpleXMLElement*/
    protected $xml = null;

    protected $collection = null;


    public function __construct(RssGetterInterface $getter)
    {
        $this->getter = $getter;
    }

    public function load() {

        $this->rss = $this->getter->get();

        return $this;
    }

    public function getXml() :\SimpleXMLElement {
        if ($this->xml) {
            return $this->xml;
        } else if ($this->rss) {
            $this->xml = new \SimpleXMLElement($this->rss);
            return $this->xml;
        }

        throw new \Exception('Load before');
    }

    public function getCollection() :Collection {

        $array = [];
        foreach ($this->getXml()->channel->item ?? [] as $new) {
            $array[] = (array)$new;
        }
        return new Collection($array);
    }

    public function search(string $search) :Collection {

        if (strlen($search) > 2) {
            $search = str_replace('/', '\/', $search);

            return $this->getCollection()->filter(function($row) use ($search) {
                if (preg_match('/' . $search . '/i', $row['title']))
                    return true;
                return false;
            });
        }

        return $this->getCollection();
    }
}
