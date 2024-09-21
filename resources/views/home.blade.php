@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="p-2">
                        @if (count($posts) > 0)
                            @foreach ($posts as $post)
                                <div> <a href='/posts/{{ $post->id }}'> {{ $post->title }}</a>
                                    <a class="mr-5 d-block btn btn-primary btn-sm" href='/posts/{{ $post->id }}/edit'>
                                    Edit Blog
                                    </a>
                                </div>
                            @endforeach
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                            @else
                                {{ __('You have no post') }}
                        @endif
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
