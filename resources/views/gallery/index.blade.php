@extends('layouts\app')
@section('content')
<script src="http://cdn.alloyui.com/3.0.1/aui/aui-min.js"></script>
<link href="http://cdn.alloyui.com/3.0.1/aui-css/css/bootstrap.min.css" rel="stylesheet"></link>

@unless(Auth::guest() || Auth::user()->admin==0)
<form method="POST" action="{{ url('gallery/upload')}}" enctype='multipart/form-data'>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div style="height:0px;overflow:hidden">
   <input type="file" id="fileInput" name="fileInput" />
</div>
<div style="width:180px;float:left position: relative;">
<button type="button" onclick="chooseFile();">Upload An Image</button><br><br>
<input  type="submit" value="Submit Image">
</div>
</form>
@endunless

<div id="myGallery" class="gallery_display">
@foreach ($pictures as $picture)
<div class="gallery_img">
<a href="/img/{{$picture->name}}">
<img style="width:100%" src="/img/300_{{$picture->name}}" alt="Article Pic"></a>
</div>
@endforeach
</div>
<script>
   function chooseFile() {
      $("#fileInput").click();
   }
  	YUI().use(
 	'aui-image-viewer',
  	function(Y) {
    	new Y.ImageViewer(
	    {
	        caption: 'Image Gallery',
	        //captionFromTitle uses the DOM title attibute as image caption
	        captionFromTitle: true,
	        centered: true,
	        
	        links: '#myGallery a',
	        playing: false,
	        preloadAllImages: false,
	        preloadNeighborImages: false,
	        showInfo: true,
	        showPlayer: true,
	        zIndex: 1
	      }
	    ).render();
 	}
);
</script>

 @stop