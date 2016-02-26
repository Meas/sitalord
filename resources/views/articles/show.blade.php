 @extends ('layouts\app')
 @section('content')
<div class="container">

@foreach ($pictures as $picture)
	@foreach($article->pictures as $Apic)
		@if ($picture->id == $Apic->id)
			<div class="article_header"> <img style="width:100%;" src="/img/{{$picture->name}}" alt="Article Pic">
		@endif
	@endforeach
@endforeach


    <div class="article_title" <h1>{{ $article->title}} </h1> </div>
    </div>

    <div class="article_body">
         {!! $article->body !!}
    </div>
    <br>
</div>
@endsection
                  
@section ('put_edit_li')
@if ('http://localhost:7777'.$_SERVER['REQUEST_URI'] == url('/articles/show', $article->id) &&  $admin == 1)
    <li><a href="{{ url('/articles/edit', $article->id) }}">Edit Article</a></li>
@endif
@endsection

