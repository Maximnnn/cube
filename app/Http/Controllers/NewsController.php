<?php

namespace App\Http\Controllers;

use App\Services\Rss\Rss;
use App\Services\Rss\TVNETRssGetter;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index() {
        return view('home');
    }

    public function getNews(Request $request) {
        $rss = new Rss(new TVNETRssGetter());

        return $rss->load()->search((string) $request->post('search'))->slice(0, 5);
    }
}
