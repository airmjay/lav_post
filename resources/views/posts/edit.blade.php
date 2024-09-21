@extends('layouts.app')
@section('content')
{{ html()->form('PUT', '/posts/'.$post->id)->acceptsFiles()->open() }}
{{ html()->label('Title')->for('title')->class('h5 mb-2') }}
{{ html()->text('title')->value($post->title)->placeholder('Please enter your title')->class('form-control')->id('title') }}
{{ html()->label('Body')->for('body')->class('h5 mt-2') }}
{{ html()->textarea('body')->value($post->title)->placeholder('Please enter your body')->class('form-control')->id('body') }}
{{ html()->hidden('_method', 'PUT') }}
{{ html()->file('cover_image')->class('d-block mt-2 mb-2') }}
{{ html()->submit('Submit')->class('btn btn-primary btn-sm mt-2') }}
{{ html()->form()->close() }}
@endsection