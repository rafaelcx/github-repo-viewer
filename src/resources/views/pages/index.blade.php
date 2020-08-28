@extends('layouts.app')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1>{{$tittle}}</h1>
            <p class="lead text-muted">{{$paragraph}}</p>
            <p>
                @guest
                    <a href="/search" class="btn btn-primary my-2">Repositories Search</a>
                    <a href="/login" class="btn btn-secondary my-2">Login</a>
                @else
                    <a href="/search" class="btn btn-primary my-2">Repositories Search</a>
                @endguest
            </p>
        </div>
    </section>
@endsection
