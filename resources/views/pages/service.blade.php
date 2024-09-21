@extends('layouts.app')
@section('content')
<h3>Services</h3>
@if (count($array) > 0)
<ul>
@foreach ($array as $arr ) 
   <li>{{$arr}}</li>
@endforeach
</ul>
@endif
@endsection
