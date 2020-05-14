@extends('layouts.site.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
<div class="container" id="noticia" style="margin-top: 12em">
    <div class="row" style="color: grey">
        <div class="col-md-12 col-xs-12 col-xl-12 col-lg-12 col-sm-12" >
                <div class="content-text-title">
                    {{ $data->title }}
                </div>
                <h5>{{ $data->subtitle }}</h5>
        </div>
        <hr style="color: grey" width="100%">
        <div class="col-md-12 col-xs-12 col-xl-12 col-lg-12 col-sm-12">
            Conecte-se   <i style="vertical-align: super" class="ml-3 mr-3">_____________</i>
            <a style="color: grey" href="https://facebook.com/sharer/sharer.php?u={{ url('/noticia/'.$data->id."/".$data->slug)}}&t={{$data->title}}"  target="_blank"><i class="fab fa-facebook-f mr-2"></i></a>
            <a style="color: grey" href="https://twitter.com/intent/tweet?text={{ $data->title }}&url={{ url('/noticia/'.$data->id."/".$data->slug)}}" target="_blank" ><i class="fab fa-twitter mr-2"></i></a>
            <a style="color: grey" href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('/noticia/'.$data->id."/".$data->slug)}}&title={{ $data->title }}" target="_blank"><i class="fab fa-linkedin-in  mr-2"></i></a>
            <a style="color: grey" href="https://api.whatsapp.com/send?text={{ url('/noticia/'.$data->id."/".$data->slug)}}"  target="_blank"><i class="fab fa-whatsapp"></i></a>
             <i class="fab fa-instagram sr-only"></i>
            <i class="fab fa-google-plus-g sr-only"></i>
        </div>
        <hr style="color: grey" width="100%">
        @php
        $arr = explode("-", $data->date);
        @endphp
        <div class="col-md-12 col-xs-12 col-xl-12 col-lg-12 col-sm-12">
            @if(!empty($data->image))
            <a href="{{ url('/storage/news') }}/{{$arr[0]}}/{{$arr[1]}}/{{$arr[2]}}/{{ $data->id }}/{{ $data->image }}" data-fancybox data-caption="{{ $data->name }}">
                {!! img('news/'.$arr[0].'/'.$arr[1].'/'.$arr[2].'/'.$data->id.'/'.$data->image, 1280, 580, true, true,array("alt" => $data->name)) !!}
            </a>
            @endif
            </a>
        </div>
        <div class="col-md-12 col-xs-12 col-xl-12 col-lg-12 col-sm-12 mt-4 mb-5">
            <div class="content-text text-justify">
                {!! $data->content !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
<script>
    
    $(document).ready(function(){
    $('#menu-nav').addClass('bg-blue-person');
    });
</script>
@endsection
