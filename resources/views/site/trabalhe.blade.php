@extends('layouts.site.master-page')
@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700;1,900&display=swap');

.title_job {
        font-family: 'Lato', sans-serif;
        font-size: 1.5em;
        font-weight: 400;
        color: #555555;
        padding-top: 1em;
        padding-bottom: 1em;
        max-width: 65%;
}
.job {
    background-color: #ffffff;
    padding: 1em
}
.description_job {

    font-family: 'Lato', sans-serif;
    color: #797979;
    font-size: 1em;
    text-align: justify;
    padding-top: 1em;
    padding-bottom: 1em;
}
.location_job {

    font-family: 'Lato', sans-serif;
    color: #797979;
}
.text-empty {
    font-family: 'Lato', sans-serif;
    color: #797979;
    font-size: 1.8em;

}
</style>
@endsection
@section('content')
<div class="container" id="inicio" style="margin-top: 13em;margin-bottom:2em">
    <div class="row">
        @if(!empty($vagas))
            @foreach ($vagas as $vaga)
            <div class="col-md-6 col-xl-4 col-lg-4 col-xs-12 col-sm-12">
                <div class="job shadow">
                    <div class="title_job">{{ $vaga['Titulo'] }}</div>
                    <hr style="background-color:#555555;height: .150em;">
                    <div class="description_job">{!! $vaga['Descricao'] !!}</div>
                    <div class="row pt-4 pb-4">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12 location_job">
                            <i class="fas fa-1x fa-map-marker-alt"></i> {{ $vaga['Localidade'] }}
                    </div>
                    <div class="col-md-5 col-lg-5 col-xl-5 col-sm-12 col-xs-12 text-right">
                        <a class="btn  bg-blue-person text-white rounded-pill w-100" target="_blank" href="http://portalrm.usinasonora-ms.com.br:8080/RM//Rhu-BancoTalentos/#/RM/Rhu-BancoTalentos/painelVagas/detalhesVaga/questionarios?codColigada={{$vaga['CodColigada']}}&codSelecao={{$vaga['CodSelecao']}}&codVaga={{$vaga['CodVaga']}}">Ver mais</a>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12 text-center text-empty">
                Não existem vagas disponíveis para candidatura no momento!
            </div>
        @endif
        </div>
        <div class="col-12 text-center p-2 mt-4">
            <button type="button" onclick="window.open('http://portalrm.usinasonora-ms.com.br:8080/RM//Rhu-BancoTalentos/#/RM/Rhu-BancoTalentos/usuario_public', '_blank');" class="btn bg-blue-person text-white rounded-pill w-50 h-50"><b>Cadastre seu Currículo</b></button>
        </div>
	<div class="col-12 text-center p-2 mt-4">
		<img class="img-fluid" src="{{ url('assets/image')}}/pcd.jpg"/>
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