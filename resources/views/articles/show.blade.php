 @extends ('layouts\app')
 @section('content')

<div class="container">

@foreach ($pictures as $picture)
	@foreach($article->pictures as $Apic)
		@if ($picture->id == $Apic->id)
            <?php $has_pic=1 ?>
			<div class="article_header"> <img style="width:100%;" src="/img/{{$picture->name}}" alt="Article Pic">
        @endif
	@endforeach
@endforeach

    @if($has_pic==1)
    <div class="article_title" <h1>{{ $article->title}} </h1> </div>
            </div>
    @else
    <br>
    <div class="article_title_no_pic">
        <h1> {{ $article->title}} </h1>
    </div>
    @endif
    <div class="article_body">
         {!! $article->body !!}
    </div>
    <br>
    <div class="fb-like" data-href="http://localhost:7777/articles/show/{{$id}}" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
    <br>
    <div class="fb-comments" data-href="http://localhost:7777/articles/show/{{$id}}" data-numposts="5" data-order-by="social"></div>
</div>


@endsection
                  
@section ('put_edit_li')
@if ('http://localhost:7777'.$_SERVER['REQUEST_URI'] == url('/articles/show', $article->id) &&  $admin == 1)
    <li><a href="{{ url('/articles/edit', $article->id) }}">Edit Article</a></li>
@endif

@endsection

