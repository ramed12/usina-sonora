@extends('adminlte::page')
@section('content_header')
<div class="row">
    <div class="col-md-8 col-xs-8">
        <h1> Investidor </h1>
    </div>
    <div class="col-md-4 col-xs-4">
        <ol class="breadcrumb m-1">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
          <li class="breadcrumb-item active">Informações da Empresa</li>
        </ol>
    </div>
</div>
@stop
@section('content')

<div class="card card-outline card-primary">
    <div class="row">
        <div class="col-md-12 col-xs-12 p-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($data as $item)
                    @if($item->id == 1)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="{{ $item->slug }}-tab" data-toggle="tab" href="#{{ $item->slug }}" role="tab" aria-controls="{{ $item->slug }}" aria-selected="true">{{ $item->name }}</a>
                    </li>
                    @else
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="{{ $item->slug }}-tab" data-toggle="tab" href="#{{ $item->slug }}" role="tab" aria-controls="{{ $item->slug }}" aria-selected="true">{{ $item->name }}</a>
                    </li>
                    @endif
                @endforeach

              </ul>
              <div class="tab-content" id="myTabContent">
                @foreach ($data as $row)
                @if($row->id == 1)
                    <div class="tab-pane fade show active" id="{{ $row->slug }}" role="tabpanel" aria-labelledby="{{ $row->slug }}-tab">
                    <form method="POST" id="form-{{ $row->slug }}" class="form mt-2 ml-2">
                        @csrf
                        <div class="form-group">
                            <h3>{{ $row->name }}</h3>
                        </div>
                        <input type="hidden" id="id" name="id" value="{{ $row->id }}">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $row->name }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="text" name="phone" id="phone" class="form-control phone" value="{{ $row->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="fax">Fax</label>
                            <input type="text" name="fax" id="fax" class="form-control phone" value="{{ $row->fax }}">
                        </div>
                        <div class="form-group">
                            <label for="whatsapp">Whatsapp</label>
                            <input type="text" name="whatsapp" id="whatsapp" class="form-control phone" value="{{ $row->whatsapp }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Endereço</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ $row->address }}">
                        </div>
                        <div class="form-group">
                            <label for="maps">Mapas</label>
                            <input type="text" name="maps" id="maps" class="form-control" value="{{ $row->maps }}">
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" name="facebook" id="facebook" class="form-control" value="{{ $row->facebook }}">
                        </div>
                        <div class="form-group">
                            <label for="linkedin">Linkedin</label>
                            <input type="text" name="linkedin" id="linkedin" class="form-control" value="{{ $row->linkedin }}">
                        </div>
                        <div class="form-group">
                            <label for="instragram">Instragram</label>
                            <input type="text" name="instragram" id="instragram" class="form-control" value="{{ $row->instragram }}">
                        </div>
                    </form>
                        <div class="form-group">
                            <button id="{{ $row->slug }}-submit" class="btn btn-primary btn-block"><i class="fas fa-save"></i> Salvar</button>
                        </div>
                    </div>
                @else
                    <div class="tab-pane fade" id="{{ $row->slug }}" role="tabpanel" aria-labelledby="{{ $row->slug }}-tab">
                        <form method="POST" id="form-{{ $row->slug }}" class="form mt-2 ml-2">
                            @csrf
                            <div class="form-group">
                                <h3>{{ $row->name }}</h3>
                            </div>
                            <input type="hidden" id="id" name="id" value="{{ $row->id }}">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $row->name }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefone</label>
                                <input type="text" name="phone" id="phone" class="form-control phone" value="{{ $row->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input type="text" name="fax" id="fax" class="form-control phone" value="{{ $row->fax }}">
                            </div>
                            <div class="form-group">
                                <label for="whatsapp">Whatsapp</label>
                                <input type="text" name="whatsapp-{{ $row->slug }}" id="whatsapp-{{ $row->slug }}" class="form-control phone" value="{{ $row->whatsapp }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Endereço</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $row->address }}">
                            </div>
                            <div class="form-group">
                                <label for="maps">Mapas</label>
                                <input type="text" name="maps" id="maps" class="form-control" value="{{ $row->maps }}">
                            </div>
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="text" name="facebook" id="facebook" class="form-control" value="{{ $row->facebook }}">
                            </div>
                            <div class="form-group">
                                <label for="linkedin">Linkedin</label>
                                <input type="text" name="linkedin" id="linkedin" class="form-control" value="{{ $row->linkedin }}">
                            </div>
                            <div class="form-group">
                                <label for="instragram">Instragram</label>
                                <input type="text" name="instragram" id="instragram" class="form-control" value="{{ $row->instragram }}">
                            </div>
                        </form>
                            <div class="form-group">
                                <button id="{{ $row->slug }}-submit"  class="btn btn-primary btn-block"><i class="fas fa-save"></i> Salvar</button>
                            </div>
                        </div>
                @endif
                @endforeach
              </div>

        </div>
    </div>
</div>
@endsection
@section('footer')
    <center><b>Todos os direitos a Usina Sonora MS - {{ \Carbon\Carbon::now()->format('Y') }}</b></center>
@endsection
@section('js')
<script src="{{ asset('vendor/jquery-mask/dist/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/js/mask-phone.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
<script>

$(document).ready(function(){
    $(".phone").mask(behavior, options);

});
</script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
@endsection
