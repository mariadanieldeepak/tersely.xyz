@extends('layouts.master')

@section('title', 'Tersely - the URL shortener built with Laravel')

@section('body')
    <div class="row">
        <div class="col">
            @if($errors->any())
                <div class="form-group">
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form method="post" action="/terse">
                <fieldset>
                    <div class="form-group">
                        <label for="url">Enter URL to shorten</label>
                        <input type="text" class="form-control" id="url" aria-describedby="urlHelp" name="url" placeholder="URL to shorten">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </fieldset>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection