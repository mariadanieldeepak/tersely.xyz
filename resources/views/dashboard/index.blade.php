@extends('layouts.master')

@section('title', 'Tersely - the URL shortener built with Laravel')

@section('body')
    <div class="row">
        <div class="col">
            @if(session('message'))
                <div class="form-group">
                    <div class="alert alert-success" role="alert">
                        <a href="{{ $shortUrl }}">{{ $shortUrl }}</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if($errors->any())
                <div class="form-group">
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row no-gutters">
        <form class="w-100" method="POST" action="/terse">
        <div class="form-group col-8">
            <input type="text" class="form-control" id="url" aria-describedby="urlHelp" name="url" placeholder="URL to shorten">
        </div>
        <div class="form-group col-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            {{ csrf_field() }}
        </div>
        </form>
    </div>
@endsection