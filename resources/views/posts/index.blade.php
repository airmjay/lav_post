@extends('layouts.app')
@section('content')
@if(count($post)> 0)
<div class="p-2">
@foreach ($post as $blog)
<ul class="list-group mb-2">
    <li class="list-group-item"> 
    <h5><a href="/posts/{{$blog->id}}">{{$blog->title}}</a></h5>
    <hr>
    <small>{{$blog->created_at}}</small>
    </li>
</ul>
@endforeach
</div>    
@endif
@endsection