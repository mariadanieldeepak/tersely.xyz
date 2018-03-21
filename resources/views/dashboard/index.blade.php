@extends('layouts.app')

@section('title', 'Tersely - the URL shortener built with Laravel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('message'))
                    <div class="form-group">
                        <div class="alert alert-success" role="alert">
                            <a href="{{ $shortUrl }}">{{ $shortUrl }}</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
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

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            <form class="w-100" method="POST" action="/terse">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="url" aria-describedby="urlHelp" name="url" placeholder="URL to shorten">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    {{ csrf_field() }}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection