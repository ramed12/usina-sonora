@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-lightbulb"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Caixa de Idéias</span>
                <span class="info-box-number">{!! count($idea) !!}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-4">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-inbox"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Fale Conosco</span>
                <span class="info-box-number">{!! count($contact) !!}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-4">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Investidores</span>
                <span class="info-box-number">{!! count($user) !!}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
