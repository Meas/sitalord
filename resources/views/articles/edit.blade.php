@extends ('layouts\app')
@section ('content')
<div class="container"><h1>Edit: {{ $article->title}}</h1>
	<hr/>
		<form method="POST" action="{{ url('/articles/update', $article->id)}}" >
		<!-- <input type="hidden" name="_token" value="{{ csrf_token() }}">
			<b>Title:</b><br>
			<input type="text" name="title" id='title' value='{{ $article->title }}'><br><br>
			<b>Body:</b><br>
			<textarea name="body" style="height:400px;width:1080px;" id='body'>{{ $article->body }}</textarea><br><br>
			<b>Edited on:</b><br>
			<input style="width:1080px;" type="date" name="published_at" id="published_at"><br><br>
			<input style="width:1080px;background-color: lightblue;border:none;color:white;font-size:20px;font-family:Arial Black, Gadget, serif;" type="submit" value="Update Article"> -->
			@include ('articles.form', ['submitButtonText' => 'Update Article','body' => $article->body, 'naslov' => $article->title])
		</form>
	</div>



<script> 
var d = new Date();
      month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

	document.getElementById('published_at').value = [year, month, day].join('-'); 
</script>


@stop