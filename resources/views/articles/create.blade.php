@extends ('layouts\app')
@section ('content')
	<div class="container" style="margin-top: -10px; margin-bottom: -10px">
	<h1> Write an article</h1>
	</div>
	<div class="container-fluid">
	<hr/>
	</div>
	<div class="container">
		<form method="POST" action="{{ url('/articles/store') }}">
			@include ('articles.form', ['submitButtonText' => 'Add Article', 'body' => '', 'naslov' => '', 'article' => 'false'])
		</form>
	<br>


@include('errors.list')
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