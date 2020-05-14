@extends('layouts.site.master')
@section('content')
<div class="container" style="margin-top: 10em;margin-bottom:2em">
    <div class="row d-flex justify-content-center" style="color: grey">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12" >
            <div class="content-text-title">Notícias</div>
        </div>
        <hr style="color: grey" width="100%">
        @php
            $i = 0;
        @endphp
        @foreach ($data as $item)
        @php
        $arr = explode("-", $item->date);
        @endphp
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12 p-2 text-dark @if($i !== 0) mt-1 @endif"  style="background-color: #e9e9e9">
                <div class="row">
                    <div class="col-md-2 col-lg-2 col-xl-2 col-sm-2 col-xs-2">
                        @if(!empty($item->image))
                        <img  class="d-block w-100 img-thumbnail border-0" src="{{ url('/storage/news') }}/{{ $arr[0] }}/{{ $arr[1] }}/{{ $arr[2] }}/{{ $item->id }}/{{ $item->image }}">
                        @endif
                    </div>
                    <div class="col-md-8 col-lg-8 col-xl-8 col-sm-8 col-xs-8">
                        {{ $item->title }}<br/>
                        {{ $item->subtitle }}
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 col-sm-2 col-xs-2">
                        <a href="{{ route('site.news.detail',['id'=> $item->id,'slug'=>$item->slug])}}#noticia" class="btn bg-blue-person text-white mt-3" style="border-radius:0px"> Ver notícia <i class="fas fa-arrow-right text-white"></i></a>
                    </div>
                </div>
            </div>
        @php
        $i++;
        @endphp
        @endforeach
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12 p-3">
            {{ $data->links() }}
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
