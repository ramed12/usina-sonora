@extends('layouts.site.master-form')
@section('css')
<style>
@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700;1,900&display=swap');

body{
        background-color: #ededed !important;
    }
    .text-form{
        font-size: 1.1704em;
        font-weight: bolder;
        font-family: 'Lato', sans-serif;
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
    input[type=password], input[type=email] {
        background-color: #767676
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
<div class="container" id="inicio" style="margin-top: 9em;margin-bottom:2em" id="inicial">
    <div class="row d-flex justify-content-center" style="color: grey">
        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12 p-2 text-justify">

                <span class="fa-stack">
                <i class="far fa-circle fa-stack-2x"></i>
                <i class="fas fa-list-alt fa-stack-1x"></i>
                </span>&nbsp;&nbsp;&nbsp; <i class=" text-form"> NOVO CADASTRO</i>

            <hr style="border-color: #103185;height:2px" width="100%">
Para obter os documentos de investimento é necessário efetuar um cadastro no formulário, <b>e aguardar a ativação e o envio da senha pelo e-mail cadastrado.</b>
            <form action="{{ route('site.investor.send') }}" class=" p-3 shadow bg-white rounded-0 mt-3" method="post" id="form">
                @csrf
                <input type="hidden" id="g_recaptcha_response" name="g_recaptcha_response">
                <div class="form-group">
                    <label for="company"><b>Empresa</b></label>
                    <input type="text" id="company" name="company" class="form-control border-0 rounded-0 bg-light" placeholder="Empresa">
                </div>
                <div class="form-group">
                    <label for="name"><b>Nome <sup>(*)</sup></b></label>
                    <input type="text" id="name" name="name" class="form-control border-0 rounded-0 bg-light" placeholder="Nome do Investidor">
                </div>
                <div class="form-group">
                    <label for="email"><b>E-mail <sup>(*)</sup></b></label>
                    <input type="text" id="email" name="email" class="form-control border-0 rounded-0 bg-light" placeholder="E-mail do Investidor">
                </div>
                <div class="form-group">
                    <label for="phone"><b>Telefone <sup>(*)</sup></b></label>
                    <input type="text" id="phone" name="phone" class="form-control border-0 rounded-0 bg-light" placeholder="Telefone do Investidor">
                </div>
                <div class="form-group">
                    <label for="relationship"><b>Relacionamento</b></label>
                    <select class="form-control border-0 rounded-0 bg-light" name="relationship" id="relationship">
                        <option value="1" selected="selected">Acionista</option>
                        <option value="2">Agência de Rating</option>
                        <option value="3">Imprensa</option>
                        <option value="4">Instituição Financeira</option>
                        <option value="5">Investidor</option>
                        <option value="6">Outros</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn  bg-blue-person text-white rounded-pill w-25">Enviar</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12 p-2 text-justify">
            <span class="fa-stack">
                <i class="far fa-circle fa-stack-2x"></i>
                <i class="fas fa-list-alt fa-stack-1x"></i>
                </span>&nbsp;&nbsp;&nbsp; <i class=" text-form"> JÁ SOU CADASTRADO</i>

            <hr style="border-color: #103185;height:2px" width="100%">
            Se você já recebeu sua senha, digite-a no campo abaixo junto com o e-mail cadastrado.
            <p>&nbsp;</p>
            @if(!empty(Auth::user()))
            @if(Auth::user()->role == 2)
            <a href="{{ route('site.investorarea') }}#inicial" class="btn text-white bg-blue-person rounded-0"><i class="fas fa-sign-in-alt"></i> Área do investidor</a>
            @else

            <form action="{{ route('login') }}" class=" p-3 shadow bg-dark rounded-0 mt-3" method="post" id="login">
                @csrf 
                <div class="form-group">
                    <label for="email" class="text-white"><b>E-mail</b></label>
                    <input type="email" name="email" id="email" placeholder="E-mail" class="form-control border-0 rounded-0">
                </div>
                <div class="form-group">
                    <label for="email" class="text-white"><b>Senha</b></label>
                    <input type="password" name="password" id="password" placeholder="Senha" class="form-control border-0 rounded-0">
                </div>
                <div class="form-group">

                    <button type="submit" class="btn  bg-blue-person text-white rounded-pill w-25">Acessar</button>
                </div>
            </form>
            @endif
            @else

            <form action="{{ route('login') }}" class=" p-3 shadow bg-dark rounded-0 mt-3" method="post" id="login">
                @csrf
                <div class="form-group">
                    <label for="email" class="text-white"><b>E-mail</b></label>
                    <input type="email" name="email" id="email" placeholder="E-mail" class="form-control border-0 rounded-0">
                </div>
                <div class="form-group">
                    <label for="email" class="text-white"><b>Senha</b></label>
                    <input type="password" name="password" id="password" placeholder="Senha" class="form-control border-0 rounded-0">
                </div>
                <div class="form-group">

                    <button type="submit" class="btn  bg-blue-person text-white rounded-pill w-25">Acessar</button>
                </div>
            </form>
            @endif

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
$("#login").validate({
    rules : {
            email : {
                required: true,
                email: true
            },
            password : {
                required: true,
            },
    },
    messages : {
            email : {
                required : 'O Campo <b>E-mail</b> é obrigatório.',
                email : 'Por favor insira um endereço de <b>E-mail</b> válido.'
            },
            password : {
                required : 'O Campo <b>Senha</b> é obrigatório.',
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
})
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
            }
        },

        messages : {
            name : {
                required : 'O Campo <b>Nome</b> é obrigatório.',
                minlength : 'O campo <b>Nome</b> tem que possuir no minímo 5 caracteres.'
            },
            email : {
                required : 'O Campo <b>E-mail</b> é obrigatório.',
                email : 'Por favor insira um endereço de <b>E-mail</b> válido.'
            },
            phone : {
                required : 'O Campo <b>Telefone</b> é obrigatório.',
                minlength : 'O campo <b>Telefone</b> tem que possuir no minímo 10 caracteres.'
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
