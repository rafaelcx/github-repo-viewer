@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="container pb-md-5">
                <h4 class="align-content-start">The worst way to find your favorite language Github repositories!</h4>
                <form action="/search" method="POST" role="search">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" name="query" placeholder="Search repositories by language">
                        <span class="input-group-btn pl-md-1">
                            <button type="submit" class="btn btn-primary ">
                                <span>Search</span>
                            </button>
                        </span>
                    </div>
                </form>
            </div>

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
                    <p class="lead text-muted">Oops! Unfortunately no results were found :(</p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
