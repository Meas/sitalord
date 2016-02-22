@extends('layouts\app')
@section('content')
<div class="container-fluid">
<h1> Articles </h1>
<hr>
@foreach ($articles as $article)
		<h2> <a href="{{ url('/articles/show',$article->id) }}">{{ $article->title }} </a></h2>
		<p> {{ $article->body }} </p>
@endforeach
</div>

@stop