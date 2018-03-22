<?php

namespace App\Repositories;

use App\Url;
use Illuminate\Support\Facades\DB;

class UrlRepository
{
    private $alphabet;

    protected $shortUrl;

    protected $urlLength;

    protected $bijectiveTranslator;

    protected function getARandomNumber()
    {
        return mt_rand(0, strlen($this->alphabet) - 1);
    }

    protected function generateShortUrl()
    {
        $shortUrl = '';
        while($this->maxUrlLength-- > 0) {
            $shortUrl .= $this->alphabet[$this->getARandomNumber()];
        }
        $this->shortUrl = $shortUrl;
        return $this->shortUrl;
    }

    public function __construct()
    {
        $this->maxUrlLength = 6;
        $this->alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    }

    protected function isUrlExists($longUrl)
    {
        $url = Url::select('url','terser')->where('url', '=', $longUrl)->first();
        if ($url !== null && $url->count() > 0) {
            $this->shortUrl = $url->terser;
            return true;
        }
        return false;
    }

    protected function isShortUrlDoesntExist()
    {
        return Url::where('terser', '=', $this->shortUrl)->doesntExist();
    }

    public function getShortUrl($longUrl)
    {
        if ($this->isUrlExists($longUrl)) {
            return $this->shortUrl;
        }
        for(; $this->generateShortUrl();) {
            if($this->isShortUrlDoesntExist()) {
                $url = new Url;
                $url->url = $longUrl;
                $url->terser = $this->shortUrl;
                $url->save();
                break;
            }
        }
        return $this->shortUrl;
    }

    public function getLongUrlByShortUrl($shortUrl)
    {

        $url = Url::select('url','terser')->where(DB::raw('BINARY terser'), '=', $shortUrl)->first();
        if ($url !== null && $url->count() > 0) {
            return $url->url;
        }
        return false;
    }

}