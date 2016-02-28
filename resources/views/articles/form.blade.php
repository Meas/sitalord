		
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
	
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<b>Title:</b><br>
			<input type="text" class="form-control" name="title" id='title' value='{{$naslov}}'><br>

			<div style="height:0px;overflow:hidden">
  				<input type="file" id="fileInput" name="fileInput" />
			</div>
			<button type="button" class="btn btn-default" onclick="chooseFile();">Choose a picture</button>&nbsp;&nbsp;&nbsp;<span class="filename">Nothing selected</span><br><br>
			
			<b>Body:</b><br>
			<textarea class="form-control" name="body" style="height:200px;" id='body'>{{$body}}</textarea><br>

			<b>Published on:</b>
			<input class="form-control" type="date" name="published_at" id="published_at"><br>
		
			
			<input class="btn btn-primary form-control" type="submit" value="{{$submitButtonText}}">
		

		
<script>
   function chooseFile() {
      $("#fileInput").click();
   }
   CKEDITOR.replace( 'body' );
   
   $(function() {
     $("input:file").change(function (){
       var fileName = $(this).val();
       $(".filename").html(fileName);
     });
  });
</script>
