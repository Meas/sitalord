@extends('layouts\app')
@section('content')
<!-- Important Owl stylesheet -->
<link rel="stylesheet" href="{{ asset('/owl/owl-carousel/owl.carousel.css') }}">
 
<!-- Default Theme -->
<link rel="stylesheet" src="{{ asset('/owl/owl-carousel/owl.theme.css') }}">

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
 
<!-- Include js plugin -->
<script type="text/javascript" src="{{ asset('owl/owl-carousel/owl.carousel.min.js') }}"></script>

<style>
img 
{
	width:100%;
	height:300px;
}

</style>


<div id="owl-demo" class="owl-carousel owl-theme">
 
  <div class="item"><img src="img/road.jpg" alt="Mountain"></div>
  <div class="item"><img src="img/sky.jpg" alt="Sea"></div>
  <div class="item"><img src="img/lighthouse.jpg" alt="Forest"></div>
 
</div>


<div class="container">
<h1> Articles </h1>
<hr>
@foreach ($articles as $article)
		<h2> <a href="{{ url('/articles/show',$article->id) }}">{{ $article->title }} </a></h2>
		<p> {{ $article->body }} </p>
@endforeach
</div>
<script>
$(document).ready(function() {
 
  $("#owl-demo").owlCarousel({
 
 						//navigation : true,Show next and prev buttons
 		autoPlay : 3000,
 		stopOnHover : true,
		slideSpeed : 300,
		paginationSpeed : 400,
		singleItem:true,
 
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });

});
</script>
@stop