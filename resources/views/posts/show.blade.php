@extends('layouts.app')
@section('content')
<a href="/posts" class="btn btn-primary btn-sm mb-2">Go back</a>
<div class="card">
    <div class="card-body">
    <div class="row">
    <div class="col-4">
    <img src="/storage/cover_image/{{$post->image}}" style='height:200px' class="w-100" alt="">
    </div>
    <div class="col-8">
    <h5>{{$post->title}}</h5>
    <p>{{$post->body}}</p>
    <hr>
    <small>{{$post->created_at}}</small>
    <br>
    @if(!Auth::guest())
    @if(auth()->user()->id == $post->user_id)
    <a href="/posts/{{$post->id}}/edit/" class="btn btn-default btn-sm mt-2">Edit </a>
    {{ html()->form('DELETE', '/posts/'.$post->id)->open() }}
    {{ html()->submit('Delete')->class('btn btn-danger btn-sm mt-2') }}
    {{ html()->hidden('_method', 'DELETE') }}
    {{ html()->form()->close() }}
    </div>
    </div>
    </div>
    @endif
    @endif
</div>

@endsection