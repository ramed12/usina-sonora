<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/site/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/site/carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/site/mydropdown.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css" integrity="sha512-apX8rFN/KxJW8rniQbkvzrshQ3KvyEH+4szT3Sno5svdr6E/CP0QE862yEeLBMUnCqLko8QaugGkzvWS7uNfFQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/svg-with-js.min.css" integrity="sha512-W3ZfgmZ5g1rCPFiCbOb+tn7g7sQWOQCB1AkDqrBG1Yp3iDjY9KYFh/k1AWxrt85LX5BRazEAuv+5DV2YZwghag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/v4-shims.min.css" integrity="sha512-iaLhEHW3p+ZNgkDKBi4zEfH+aWAMGJ7I7njqD3jKnbN0ux4Gkumu2vjuI71YUov20OIPl3R32v8HO+V+6OgbvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/brands.min.js" integrity="sha512-vefaKmSAX3XohXhN50vLfnK12TPIO+4uRpHjXVkX726CqbicEiAQGRzsMTE+EpLkBk4noUcUYu6AQ5af2vfRLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/regular.min.js" integrity="sha512-jR9mIF29jOBsgismrZaiPV9H/VNWOpnILyA4MPEPgJFadfbWT0mQ5MnxCMd+JCYdoTuB2n1SkI00XkELU4ETmg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/solid.min.js" integrity="sha512-Qc+cBMt/4/KXJ1F6nNQahXIsgPygHM4S2XWChoumV8qkpZ9oO+gBDBEpOxgbkQQ/6DlHx6cUxa5nBhEbuiR8xw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/fontawesome.min.js" integrity="sha512-KCwrxBJebca0PPOaHELfqGtqkUlFUCuqCnmtydvBSTnJrBirJ55hRG5xcP4R9Rdx9Fz9IF3Yw6Rx40uhuAHR8Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/v4-shims.min.js" integrity="sha512-1ND726aZWs77iIUxmOoCUGluOmCT9apImcOVOcDCOSVAUxk3ZSJcuGsHoJ+i4wIOhXieZZx6rY9s6i5xEy1RPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LdOIK8cAAAAAMIX8eQnmuP8v1qgIuPZnbxtIj64"></script>

    @yield('css')
    <title>Usina Sonora MS</title>
  </head>
  <body>
    @include('layouts.site.include.menu')
    {{-- @include('layouts.site.include.carousel') --}}
    <div class="w-100 drk sr-only">
        <img src="{{ asset('assets/image/shutterstock_1707249778.png')}}" class="img-fluid" alt="">
    </div>

<main>
        @yield('content')

</main>
<footer class="bg-blue-person" style="padding-top: 6.625em;padding-bottom: 6.625em">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-12 col-xs-12">
                {!! img('logo/logo-usina-sonora-white-striped-2.png', 379, 100, true, true) !!}
             </div>
            <div class="col-md-7 col-sm-12 col-lg-7 col-xl-7 col-xs-12 text-md-left text-xl-left text-lg-left text-center">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 offset-md-3 offset-lg-3 offset-xl-3 text-white">
                        <address>
                            <i>{{ $matriz->name }}</i><br/>
                            <?php echo $matriz->address ?><br/>
                            {{ $matriz->phone }} @if(!empty($filial->fax)) / {{ $matriz->fax }} @endif
                        </address>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xl-5 col-sm-12 col-xs-12 text-white">
                        <address>
                            <i>{{ $filial->name }}</i><br/>
                            <?php echo $filial->address ?><br/>
                            {{ $filial->phone }} @if(!empty($filial->fax)) / {{ $filial->fax }} @endif
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
        <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/main.js')}}"></script>
        <script src="{{ asset('assets/js/val.js')}}"></script>
    @yield('js')
    <script>
    $('#carouselExampleCaptions').carousel({
        interval: 10000
    });
    $('#carouselNews').carousel({
        interval: 4000
    });

    var get_width_img = $(this).width();


$(document).ready(function() {
    /* 
    $('#menu-nav').addClass('bg-blue-person');
    
    if(window.location.pathname == "/"){
         
         if( $(this).scrollTop() == 0){
             $('#menu-nav').removeClass('bg-blue-person');
             $('#menu-nav').addClass('p-4');
             $('#menu-nav').removeClass('p-3');
     
             if(get_width_img <= 720 ){ 
             $('#arrow1').addClass('sr-only');
             $('#arrow2').addClass('sr-only');
             $('#arrow3').addClass('sr-only');
         }else{
             $('#arrow1').removeClass('sr-only');
             $('#arrow2').removeClass('sr-only');
             $('#arrow3').removeClass('sr-only');
     
         }
         }else{
             $('#menu-nav').addClass('bg-blue-person');
             $('#menu-nav').removeClass('p-4');
             $('#menu-nav').addClass('p-3');
         }  
     $(window).bind('scroll load', function(){
       // Add class after x distance from top
     if( $(this).scrollTop() >= 100 ) {
       $('#menu-nav').addClass('bg-blue-person');
       $('#menu-nav').removeClass('p-4');
       $('#menu-nav').addClass('p-3');
     } else {
       $('#menu-nav').removeClass('bg-blue-person');
       $('#menu-nav').addClass('p-4');
       $('#menu-nav').removeClass('p-3');
     } 
     });
      
         }else{
     
         } */
         
  //Exibe o título com o elemento active inicial
  setTituloActive();

  $('#carouselExampleCaptions').bind('slid.bs.carousel', function() {
    //atualiza o valor com o item ativo no momento.
    setTituloActive();
  });
});
function setTituloActive() {
  var elemento = $('#carouselExampleCaptions div.active');
  var select = $('div', elemento).attr('data-id'); 

  $('#alterar').text(select);
}



    </script>
   <div id="lgpd" class="container fixed-bottom <?php if(isset($_COOKIE['lgpd'])){ echo 'sr-only'; } ?>" style="margin-bottom: 15px">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 p-3 col-xs-12 bg-light shadow-lg">
            <div class="row">
               <div class="col-md-9 col-xs-9 ml-5">Nós usamos cookies e outras tecnologias semelhantes para mehorar a sua experiência em nossos serviços. Ao utilizar nosso site, você concorda com tal monitoramento. Para mais informações, consulta nossa <b><a href="{{ route('site.politic-privacy') }}#inicial" target="__blank">Política de Privacidade.</a></b></div>
               <button onclick="closeLGPD()" class="btn bg-blue-person text-white rounded-0"><b>ACEITAR & FECHAR</b></button>
            </div>
        </div>

    </div>
</div>
    </body>

</html>
