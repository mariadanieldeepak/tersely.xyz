<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use App\Repositories\UrlRepository;
use Illuminate\Http\Response;

class UrlController extends Controller
{
    protected $urlRepository;

    public function __construct(UrlRepository $urlRepository) {
        $this->urlRepository = $urlRepository;
    }

    public function index(Request $request)
    {
        return view('dashboard.index', [
        	'shortUrl' => $request->root() . '/' . session('message')
        ]);
    }

    public function terse(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $shortUrl = $this->urlRepository->getShortUrl(request('url'));
        session()->flash('message', $shortUrl);

        return redirect('/');
    }

    public function verbose(Request $request, $terse)
    {
        $url = $this->urlRepository->getLongUrlByShortUrl($terse);
        if($url) {
            return redirect()->away($url);
        }
        else {
        	return new Response("Tersely couldn't find the URL you clicked");
        }
    }
}
