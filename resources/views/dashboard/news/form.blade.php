@extends('adminlte::page')
@section('content_header')
<div class="row">
    <div class="col-md-8 col-xs-8">
        <h1> Notícia
        @if(!empty($data->name))
            &nbsp;({{ $data->name }})
        @endif
        </h1>
    </div>
    <div class="col-md-4 col-xs-4">
        <ol class="breadcrumb m-1">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('news') }}">Listar Notícias</a></li>
          <li class="breadcrumb-item active">{{ $action }} Notícia</li>
        </ol>
    </div>
</div>
@stop
@section('content')
<div class="card card-outline card-warning">
    <div class="card-header">
        <div class="col-md-12 col-xs-12">
            <a href="{{route('news') }}" class="card-link"><i class="fas fa-long-arrow-alt-left"></i> Voltar</a>
        </div>
    </div>
    <div class="card-body">
        <form role="form" id="form" method="POST" action="{{ route( $route ) }}" enctype="multipart/form-data">
            @csrf
        <div class="box-body">
            <input type="hidden" name="id" value="@if(!empty($data->id)){{ $data->id }}@endif">
            <input type="hidden" name="imageOld" value="@if(!empty($data->image)){{ $data->image }}@endif">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" id="title" class="form-control @error('title')  is-invalid @enderror" value="@if(!empty($data->title)){{ $data->title }}@endif">
                @error('title')
                <span class="error invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="date">Data / Hora</label>
                <div class="row">

                <input type="date" name="date" id="date" class="form-control col-3 ml-2 mr-2">
                <input type="time" name="time" id="time" class="form-control col-2">
                </div>
            </div>
            <div class="form-group">
                <label for="subtitle">Chamada</label>
                <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle')  is-invalid @enderror" value="@if(!empty($data->subtitle)){{ $data->subtitle }}@endif">
                @error('subtitle')
                <span class="error invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="tag">Url amigável da noticia</label>
                <input type="text" name="tag" id="tag" class="form-control" value="@if(!empty($data->tag)){{ $data->tag }}@endif">
            </div>
            <div class="form-group">
                <label for="tag">Autor</label>
                <input type="text" name="author" id="author" class="form-control" value="@if(!empty($data->author)){{ $data->author }} @else{{ Auth::user()->name }}@endif">
            </div>
            <div class="form-group">
                <label for="url_site">Link de referencia da noticia</label>
                <input type="text" name="url_site" id="url_site" class="form-control" value="@if(!empty($data->url_site)){{ $data->url_site }}@endif">
            </div>
            <div class="form-group">
                <label for="image">Imagem de Capa</label>
                <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input"  accept="image/*" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01">Selecione o arquivo</label>
                    </div>
                  </div>
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
                <label>* A notícia somente irá estar no site se estiver como ativo</label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"><i class="{{ $icon }}"></i> Salvar</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('footer')
    <center><b>Todos os direitos a Usina Sonora MS - {{ \Carbon\Carbon::now()->format('Y') }}</b></center>
@endsection
@section('js')
 <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
 <script src="{{ asset('vendor/jquery-validation/jquery.validate.js') }}"></script>
 <script src="{{ asset('vendor/jquery-validation/additional-methods.min.js') }}"></script>

<script>
    $(document).ready(function(){
   CKEDITOR.replace( 'content'  );

});
</script>
<script>
    $( "#form" ).validate({
        rules : {
            title : {
                required : true,
            },
            content : {
                required : true,
            }
        },

        messages : {
            title : {
                required : 'O Campo <b>Título</b> é obrigatório.',
            },
            content : {
                required : 'O Campo <b>Conteúdo</b> da Imagem é obrigatório.',
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
<script src="{{ asset('/assets/js/remove-accents.js') }}"></script>
<script>
    $("#title").change(function(){
    var new_title = removeAccents($('#title').val()).toLowerCase().replace(/ /g, "-")
    $('#tag').val(new_title);
});
</script>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
@endsection
