@extends('layouts\app')
@section('content')


@if ('http://localhost:7777'.$_SERVER['REQUEST_URI'] == url('/articles'))
@include('slides.slider')
@endif
<div class="container">
<h1> Articles </h1>
<hr>
@foreach ($articles as $article)
		<h2> <a href="{{ url('/articles/show',$article->id) }}">{{ $article->title }} </a></h2>
		<p> {{ $article->body }} </p>
@endforeach
</div>

@stop