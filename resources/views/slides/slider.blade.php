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
	margin-left:10%;
  width:80%;
	height:auto;
}
@media all and (max-width: 1000px) {
    .proba {
        display:none;
    }
}
</style>

<div class="proba">
<div id="owl-demo" class="owl-carousel owl-theme" style="background-color: rgb(240,240,240);">
@foreach ($slides as $slide)

  <div class="item">
    <a href="{{ url('/articles/show',$slide->articles()->first()->id) }}">
    <img src="img/{{$slide->name}}" alt="Slide">
    <div class="article_title" style="margin-left:10%;width:80%;"> 
        {{ $slide->articles()->first()->title}} 
    </div>
    </a>
  </div>

  @endforeach
</div>
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