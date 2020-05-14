@extends('layouts.site.master-form')
@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700;1,900&display=swap');

    body{
        background-color: #103185 !important
    }
    .idea-title {
        font-family: 'Poppins', sans-serif;
        font-size: 3.0235em !important;
        font-weight: 500 !important;
        color: #ffffff !important;
        text-align: center
    }
    .idea-subtitle {
        font-family: 'Lato', sans-serif;
        font-size: 1.5207;
        text-align: center;
        color: #ffffff !important;
    }
    input[type="radio"] {
        visibility: hidden;
}
input[type="radio"]:checked  + .sel {
   background-color: #103185 !important
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
<div class="container" id="inicio" style="margin-top: 9em">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12">
            <div class="idea-title">Sobre o que quer compartilhar?</div>
            <div class="idea-subtitle mt-3">Se for contribuir com uma ideia, você precisa identificar seu nome e setor.</div>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12 mt-5">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-3 col-lg-3 col-xl-3 col-sm-12 mb-5 mb-md-0 mb-lg-0 mb-xl-0  d-none">
                    <input type="radio" name="type"  id="reclamacao" value="reclamacao">
                    <label for="reclamacao" class="bg-orange-person rounded-0 w-75 h-75 pt-md-5  pt-xl-5 pt-lg-5 pt-4">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="50px" height="46px">
                       <image  x="0px" y="0px" width="50px" height="46px"  xlink:href="data:img/png;base64,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" />
                       </svg>
                       <div class="p-2"> Reclamação</div>
                    </label>
                    <div id="reclamacao-div" class="bg-blue-person-inactive rounded-0 w-75 ml-3"  style="max-width: 76% !important">Selecionar</div>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3 mb-5 mb-md-0 mb-lg-0 mb-xl-0 d-none">
                    <input type="radio" name="type" id="solicitacao" value="solicitacao">
                    <label for="solicitacao" class="bg-green-person rounded-0 w-75 h-75 pt-md-4 pt-lg-4 pt-xl-4 pt-4">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="36px" height="66px">
                        <image  x="0px" y="0px" width="36px" height="66px"  xlink:href="data:img/png;base64,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" />
                        </svg>
                        <div class="p-2">Solicitação</div>
                        </label>
                        <div id="solicitacao-div" class="bg-blue-person-inactive rounded-0 w-75 ml-3" style="max-width: 76% !important">Selecionar</div>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3 mb-5 mb-md-0 mb-lg-0 mb-xl-0">
                    <input type="radio" name="type" id="ideia" value="ideia">
                    <label for="ideia" class="bg-yellow-person rounded-0 w-75 h-75 pt-md-4 pt-lg-4 pt-xl-4 pt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="49" height="46" viewBox="0 0 49 46">
                            <image id="Objeto_Inteligente_de_Vetor" data-name="Objeto Inteligente de Vetor" width="49" height="46" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAA8CAYAAAAgwDn8AAAFhElEQVRogc1aW2wWVRD+Si+00pRC1dgWUJCACNaiog94iQovxNDyoIkPqPGBRMWkVR9MvAUTY4LREI2YGC8QbTSpiT4YI5eEYNoHIohILRpBDd7QIgjVUijlM0O/jcvm7+7Z3bPESSbn/8/OzDdzzp45ty0jiQJpq0wvKQqiokjvAcwu2D4mFA1QNLkGUAngQQDN58GnZmFVOknbGHDgVo7RJkf5gH8Up9HZJKxWF/k0hrfJcFuBAbQJY5urTpoAWkieJnmA5MQCApgo24ZxlatfaQbxVwBeBzALQKejTq/YhTpl2zD2ujqVdh6YCmC/BthcAL+mUY6hJgDfAhhR6j3iqpg2jZrhJwHUAnjMk/OQrVrZdnYeGScy6+IZADYnyNWpx4z+Eo9HHwM4JdupyOdSYhGANgC3AGhRAGEaBNAHYDuAjwDs8AGaNwB7Be8G8DiABaobBbAPwIFQq0/RAJ0HoFx1JrMWwLsATmf2gORGki+QrE854VxDcqfytqW+buXx2hgde9ZO8gPpGO0heX1K7Hr5vNH+9MvQAMkHSFY4GFhN8qT0ukjOSumA8WyS78nGCMlOB50K+TggvX6rrCH5BMm/VbmX5NIYI2tDAS9zAL2I5FySVeM8NxuHZXMdybJx5JbKN8pX87kmLNBEcgPJMxL6sAToGj37juRMx5beIZ1hkptJrixh13pwv+Seizyrki+Ubxvk69nnpQCvI9lD8h+SDaH6FTJiS4NpKV4Va+E3SO7mf/Q9yeURObN5UBJ3heob5EuPfDvHfhxwZej3xSSPkDxB8uoM73u4pV8meUqOvkRyQuh5q3rqGMnGcXxxDiDMbwnwkRzOh9kWhvtk8+3Ie/+o6t9xseUCdrlSXr9jhnLlqSS/KNEwhvENyVFlqtwBBFnnXo/OB9yobDYceWXuF+aLPgL4We9kTQEBGN9O8k2S1aE6wzpO8peYtOoUwDy1RHdBzsdxt7AXxMklLacXqdyeea2SnQLMa+MsJAVwhcr+gp21levByE4vwJwTp5gUQL3KP/L5l0i2mZkO4IaQYIA5JU45KYBqlcPF+X6O/epQ3QmVNXGKSQEcVxndnPimC2XvcMhu0PtxO7nEAH5TOaPgAKyhDkV2adNUHopTTNoTf62yVdvAosicbIzYXqiyLw4zqQc+t01bkcfjMbRE2DtjpRwmlF6tw5sKnLSi3CzM3iRZl3OhLtv8A1hdcIuH6WFhdiUJupxKXKBJplKTyu++vY3QJaFTuumhdFqSXHpgCMCzSqXrCnYewqgTZqzzZ8nxnSwnuUuLq1UFvvurhLFLmIk6aYzbdvCotoPR/awPXi7bR9Mc06QFvpXkkIBWenT+HtkcEoazbhaw20gOqqtfS3HZUYpNd71sDcp2KhtZge2gqk/AW+NODWLY9r5bZMNszcniS55un0TyEznwTAb9p6T7qWxl8iPv6XSDcnal8ndy2hujGi0UR7VpGsjqQN6L7j81W1revimF3o0AJks3s/PwdFO/R+WlKXQuU/llXnAfAQR3WpNS6ASyqe7DSpGPjz2Czc7TADoAnAFwH4DPANyJsVuYsohOXUQ3M/nogdHI/xGx0cmE66OobnrKkUYDblc67Eih0yGd9rz4Pr8XWhEanEm00FEukXwGcLP4vJKPe2LL5zMz6v4A4Fge8KI/ORsJnWxU6Z44mpHykcdBPB4F3xc9X+L5/2oQW97fHamzI8Me/X5fvVCuQexnvHjogcVqzfUpdII9wOK8+D4GcaVWltabVzp8Q9Sko3Ob4BpDk14m8jETmwNrlI22AJgfIztfMpOlk8t5ePzcxjLLKwAe0nGgfZ72U2ipUK4znhbJvqrDq/zgHsZAmO/QFtM251GyOntmMn7wSPwLPt5KY7Fq7McAAAAASUVORK5CYII="/>
                          </svg>
                          <div class="p-2 mt-3">Idéia</div>
                    </label>
                    <div id="ideia-div" class="bg-blue-person-inactive w-75 ml-3"  style="max-width: 76% !important">Selecionar</div>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3 mb-5 mb-md-0 mb-lg-0 mb-xl-0">
                    <input type="radio" name="type" id="elogio" value="elogio">
                    <label for="elogio"  class="bg-pink-person rounded-0 w-75 h-75  pt-md-4 pt-lg-4 pt-xl-4 pt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="49" height="46" viewBox="0 0 49 46">
                            <image id="Objeto_Inteligente_de_Vetor" data-name="Objeto Inteligente de Vetor" width="49" height="46" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAA8CAYAAAAgwDn8AAAFhElEQVRogc1aW2wWVRD+Si+00pRC1dgWUJCACNaiog94iQovxNDyoIkPqPGBRMWkVR9MvAUTY4LREI2YGC8QbTSpiT4YI5eEYNoHIohILRpBDd7QIgjVUijlM0O/jcvm7+7Z3bPESSbn/8/OzDdzzp45ty0jiQJpq0wvKQqiokjvAcwu2D4mFA1QNLkGUAngQQDN58GnZmFVOknbGHDgVo7RJkf5gH8Up9HZJKxWF/k0hrfJcFuBAbQJY5urTpoAWkieJnmA5MQCApgo24ZxlatfaQbxVwBeBzALQKejTq/YhTpl2zD2ujqVdh6YCmC/BthcAL+mUY6hJgDfAhhR6j3iqpg2jZrhJwHUAnjMk/OQrVrZdnYeGScy6+IZADYnyNWpx4z+Eo9HHwM4JdupyOdSYhGANgC3AGhRAGEaBNAHYDuAjwDs8AGaNwB7Be8G8DiABaobBbAPwIFQq0/RAJ0HoFx1JrMWwLsATmf2gORGki+QrE854VxDcqfytqW+buXx2hgde9ZO8gPpGO0heX1K7Hr5vNH+9MvQAMkHSFY4GFhN8qT0ukjOSumA8WyS78nGCMlOB50K+TggvX6rrCH5BMm/VbmX5NIYI2tDAS9zAL2I5FySVeM8NxuHZXMdybJx5JbKN8pX87kmLNBEcgPJMxL6sAToGj37juRMx5beIZ1hkptJrixh13pwv+Seizyrki+Ubxvk69nnpQCvI9lD8h+SDaH6FTJiS4NpKV4Va+E3SO7mf/Q9yeURObN5UBJ3heob5EuPfDvHfhxwZej3xSSPkDxB8uoM73u4pV8meUqOvkRyQuh5q3rqGMnGcXxxDiDMbwnwkRzOh9kWhvtk8+3Ie/+o6t9xseUCdrlSXr9jhnLlqSS/KNEwhvENyVFlqtwBBFnnXo/OB9yobDYceWXuF+aLPgL4We9kTQEBGN9O8k2S1aE6wzpO8peYtOoUwDy1RHdBzsdxt7AXxMklLacXqdyeea2SnQLMa+MsJAVwhcr+gp21levByE4vwJwTp5gUQL3KP/L5l0i2mZkO4IaQYIA5JU45KYBqlcPF+X6O/epQ3QmVNXGKSQEcVxndnPimC2XvcMhu0PtxO7nEAH5TOaPgAKyhDkV2adNUHopTTNoTf62yVdvAosicbIzYXqiyLw4zqQc+t01bkcfjMbRE2DtjpRwmlF6tw5sKnLSi3CzM3iRZl3OhLtv8A1hdcIuH6WFhdiUJupxKXKBJplKTyu++vY3QJaFTuumhdFqSXHpgCMCzSqXrCnYewqgTZqzzZ8nxnSwnuUuLq1UFvvurhLFLmIk6aYzbdvCotoPR/awPXi7bR9Mc06QFvpXkkIBWenT+HtkcEoazbhaw20gOqqtfS3HZUYpNd71sDcp2KhtZge2gqk/AW+NODWLY9r5bZMNszcniS55un0TyEznwTAb9p6T7qWxl8iPv6XSDcnal8ndy2hujGi0UR7VpGsjqQN6L7j81W1revimF3o0AJks3s/PwdFO/R+WlKXQuU/llXnAfAQR3WpNS6ASyqe7DSpGPjz2Czc7TADoAnAFwH4DPANyJsVuYsohOXUQ3M/nogdHI/xGx0cmE66OobnrKkUYDblc67Eih0yGd9rz4Pr8XWhEanEm00FEukXwGcLP4vJKPe2LL5zMz6v4A4Fge8KI/ORsJnWxU6Z44mpHykcdBPB4F3xc9X+L5/2oQW97fHamzI8Me/X5fvVCuQexnvHjogcVqzfUpdII9wOK8+D4GcaVWltabVzp8Q9Sko3Ob4BpDk14m8jETmwNrlI22AJgfIztfMpOlk8t5ePzcxjLLKwAe0nGgfZ72U2ipUK4znhbJvqrDq/zgHsZAmO/QFtM251GyOntmMn7wSPwLPt5KY7Fq7McAAAAASUVORK5CYII="/>
                        </svg>
                        <div class="p-2 mt-3">Elogio</div>
                    </label>
                    <div id="elogio-div" class="bg-blue-person-inactive rounded-0 w-75 ml-3"  style="max-width: 76% !important">Selecionar</div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12 p-5 rounded-0 mt-5 shadow bg-white rounded">
            <form action="{{ route('site.idea.send') }}" method="post" id="form">
                @csrf
                <input type="hidden" id="g_recaptcha_response" name="g_recaptcha_response">
                <div class="form-group mb-5">
                    <div class="d-flex align-items-center text-form"> <span class="fa-stack" style="vertical-align: top;">
                        <i class="far fa-circle fa-stack-2x"></i>
                        <i class="fab fa-telegram-plane fa-stack-1x"></i>
                        </span>&nbsp;&nbsp;&nbsp; ENVIE SUA MENSAGEM</div>
                </div>
                <div class="form-group">
                    <label for="name"><b>Nome Completo <span id="name-label" style="color: red"></span></b></label>
                    <input type="text" id="name" name="name" class="form-control border-0 rounded-0 bg-light" placeholder="Nome Completo">
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

                    <input type="hidden" id="subject" name="subject" class="form-control border-0 rounded-0 bg-light" placeholder="Assunto">

                <div class="form-group">
                    <label for="content"><b>Mensagem</b></label>
                    <textarea name="content" id="content" class="form-control border-0 rounded-0 bg-light" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn bg-blue-person text-white rounded-pill w-25"><b>Enviar</b></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.16.3/sweetalert2.min.css">
@endsection
@section('js')
<script src="{{ asset('vendor/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{ asset('vendor/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    $(document).ready(function(){
    $('#menu-nav').addClass('bg-blue-person');
    $("input[name='type']:radio").change(function(){
        if($(this).val() == 'reclamacao')
        {
          $("#reclamacao-div").addClass('bg-blue-person-active')
          $("#reclamacao-div").removeClass('bg-blue-person-inactive')
          $("#reclamacao-div").html('Selecionado')

            $("#ideia-div").html('Selecionar')
            $("#ideia-div").addClass('bg-blue-person-inactive')
            $("#ideia-div").removeClass('bg-blue-person-active')

            $("#elogio-div").html('Selecionar')
            $("#elogio-div").addClass('bg-blue-person-inactive')
            $("#elogio-div").removeClass('bg-blue-person-active')

            $("#solicitacao-div").html('Selecionar')
            $("#solicitacao-div").addClass('bg-blue-person-inactive')
            $("#solicitacao-div").removeClass('bg-blue-person-active')

            $('#subject').val('Reclamação')
            $("#name-label").html('não é obrigatório informar.')
        }
        else if($(this).val() == 'solicitacao')
        {
          $("#solicitacao-div").addClass('bg-blue-person-active')
          $("#solicitacao-div").removeClass('bg-blue-person-inactive')
          $("#solicitacao-div").html('Selecionado')

          $("#ideia-div").html('Selecionar')
          $("#ideia-div").addClass('bg-blue-person-inactive')
          $("#ideia-div").removeClass('bg-blue-person-active')

          $("#elogio-div").html('Selecionar')
          $("#elogio-div").addClass('bg-blue-person-inactive')
          $("#elogio-div").removeClass('bg-blue-person-active')

          $("#reclamacao-div").html('Selecionar')
          $("#reclamacao-div").addClass('bg-blue-person-inactive')
          $("#reclamacao-div").removeClass('bg-blue-person-active')
        $("#name-label").html('não é obrigatório informar.')

          $('#subject').val('Solicitação')
        }
        else if($(this).val() == 'ideia')
        {
          $("#ideia-div").addClass('bg-blue-person-active')
          $("#ideia-div").removeClass('bg-blue-person-inactive')
          $("#ideia-div").html('Selecionado')

          $("#elogio-div").html('Selecionar')
          $("#elogio-div").addClass('bg-blue-person-inactive')
          $("#elogio-div").removeClass('bg-blue-person-active')

          $("#solicitacao-div").html('Selecionar')
          $("#solicitacao-div").addClass('bg-blue-person-inactive')
          $("#solicitacao-div").removeClass('bg-blue-person-active')

          $("#reclamacao-div").html('Selecionar')
          $("#reclamacao-div").addClass('bg-blue-person-inactive')
          $("#reclamacao-div").removeClass('bg-blue-person-active')

          $("#name-label").html('')

          $('#subject').val('Idéia')
        }
        else if($(this).val() == 'elogio')
        {
          $("#elogio-div").addClass('bg-blue-person-active')
          $("#elogio-div").removeClass('bg-blue-person-inactive')
          $("#elogio-div").html('Selecionado')

          $("#ideia-div").html('Selecionar')
          $("#ideia-div").addClass('bg-blue-person-inactive')
          $("#ideia-div").removeClass('bg-blue-person-active')

          $("#solicitacao-div").html('Selecionar')
          $("#solicitacao-div").addClass('bg-blue-person-inactive')
          $("#solicitacao-div").removeClass('bg-blue-person-active')

          $("#reclamacao-div").html('Selecionar')
          $("#reclamacao-div").addClass('bg-blue-person-inactive')
          $("#reclamacao-div").removeClass('bg-blue-person-active')

          $("#name-label").html('não é obrigatório informar.')

          $('#subject').val('Elogio')
        }
    });
});

$( "#form" ).validate({
        rules : {
            name : {
                required : function(){
                    return $('#ideia').is(':checked');
                },
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
