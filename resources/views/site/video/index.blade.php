@extends('layouts.site.master')
@section('css')
<style>
.list-category{
    list-style-type: none;
    display: inline-flex;
}
.list-category li {
    font-family: 'Work Sans', sans-serif;
    padding: 1em;
    color: #103185;
    font-weight: 600
}
.list-category li a{
    text-decoration: none
}
.list-category li:hover{

    color: #0899ff;
}
.list-category li::after {
  content: '';
  width: 0px;
  height: 3px;
  display: block;
  background: #103185;
  transition: 300ms;
}

.list-category li:hover::after {
  width: 100%;
}
.video-category{
    padding-left: 2em;
    padding-right: 2em;
    padding-top: 1em;
    padding-bottom: 1em;
}
.video-title {
    padding-left: 2em;
    padding-right: 2em;
    padding-top: .5em;
    padding-bottom: .5em;
    color: #103185;
    font-weight: bold
}
.video-description {
    padding-left: 2em;
    padding-right: 2em;
    color: #133999;
    text-align: justify
}
.button {

    padding-left: 2em;
    padding-right: 2em;
    padding-top: .5em;
    padding-bottom: .5em;
}
</style>
@endsection
@section('content')
<div class="container" style="margin-top: 10em;margin-bottom:2em" id="video">
    <div class="row"style="color: grey">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12">
            <div class="content-text-title">VÍDEOS</div>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12 text-center">
            @php
                 $categories = [ 1 => 'Usina',2 => 'Produtos',3 => 'Matérias',4 => 'Institucional', 5 => 'Ação Social'];
                 $count = count($categories);
            @endphp
            <ul class="list-category">
                <a href="{{ route('site.video.list') }}#video"><li>Todos</li></a>
                @for ($i = 1;$i <= $count;$i++)
                <a href="{{ route('site.video.list') }}?category={{ $i }}#video"><li>{{ $categories[$i] }}</li> </a>
                @endfor
            </ul>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12" style="margin-bottom: 2em;margin-top:2em">
            <div class="row">
                @foreach ($data as $item)
                    <div class="col-md-4 col-lg-4 col-xl-4 col-sm-5 col-xs-5 mb-5">
                        <div>
			@if(!empty($item->poster))                        
				{!! img('gallery/video/poster/'.$item->poster, 800, 600, true, true) !!}
			@else
	                        {!! img('fundo-video-2.jpg', 800, 600, true, true) !!}
			@endif
                        </div>
                        <div class="video-category">
                            {{ $categories[$item->category] }}
                        </div>
                        <div class="video-title">
                            {{ $item->name }}
                        </div>
                        <div class="video-description">
                            {!! $item->description !!}
                        </div>
                        <div class="button">
                            <a href="{{ route('site.video.detail',['id' => $item->id])}}" class="btn bg-blue-person text-white mt-3 rounded-0"> Ver mais <i class="fas fa-arrow-right text-white"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    
    $(document).ready(function(){
    $('#menu-nav').addClass('bg-blue-person');
    });
</script>
@endsection
