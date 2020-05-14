@extends('layouts.site.master-form')
@section('css')
<style>
@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700;1,900&display=swap');
    .text-form{
        font-size: 1.1704em;
        font-weight: bolder;
        font-family: 'Lato', sans-serif;
    }
    body{
        background-color: #ededed !important;
    }
    .bg-light {
        background-color: #ededed !important
    }
    select, option,textarea {
        color: #878787 !important
    }
    input[type=text]{
        color: #878787 !important
    }
    ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: #878787 !important;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #878787 !important;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: #878787 !important;
}
</style>
@endsection
@section('content')
<div class="container" id="inicio" style="margin-top: 9em;margin-bottom:2em">
    <div class="row d-flex justify-content-center" style="color: grey">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12 sr-only">
            <hr style="color: grey" width="100%">
            <div class="col-md-12 col-xs-12 col-xl-12 col-lg-12 col-sm-12">
                Conecte-se   <i style="vertical-align: super" class="ml-3 mr-3">_____________</i>
                @if(!empty($facebook))<a style="color: grey" href="{{ $facebook }}"  target="_blank"><i class="fab fa-facebook-f mr-2"></i></a>@endif
                @if(!empty($twitter))<a style="color: grey" href="{{ $twitter }}" target="_blank" ><i class="fab fa-twitter mr-2"></i></a>@endif
                @if(!empty($linkedin))<a style="color: grey" href="{{ $linkedin }}" target="_blank"><i class="fab fa-linkedin-in  mr-2"></i></a>@endif
                @if(!empty($instagram))<a style="color: grey" href="{{ $instagram }}" target="_blank"><i class="fab fa-instagram  mr-2"></i></a>@endif
                @if(!empty($googleplus))<a style="color: grey" href="{{ $googleplus }}" target="_blank"><i class="fab fa-google-plus-g sr-only"></i></a>@endif
            </div>
            <hr style="color: grey" width="100%">
        </div>

        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12 p-3 shadow bg-white rounded">
            <form action="{{ route('site.contact.send') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="g_recaptcha_response" name="g_recaptcha_response">
                <div class="form-group mb-5">
                    <div class="d-flex align-items-center text-form"> <span class="fa-stack" style="vertical-align: top;">
                        <i class="far fa-circle fa-stack-2x"></i>
                        <i class="fab fa-telegram-plane fa-stack-1x"></i>
                        </span>&nbsp;&nbsp;&nbsp; ENVIE SUA MENSAGEM</div>
                </div>
                <div class="form-group">
                    <label for="name"><b>Nome Completo</b></label>
                    <input type="text" id="name" name="name" class="form-control border-0 rounded-0 bg-light" placeholder="Nome Completo">
                </div>
                <div class="form-group">
                    <label for="email"><b>E-mail</b></label>
                    <input type="text" id="email" name="email" class="form-control border-0 rounded-0 bg-light" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <label for="phone"><b>Telefone</b></label>
                    <input type="text" id="phone" name="phone" class="form-control border-0 rounded-0 bg-light" placeholder="Telefone para contato">
                </div>
                <div class="form-group">
                    <label for="departament"><b>Departamento</b></label>
                    <select name="departament" id="departament" class="form-control border-0 rounded-0 bg-light">
                        <option value=""> Selecione </option>
                        @foreach ($departament as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject"><b>Assunto</b></label>
                    <select name="subject" id="subject" class="form-control border-0 rounded-0 bg-light">
                        <option value=""> Selecione </option>
                        <option value="Dúvidas"> Dúvidas </option>
                        <option value="Elogios"> Elogios </option>
                        <option value="Reclamações"> Reclamações </option>
                        <option value="Sugestões"> Sugestões </option>
                        <option value="Outros"> Outros </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="content"><b>Mensagem</b></label>
                    <textarea name="content" id="content" class="form-control border-0 rounded-0 bg-light" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn bg-blue-person text-white rounded-pill w-25">Enviar</button>
                </div>
            </form>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12"  style="margin-top: 3.5em;">
            <div class="d-flex align-items-center text-form" style="margin-bottom: 1em;">
                <span class="fa-stack" style="vertical-align: top;">
                <i class="far fa-circle fa-stack-2x"></i>
                <i class="fas fa-map-marker-alt fa-stack-1x"></i>
                </span>&nbsp;&nbsp;&nbsp; LOCALIZAÇÃO</div>
        </div>
         <div class="w-100 p-3 sr-only">
            <b><i>{{ $matriz->name }}</i></b><br/>
            <?php echo $matriz->address ?><br/>
            {{ $matriz->phone }} / {{ $matriz->fax }}<br/>
            <b>E-mail:</b> ouvidoria@usinasonora-ms.com.br
         </div>
        {!! $maps !!}
    </div>
    </div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.16.3/sweetalert2.min.css">
@endsection
@section('js')
<script src="{{ asset('vendor/jquery-mask/dist/jquery.mask.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{ asset('vendor/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/js/mask-phone.js') }}"></script>
<script>

$(document).ready(function(){
    $('#menu-nav').addClass('bg-blue-person');
    $("#phone").mask(behavior, options);

});
$( "#form" ).validate({
        rules : {
            name : {
                required : true,
                minlength: 5
            },
            departament : {
                required : true,
            },
            email : {
                required: true,
                email: true
            },
            phone : {
                required : true,
                minlength: 10
            },
            content : {
            required: true,
            minlength: 10
          },
        },

        messages : {
            name : {
                required : 'O Campo <b>Nome</b> é obrigatório.',
                minlength : 'O campo <b>Nome</b> tem que possuir no minímo 5 caracteres.'
            },
            departament : {
                required : 'O Campo <b>Departamento</b> é obrigatório.',
            },
            email : {
                required : 'O Campo <b>E-mail</b> é obrigatório.',
                email : 'Por favor insira um endereço de <b>E-mail</b> válido.'
            },
            phone : {
                required : 'O Campo <b>Telefone</b> é obrigatório.',
                minlength : 'O campo <b>Telefone</b> tem que possuir no minímo 10 caracteres.'
            },
            content : {
                required : 'O Campo <b>Mensagem</b> é obrigatório.',
                minlength : 'O campo <b>Mensagem</b> tem que possuir no minímo 10 caracteres.'
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
<script src="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.16.3/sweetalert2.all.min.js"></script>
<script>
Swal.fire({
    icon:  '{{ session('icon') }}',
    title: '{{ session('message') }}',
})
</script>
@endif
@endsection
