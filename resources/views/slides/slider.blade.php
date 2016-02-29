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
	height:auto;
}
@media all and (max-width: 1000px) {
    .proba {
        display:none;
        margin:-20px;
    }
}
</style>

<div class="proba">
<div id="owl-demo" class="owl-carousel owl-theme">
  @foreach ($slides as $slide)

  <div class="item"><img src="img/{{$slide->name}}" alt="Slide"></div>

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