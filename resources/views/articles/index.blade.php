@extends('layouts\app')
@section('content')


@if ('http://localhost:7777'.$_SERVER['REQUEST_URI'] == url('/articles'))
@include('slides.slider')


<div class="example1" style="color:#F0F3BD;background-color: #05668D;">
<h3> {{$textslides->text}} </h3>
</div>
@endif
<div class="articles_main">

@if ('http://localhost:7777'.$_SERVER['REQUEST_URI'] == url('/articles'))
<h1> Recent Articles</h1> 
<h3><a href='articles/all'> View all articles</h3></a></h3>
@else 
<h1> Articles </h1>
@endif
<hr>
@foreach ($articles as $article)
	<?php $pic=0 ?>
	@foreach($pictures as $picture)
		@foreach($article->pictures as $Apic)
			@if($picture->id == $Apic->id)
				<?php $pic=1 ?>
				<div class="imagedropshadow">
					<div class="article_header">
						<a href="{{ url('/articles/show',$article->id) }}">
						<img style="width:100%;margin:0px" src="/img/300_{{$picture->name}}" alt="Article Pic">
						<div class="article_title">{{ $article->title }} 
						</div></a>

					</div>
					<?php $aBody= strip_tags( $article->body);
					$bBody= substr($aBody, 0, 200)?>
					{{$bBody}}<a href="{{ url('/articles/show',$article->id) }}">...Read More</a>
				</div>
				<br>
			@endif
		@endforeach
	@endforeach
	@if ($pic==0)
		<div class="imagedropshadow">
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

{!! $articles->links() !!}

@stop