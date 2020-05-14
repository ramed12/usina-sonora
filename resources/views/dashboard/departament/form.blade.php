@extends('adminlte::page')
@section('content_header')
<div class="row">
    <div class="col-md-7 col-xs-7">
        <h1> Departamento
        </h1>
    </div>
    <div class="col-md-5 col-xs-5">
        <ol class="breadcrumb m-1">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('departament') }}">Listar Departamentos</a></li>
          <li class="breadcrumb-item active">{{ $action }} Departamento</li>
        </ol>
    </div>
</div>
@stop
@section('content')
<div class="card card-outline card-warning">
    <div class="card-header">
        <div class="col-md-12 col-xs-12">
            <a href="{{route('departament') }}" class="card-link"><i class="fas fa-long-arrow-alt-left"></i> Voltar</a>
        </div>
    </div>
    <div class="card-body">
        <form role="form" id="form" method="POST" action="{{ route( $route ) }}" enctype="multipart/form-data">
         @csrf
            <input type="hidden" name="id" value="@if(!empty($data->id)){{ $data->id }}@endif">
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
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" class="form-control @error('email')  is-invalid @enderror" value="@if(!empty($data->email)){{ $data->email }}@endif">
            @error('email')
                <span class="error invalid-feedback">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
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
            <button type="submit" class="btn btn-primary btn-block"><i class="{{ $icon }}"></i> Salvar</button>
        </div>
        </form>
    </div>
</div>
@endsection
@section('footer')
    <center><b>Todos os direitos a Usina Sonora MS - {{ \Carbon\Carbon::now()->format('Y') }}</b></center>
@endsection
@section('js')
<script src="{{ asset('vendor/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{ asset('vendor/jquery-validation/additional-methods.min.js') }}"></script>
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
