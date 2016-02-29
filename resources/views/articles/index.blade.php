@extends('layouts\app')
@section('content')


@if ('http://localhost:7777'.$_SERVER['REQUEST_URI'] == url('/articles'))
@include('slides.slider')
@endif
<div class="articles_main">
<h1> Articles </h1>
<hr>
@foreach ($articles as $article)
	<?php $pic=0 ?>
	@foreach($pictures as $picture)
		@foreach($article->pictures as $Apic)
			@if($picture->id == $Apic->id)
				<?php $pic=1 ?>
				<div style="border:1px solid black;">
					<div class="article_header">
						<a href="{{ url('/articles/show',$article->id) }}">
						<img style="width:100%;" src="/img/300_{{$picture->name}}" alt="Article Pic">
						<div class="article_title">{{ $article->title }} 
						</div></a>

					</div>
					{!! $article->body !!} 
				</div>
				<br>
			@endif
		@endforeach
	@endforeach
	@if ($pic==0)
		<div style="border:1px solid black;">
			<div>
			<a href="{{ url('/articles/show',$article->id) }}" style="text-decoration:none">
			<div class="article_title_no_pic">
				
				<h2> {{ $article->title }} </h2></div></a>

			</div>
			<p> {!! $article->body !!} </p>
		</div>
		<br>
	@endif
@endforeach
</div>

@stop