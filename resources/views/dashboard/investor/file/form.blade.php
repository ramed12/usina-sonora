@extends('adminlte::page')
@section('content_header')
<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6 col-xs-6">
        <h1> Planilha Investidor </h1>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6 col-xs-6">
        <ol class="breadcrumb m-1">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('user') }}">Listar Planilha Investidor</a></li>
          <li class="breadcrumb-item active">{{ $action }} Planilha Investidor</li>
        </ol>
    </div>
</div>
@stop
@section('content')
<div class="card card-outline card-warning">
    <div class="card-header">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12">
            <a href="{{route('investor.file') }}" class="card-link"><i class="fas fa-long-arrow-alt-left"></i> Voltar</a>
        </div>
    </div>
    <div class="card-body">
        <form role="form" id="form" method="POST" action="{{ route( $route ) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="@if(!empty($data->id)){{ $data->id }}@endif">

            <input type="hidden" name="fileOld" value="@if(!empty($data->path)){{ $data->path }}@endif">
             <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control @error('name')  is-invalid @enderror" value="@if(!empty($data->name)){{ $data->name }}@endif">
                @error('name')
                    <span class="error invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="month">Mês</label>
                <select name="month" id="month" class="form-control">
                    <option value="Janeiro" @if(isset($data->month)) @if($data->month == "Janeiro") selected @endif @endif>Janeiro</option>
                    <option value="Fevereiro" @if(isset($data->month)) @if($data->month == "Fevereiro") selected @endif @endif>Fevereiro</option>
                    <option value="Março" @if(isset($data->month)) @if($data->month == "Março") selected @endif @endif>Março</option>
                    <option value="Abril" @if(isset($data->month)) @if($data->month == "Abril") selected @endif @endif>Abril</option>
                    <option value="Maio" @if(isset($data->month)) @if($data->month == "Maio") selected @endif @endif>Maio</option>
                    <option value="Junho" @if(isset($data->month)) @if($data->month == "Junho") selected @endif @endif>Junho</option>
                    <option value="Julho" @if(isset($data->month)) @if($data->month == "Julho") selected @endif @endif>Julho</option>
                    <option value="Agosto" @if(isset($data->month)) @if($data->month == "Agosto") selected @endif @endif>Agosto</option>
                    <option value="Setembro" @if(isset($data->month)) @if($data->month == "Setembro") selected @endif @endif>Setembro</option>
                    <option value="Outubro" @if(isset($data->month)) @if($data->month == "Outubro") selected @endif @endif>Outubro</option>
                    <option value="Novembro" @if(isset($data->month)) @if($data->month == "Novembro") selected @endif @endif>Novembro</option>
                    <option value="Dezembro" @if(isset($data->month)) @if($data->month == "Dezembro") selected @endif @endif>Dezembro</option>
                </select>
                 @error('month')
                    <span class="error invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="year">Ano</label>
                <select name="year" id="year" class="form-control">
                    @for ($i = 2000; $i <= date('Y');$i++)
                        <option value="{{ $i }}"@if(isset($data->year))   @if($data->year == $i) selected @endif @endif>{{ $i }}</option>
                    @endfor
                </select>
                @error('year')
                    <span class="error invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="file">Arquivo</label>
                <div class="input-group mb-3">
                        <div class="custom-file">
                      <input type="file" class="custom-file-input"   id="file" name="file" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01">Selecione o arquivo</label>
                    </div>
                  </div>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
            </div>
            <div class="form-group">
                <span class="switch">
                    <input type="checkbox" id="status" name="status" class="switch"  @if(!empty($data->status)) @if($data->status == 1) checked @endif @endif>
                    <label for="status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </span>
            </div>
            <div class="form-group">
                <label for="password">Senha do Arquivo</label>
                <input type="text" name="password" id="password" class="form-control" value="@if(!empty($data->password)){{ $data->password }}@endif">
                @error('password')
                    <span class="error invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"><i class="{{ $icon }}"></i> {{ $action }}</button>
            </div>
            </form>
        </div>
</div>
@endsection
@section('footer')
    <center><b>Todos os direitos a Usina Sonora MS - {{ \Carbon\Carbon::now()->format('Y') }}</b></center>
@endsection
@section('js')

<script src="{{ asset('vendor/jquery-mask/dist/jquery.mask.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{ asset('vendor/jquery-validation/additional-methods.min.js') }}"></script>
<script>
var behavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
options = {
    onKeyPress: function (val, e, field, options) {
        field.mask(behavior.apply({}, arguments), options);
    }
};
$(document).ready(function(){
    $("#phone").mask(behavior, options);

});
</script>
<script>
    $( "#form" ).validate({
        rules : {
            name : {
                required : true,
                minlength: 5
            },
            email : {
                required: true,
                email: true
            },
            phone : {
                required : true,
                minlength: 10
            }, 
            status : {
            required: true,
            minlength: 1
          },
        },

        messages : {
            name : {
                required : 'O Campo <b>Nome</b> do Arquivo é obrigatório.',
                minlength : 'O campo <b>Nome</b> tem que possuir no minímo 5 caracteres.'
            },
            email : {
                required : 'O Campo <b>E-mail</b> da Imagem é obrigatório.',
                email : 'Por favor insira um endereço de <b>E-mail</b> válido.'
            },
            phone : {
                required : 'O Campo <b>Telefone</b> da Imagem é obrigatório.',
                minlength : 'O campo <b>Telefone</b> tem que possuir no minímo 10 caracteres.'
            }, 
            status : {
                required : 'O Campo <b>Status</b> da Imagem é obrigatório.',
            }
        },
        errorElement: "div",
			errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
		    	error.addClass( "invalid-feedback" );

            if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.parent( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
			highlight: function ( element, errorClass, validClass ) {
				$( element ).addClass( "is-invalid" );
			},
			unhighlight: function (element, errorClass, validClass) {
				$( element ).removeClass( "is-invalid" );
			}
    });

</script>
@if (session('message'))
<script>
Swal.fire({
    icon:  '{{ session('icon') }}',
    title: '{{ session('message') }}',
})
</script>
@endif
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
@endsection
