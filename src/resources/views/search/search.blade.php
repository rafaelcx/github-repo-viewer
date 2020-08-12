@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(count($repo_info_list) > 0)
                @foreach($repo_info_list as $repo_info)
                    <div class="card mb-3">
                        <div class="card-header">{{$repo_info->getName()}}</div>
                        <div class="card-body">
                            <p class="card-text">Full Repository Name: {{$repo_info->getFullName()}}</p>
                            <p class="card-text">Repo Owner Login: {{$repo_info->getOwnerLogin()}}</p>
                            <p class="card-text">Repo Language: {{$repo_info->getLanguage()}}</p>
                            <a href="{{$repo_info->getHtmlUrl()}}" class="card-link">Link to Github</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="container">
                    <h1>Oops!</h1>
                    <p class="lead text-muted">No results were found :(</p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
