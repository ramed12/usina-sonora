@extends('adminlte::page')
@section('content_header')
<div class="row">
    <div class="col-md-5 col-xs-5">
        <h1> Galeria de Imagens
        @if(!empty($data->name))
            &nbsp;({{ $data->name }})
        @endif
        </h1>
    </div>
    <div class="col-md-7 col-xs-7">
        <ol class="breadcrumb m-1">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route($route2) }}">Listar {{ $page }}</a></li>
          <li class="breadcrumb-item active">{{ $action }} {{ $page }}</li>
        </ol>
    </div>
</div>
@stop
@section('content')
<div class="card card-outline card-warning">
    <div class="card-header">
        <div class="col-md-12 col-xs-12">
            <a href="{{ route($route2) }}" class="card-link"><i class="fas fa-long-arrow-alt-left"></i> Voltar</a>
        </div>
    </div>
    <div class="card-body">
        <form role="form" id="form" method="POST" action="{{ route( $route ) }}" enctype="multipart/form-data">
            @csrf
             <input type="hidden" name="id" value="@if(!empty($data->id)){{ $data->id }}@endif">
            <input type="hidden" name="gallery" value="{{ $gallery }}">
            <input type="hidden" name="posterOld" value="@if(!empty($data->poster)){{ $data->poster }}@endif">
            <input type="hidden" name="imageOld" value="@if(!empty($data->image)){{ $data->image }}@endif">
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
                <label for="position">Posição</label>
                <input type="number" name="position" id="position" class="form-control @error('position')  is-invalid @enderror" value="@if(!empty($data->position)){{ $data->position }}@endif">
                @error('position')
                    <span class="error invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            @php
                $categories = [ 1 => 'Usina',2 => 'Produtos',3 => 'Matérias',4 => 'Institucional', 5 => 'Ação Social'];
                $count =  count($categories);
            @endphp
            <div class="form-group @if($route2 != 'gallery.video') sr-only @endif">
                <label for="categoria">Categoria</label>
                <select name="category" id="category" class="form-control">
                    @for ($i = 1; $i <= $count;$i++)
                        @if(!empty($data->category))
                            @if($data->category == $i)
                            <option value="{{ $i }}" selected>{{ $categories[$i] }}</option>
                            @else
                            <option value="{{ $i }}">{{ $categories[$i] }}</option>
                            @endif
                        @else
                            <option value="{{ $i }}">{{ $categories[$i] }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            @if($gallery == 'video' || $gallery == 'carousel')
            <div class="form-group">
                <div class="row">
                    <div class="col-3"><label for="type"><input type="radio" name="type" id="type" value="video" class="form-control" checked> 
                    @if($gallery == 'video')
                    Vídeo
                    @else
                    Imagem
                    @endif
                    </label>
                   </div>
                   <div class="col-3">
                    <label for="type"><input type="radio" name="type" id="type" value="youtube" class="form-control"> Youtube</label>
                   
                   </div>
                </div>
            </div>
            @endif
	    @if($gallery == 'video')
            <div class="form-group">
                <label for="image">Poster do Vídeo</label>
                <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input"   id="poster" name="poster" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01">Selecione o arquivo</label>
                    </div>
                  </div>
                  <label for="" style="color: red !important" ><b>Extensões aceitas Imagens (JPG,GIF,PNG)</b></label>
            </div> 
            @endif
            <div class="form-group" id="video">
                <label for="image">Arquivo</label>
                <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01">Selecione o arquivo</label>
                    </div>
                  </div>
                  <label for="" style="color: red !important" class="@if($gallery != 'journal') sr-only @endif"><b>Extensões aceitas PDF</b></label>
                  <label for="" style="color: red !important" class="@if($gallery == 'journal') sr-only @endif"><b>Extensões aceitas Imagens (JPG,GIF,PNG) e Vídeo (MP4)</b></label>
                  @if($gallery == 'certificate')
                  <label for="" ><b>A medida a ser utilizada é de 160 largura por 80 de altura</b></label>
                  @endif
            </div> 
            <div class="form-group" id="youtube" style="display: none">
                <label for="image">Arquivo</label>
                <input type="text" id="video-youtube" class="form-control" placeholder="Link do vídeo do youtube">
                <input type="hidden" name="image" id="link-youtube" value="">
            </div>
            <div class="form-group @if($gallery == 'journal') sr-only @endif">
                <label for="description">Descrição da imagem</label>
                <input type="text" name="description" id="description" class="form-control" value="@if(!empty($data->description)){{ $data->description }}@endif">
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
        </div>
    </form>
</div>
@endsection
@section('footer')
    <center><b>Todos os direitos a Usina Sonora MS - {{ \Carbon\Carbon::now()->format('Y') }}</b></center>
@endsection
@section('js')
<script type="text/javascript">
    //FUNCAO PARA ESCONDER E APRESENTAR CAMPOS
    $(document).ready(function(){
        $("#divHide").hide();
        $("input[name$='type']").click(function(){
            var valor = $(this).val();
            if (valor == 'video') {
               $("#video").show();
               $("#youtube").hide();
            }else{
              $("#youtube").show();
               $("#video").hide();
            }
        });
    });

    $("#youtube").change(function(){ 
  var str = $("#video-youtube").val();  
  var res = str.split("/watch?v=");
  var res2 = res[0] +'/embed/'  + res[1];
  var res3 = res2.split("&ab_channel");
  var new_link = res3[0]; 
  $('#link-youtube').val(new_link)
}); 
</script>
<script src="{{ asset('assets/js/validation/dist/jquery.validate.js') }}"></script>
<script src="{{ asset('assets/js/validation/dist/additional-methods.min.js') }}"></script>
<script>
    $( "#form" ).validate({
        rules : {
            name : {
                required : true,
                minlength: 5
            },
            position : {
                required: true
            }
        },

        messages : {
            name : {
                required : 'O Campo <b>Nome</b> do Arquivo é obrigatório.',
                minlength : 'O campo <b>Nome</b> tem que possuir no minímo 5 caracter.'
            },
            position : {
                required : 'O Campo <b>Posição</b> da Imagem é obrigatório.',
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
