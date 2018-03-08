<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use Bijective\BijectiveTranslator;

class UrlController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function terse(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $url = Url::create([
            'url' => request('url'),
        ]);

        $lastInsertedId = $url->id;

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $bijective = new BijectiveTranslator($alphabet);
        $encoded = $bijective->encode($lastInsertedId);

        $url = Url::find($lastInsertedId);
        $url->terser = $encoded;
        $url->save();

        return redirect('/');
    }

    public function verbose(Request $request, $terse)
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $bijective = new BijectiveTranslator($alphabet);
        $decoded = $bijective->decode($terse);
        $url = Url::find($decoded);
        return redirect($url->url);
    }
}
