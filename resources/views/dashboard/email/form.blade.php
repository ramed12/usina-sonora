@extends('adminlte::page')
@section('content_header')
<div class="row">
    <div class="col-md-8 col-xs-8">
        <h1> E-mail
        </h1>
    </div>
    <div class="col-md-4 col-xs-4">
        <ol class="breadcrumb m-1">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('email') }}">Listar E-mails</a></li>
          <li class="breadcrumb-item active">{{ $action }} E-mail</li>
        </ol>
    </div>
</div>
@stop
@section('content')
<div class="card card-outline card-warning">
    <div class="card-header">
        <div class="col-md-12 col-xs-12">
            <a href="{{route('email') }}" class="card-link"><i class="fas fa-long-arrow-alt-left"></i> Voltar</a>
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
            <label for="content">Conteúdo</label>
            <textarea name="content" id="content" class="form-control @error('content')  is-invalid @enderror" cols="30" rows="10">@if(!empty($data->content)){{ $data->content }}@endif</textarea>
            @error('content')
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
            <button type="submit" class="btn btn-primary btn-block"><i class="{{ $icon }}"></i> {{ $button }}</button>
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
<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
    $(document).ready(function(){
  CKEDITOR.replace( 'content' );

});
</script>
<script>
    $( "#form" ).validate({
        rules : {
            name : {
                required : true,
                minlength: 5
            },
            content : {
                required: true
            },
        },

        messages : {
            name : {
                required : 'O Campo <b>Nome</b> do Arquivo é obrigatório.',
                minlength : 'O campo <b>Nome</b> tem que possuir no minímo 5 caracteres.'
            },
            content : {
                required : 'O Campo <b>E-mail</b> da Imagem é obrigatório.'
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
