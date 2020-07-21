@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(count($repo_info_list) > 0)
                @foreach($repo_info_list as $repo_info)
                    <div class="card mb-3">
                        <div class="card-header">{{$repo_info->name}}</div>
                        <div class="card-body">
                            <p class="card-text">Full Repository Name: {{$repo_info->full_name}}</p>
                            <p class="card-text">Repo Owner Login: {{$repo_info->owner_login}}</p>
                            <p class="card-text">Repo Language: {{$repo_info->language}}</p>
                            <a href="{{$repo_info->html_url}}" class="card-link">Link to Github</a>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
@endsection
