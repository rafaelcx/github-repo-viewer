@extends('layouts.app')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1>{{$tittle}}</h1>
            <p class="lead text-muted">{{$paragraph}}</p>
            <p>
                <a href="#" class="btn btn-primary my-2">Repositories Search</a>
                <a href="#" class="btn btn-secondary my-2">Login</a>
            </p>
        </div>
    </section>
@endsection