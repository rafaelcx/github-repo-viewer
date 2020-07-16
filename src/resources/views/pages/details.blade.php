@extends('layouts.app')

@section('content')
    <h1>{{$tittle}}</h1>
    @if(count($features) > 0)
        <ul class="list-group">
            @foreach($features as $feature)
                <li class="list-group-item">{{$feature}}</li>
            @endforeach
        </ul>
    @endif
@endsection
