@extends('layouts.site.master')
@section('content')
<div class="container" style="margin-top: 11em;margin-bottom:2em">
    <div class="row" style="color: grey">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-2 col-lg-2 col-xl-2 col-sm-2 col-xs-2">
                    <button type="button" onclick=" window.history.back();" class="btn btn-link"><i class="fas fa-long-arrow-alt-left"></i> Voltar</button>
                </div>
                <div class="col-md-10 col-lg-10 col-xl-10 col-sm-10 col-xs-10">
                    <div class="content-text-title text-uppercase text-center">VÍDEOS - {{ $data->name }}</div>
                </div>
            </div>

        </div>
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12 p-3">
            @if($data->type == 'youtube')
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ $data->path }}" allow="autoplay=1" allowfullscreen></iframe>

            </div>
            @else
            <video width="100%" height="720" controls>
                <source src="{{ url('storage/gallery/video')}}/{{ $data->path }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            @endif
        </div>
        <div class="col-12">
            {{ $data->description }}
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#menu-nav').addClass('bg-blue-person');
    });
</script>
@endsection