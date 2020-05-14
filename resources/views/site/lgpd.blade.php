@extends('layouts.site.master')
@section('content')
<div class="container" style="margin-top: 10em;margin-bottom:2em" id="inicial">
    <div class="row">
        <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 text-justify">
            {!! @$lgpd->content !!}
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
