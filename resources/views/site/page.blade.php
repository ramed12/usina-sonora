@extends('layouts.site.master-page')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
<div class="container" id="inicio" style="margin-top: 9em">
    <div class="row" style="color: grey">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-sm-12" >
            <div class="content-text-title">
            {{ $data->name }}
            </div>
        </div>
        <hr style="color: grey" width="100%">

        <div class=" col-lg-12 col-xl-12 col-sm-12 col-sm-12">
            @if(!empty($data->image))
            <a href="{{ url('storage/gallery/page/') }}/{{ $data->image }}" data-fancybox data-caption="{{ $data->name }}"> 
                {!! img('gallery/page/'.$data->image, 1280, 580, true, true,array("alt" => $data->name)) !!}
	    </a>
            @endif
        </div>
        <div class="col-md-12 col-xs-12 col-lg-12 col-xl-12 col-sm-12 mt-4 mb-5">
            <div class="content-text text-justify">
                {!! $data->content !!}
            </div>
        </div>
        
        @if($data->id == 12)  
        @if(count($image) > 0)
            <div class="col-md-12 col-xs-12 col-lg-12 col-xl-12 col-sm-12 mt-4">
                <div class="content-text text-justify">
                    Últimas Edições
                    <hr>
                </div>
            </div>
        <div class="col-md-12 col-xs-12 col-lg-12 col-xl-12 col-sm-12 mb-5">
            <div class="content-text text-center"> 
            @foreach ($image as $item) 
              <p><a href="{{ url('storage/gallery/journal') }}/{{ $item->path }}" target="_blank" class="btn btn-success rounded-0"><i class="fas fa-download"></i> {!! $item->name !!} </a></p>
            @endforeach
            </div>
        </div>
        @endif
        @endif

        @if(!empty($data->file) && $data->id != 12)

        <div class="col-md-12 col-xs-12 col-lg-12 col-xl-12 col-sm-12 mt-4 mb-5">
            <div class="content-text text-center">
                <a href="{{ url('storage/document') }}/{{ $data->file }}" target="_blank" class="btn btn-success rounded-0"><i class="fas fa-download"></i>  @if($data->id == 2) Política de Sustentabilidade @else Arquivo para download @endif </a>
            </div>
        </div>
        @endif
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
