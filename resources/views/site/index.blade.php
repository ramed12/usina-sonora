@extends('layouts.site.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
<div class="container" style="margin-top: 5em">
    <div class="row">
        <div class="col-md-7 col-lg-7 col-xl-7 col-xs-12 col-sm-12" >
            <div id="carouselNews" class="carousel slide carousel-fade"  data-ride="carousel">
 
                <ol class="carousel-indicators d-md-none position-absolute" style="z-index:50;top:8.5em;left:10em">
                    @for ($a = 0; $a < count($news); $a++)
                      <li data-target="#carouselNews" data-slide-to="{{ $a }}" @if($a  === 0) class="active" @endif></li>
                    @endfor
                </ol>
                <div class="carousel-inner">

                    @php
                        $i = 0;
                    @endphp
            @foreach ($news as $item)
                <div class="carousel-item drk  @if($i == 0) active @endif">
                 @php
                    $arr = explode("-", $item->date);
                @endphp
                <a class="news-link" href="{{ route('site.news.detail',["id" => $item->id, "slug" => $item->slug]) }}">
                    {!! img('news/'.$arr[0].'/'.$arr[1].'/'.$arr[2].'/'.$item->id.'/'.$item->image, 675, 353, true, true,array("alt" => $item->name)) !!}
                    <div class="carousel-caption text-call-news">
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xs-12 col-sm-12">
                        <div class="ml-md-5 ml-lg-5 ml-xl-5 title-call">ÚLTIMAS NOTÍCIAS</div>
                        <div class="ml-md-5 ml-lg-5 ml-xl-5 title-news">{{ $item->title }}</div>
                        </div>
                    </div>
                </a>
                </div>
                @php
                    $i++;
                @endphp
             @endforeach                
                </div>
                <a href="#carouselNews" class="carousel-news-prev Circle_BG2 d-none d-sm-block" data-slide="prev"><i class="fas fa-1x text-white fa-angle-right mx-auto mt-3" ></i></a>
                <a href="#carouselNews" class="carousel-news-next Circle_BG2 d-none d-sm-block" data-slide="next"><i class="fas  fa-1x text-white fa-angle-left mx-auto mt-3"></i></a>

                <a href="{{ route('site.news.list') }}" class="position-relative badge badge-pill badge-dark list-news"><i style="font-size:font-size:0.836em;font-family:'Poppins', sans-serif !important">Ver todas notícias</i></a>
            </div>
        </div>
        <div class="col-md-5 col-xl-5 col-lg-5 col-xs-12 col-sm-12">
            <a href="{{ route('site.video.list') }}" class="news-link">
            <div class="bg-blue-person">
             <div class="row align-items-center">
                 <div class="col-md-8 col-lg-8 col-xl-8 col-sm-8">
                     <div class="cover">
                        {!! img('fundo-video-2.jpg', 600, 697, true, true,array('class' => 'd-none d-sm-block')) !!}
                        {!! img('fundo-video-2.jpg', 400, 400, true, true,array('class' => 'd-block d-sm-none')) !!}
                        <div class="video-text">
                            <div class="video-text-title">Vídeo</div>
                            <div class="video-text-subtitle">Nossa Usina</div>
                            <div class="video-text-play">Play &nbsp;<i class="fas fa-chevron-right"></i></div>
                            <hr class="video-line">
                        </div>
                     </div>
                 </div>
                 <div class="col-md-4 col lg-4 col-xl-4 col-sm-4 ml-5 ml-md-0 ml-lg-0 ml-xl-0 p-2 p-md-0 p-lg-0 p-xl-0">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="92" height="67" viewBox="0 0 100 74">
                                <image id="Objeto_Inteligente_de_Vetor_copiar" data-name="Objeto Inteligente de Vetor copiar" width="92" height="67" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABKCAYAAABNRPESAAAFP0lEQVR4nO2dSawURRjHfzM8EEXRCAo6iigIRvTgEre4a1DxIDFeRI1rYkQPxot68eDNxKAXDSbGg0s8GOK+PMCFYDDuMbiGp9GExxPEIEpQ4oM2X/wa26L7TXd11+utfkkdpmfmq6/q37VMVc3XnSAIULrA9cBtwOnA/vzHCDAIPAR8i8cZoSAHAy8CF/XJaDdwJ/CEl8QNIoi0jJXAJRlyuAZYUaeC1gURZAnwXEZ/fwaOA/5sb9W5oatjRhSp5HuBS7ULWwy8bHxmJnBFA8pfOaSF7ACmRBy7B3jEcHQA+BKYH7kmA/x9LawzpwwYYghrYzIcBT42BLkWOKFk/8WvLcBnwKvA5pL9yc1AjIHRBKO7jdezNFWFv3X29wCwrUJ+ZaJbI1/7MRG4S1vL3Gq7mkyTBAmZDbxXV1Hiuqy0fA+8P77u7kNHx7EzjDd6KsqFwFDJPmYijyAixk0l+BzHOcALwJGR90JRLtCbpxY0pctapxU/bFzv6RrcUSX5lZkmjSFD2kWZoszRllILUZo2qNdelCbOskSUy4GtxvVaiNJEQdBlnosTRFkFHFaSX31pqiDC+gRRZJr8DjCjJL/GpMmCMIYoJwGfADcAh5bkWyx5BLkRCEpKP2bwU0RZCPxuXJex5GngV4syyBbFBuBJ4PwcdbgPTW8hIZ8niGLLZF2auRVYA7wGHFGE4bYIInwInOvoV/uVwEfAsXkNtUkQtPtaoJtwRZ+ekS7wFWBSHiNxa1lJg9xBxmtZklgeeX2msYO4E7guj3NjsDPHd3fpjqikozUdntHGfjp23KLdV4hMFpYCj1p7FwTBxuD/rAiCYIIcD4qkebLVa3zufuMzi433fzPeb2JaEATBZqPcUp8d27JKl/WWodHVwDfAS5oGddPH3OodtL4LmsNXwB1GaWRB81TbEkqX9bBOYaPd1/GaklipInn+vWll6jwtUhfzgE9t6qarg9vdGb4jC3c3eyH2sgfYaFzLOibtJZxlPQYsiflFayJLDmcBm2wzbAkd22JGu6nn9QfOVdoHhrOtUb0DZMz4oO017Rpz2vsH8KwmTwUE8bhjVprZlxdkfJirm2O9frm1bemkDFKLgRfEObOziIEXxCmy2Lg6ixh4QZxxiLaMOUYGw7oC0tF0iumAH9TdIP/DnG5YHklztNW3EDeYYsgKyGVpzhl7QdyzVQ9arE+TkxekGJLqMZMYeEEKY0+Mocxi4AVxxl/Aoqxi4AVxxnL9k2xmvCBu+MnWqhekYnhBKoYXpGJ4QSqGF8QN1gevvSBukMXFk20se0HcMEWPTGUWxQtSDHH1ON1GFC9IMcStZaGirMoSd8UL4p4ZWYLheEHcYB7J7aUVxQvihscT4q70FcXvqbthm+6fm0eAevqfkjCa6wQzd99C3JEUd2WSBq6WdKCZe1kt5A0jtpUtcjj8vHKKkIqhhJaSSFmCnAgcU4Cd7QXYcE0oyro0MVb8GDI+DGlLPrtfbl6Q8eM7TWNSliAPAlMLsLOrABuVoixBnqpofZROkdNe826dWKN6qAxFCjJivD6gqkHCCqYbM6XdYptFkYL8EBM3vg3/Z18Uc7h6g62x6DOoimC18aSe8ATfu0VmUiHm64++mRGXRrTFWFVs0YP6MkOQybofIJHb3gR+KTi/spiqgZtvj4kBs8xWDBy0EOF1bRVt5Gt9wp31o6BcLC5KiI4vHNitOsMaBSPXc7lcCLJdlwmecWC7qrytyyK5n8TgosuKcpoGilyokdtyhb+rEPK0IQnAIwEw5caTcFX5Af4BtqBLRr2D6j4AAAAASUVORK5CYII="/>
                            </svg>
                        </div>
                        <div class="video-text-icon-title">Ver <br/>galeria<br/> de Vídeos</div>
                 </div>
             </div>
            </div>
        </a>
        </div>
    </div>
    <div class="row sr-only" style="margin-top: 3.375em">
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12">
            <div class="bg-blue-person">
                <div class="button-work">
                    <a href="{{ route('site.work') }}">
                        {{-- <a href="http://portalrm.usinasonora-ms.com.br:8080/RM//Rhu-BancoTalentos/#/RM/Rhu-BancoTalentos/home" target="_blank"> --}}
                    <i class="btn-description">Trabalhe Conosco</i>&nbsp;&nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="54" height="46" viewBox="0 0 54 46">
                        <image id="Objeto_Inteligente_de_Vetor" data-name="Objeto Inteligente de Vetor" width="54" height="46" xlink:href="data:img/png;base64,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"/>
                    </svg>
                </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12">
            <div class="bg-blue-person">
                <div class="button-work">
                    <a href="{{ route('site.idea') }}">
                    <i class="btn-description">Caixa de Idéias</i>&nbsp;&nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="49" height="46" viewBox="0 0 49 46">
                        <image id="Objeto_Inteligente_de_Vetor" data-name="Objeto Inteligente de Vetor" width="49" height="46" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAA8CAYAAAAgwDn8AAAFhElEQVRogc1aW2wWVRD+Si+00pRC1dgWUJCACNaiog94iQovxNDyoIkPqPGBRMWkVR9MvAUTY4LREI2YGC8QbTSpiT4YI5eEYNoHIohILRpBDd7QIgjVUijlM0O/jcvm7+7Z3bPESSbn/8/OzDdzzp45ty0jiQJpq0wvKQqiokjvAcwu2D4mFA1QNLkGUAngQQDN58GnZmFVOknbGHDgVo7RJkf5gH8Up9HZJKxWF/k0hrfJcFuBAbQJY5urTpoAWkieJnmA5MQCApgo24ZxlatfaQbxVwBeBzALQKejTq/YhTpl2zD2ujqVdh6YCmC/BthcAL+mUY6hJgDfAhhR6j3iqpg2jZrhJwHUAnjMk/OQrVrZdnYeGScy6+IZADYnyNWpx4z+Eo9HHwM4JdupyOdSYhGANgC3AGhRAGEaBNAHYDuAjwDs8AGaNwB7Be8G8DiABaobBbAPwIFQq0/RAJ0HoFx1JrMWwLsATmf2gORGki+QrE854VxDcqfytqW+buXx2hgde9ZO8gPpGO0heX1K7Hr5vNH+9MvQAMkHSFY4GFhN8qT0ukjOSumA8WyS78nGCMlOB50K+TggvX6rrCH5BMm/VbmX5NIYI2tDAS9zAL2I5FySVeM8NxuHZXMdybJx5JbKN8pX87kmLNBEcgPJMxL6sAToGj37juRMx5beIZ1hkptJrixh13pwv+Seizyrki+Ubxvk69nnpQCvI9lD8h+SDaH6FTJiS4NpKV4Va+E3SO7mf/Q9yeURObN5UBJ3heob5EuPfDvHfhxwZej3xSSPkDxB8uoM73u4pV8meUqOvkRyQuh5q3rqGMnGcXxxDiDMbwnwkRzOh9kWhvtk8+3Ie/+o6t9xseUCdrlSXr9jhnLlqSS/KNEwhvENyVFlqtwBBFnnXo/OB9yobDYceWXuF+aLPgL4We9kTQEBGN9O8k2S1aE6wzpO8peYtOoUwDy1RHdBzsdxt7AXxMklLacXqdyeea2SnQLMa+MsJAVwhcr+gp21levByE4vwJwTp5gUQL3KP/L5l0i2mZkO4IaQYIA5JU45KYBqlcPF+X6O/epQ3QmVNXGKSQEcVxndnPimC2XvcMhu0PtxO7nEAH5TOaPgAKyhDkV2adNUHopTTNoTf62yVdvAosicbIzYXqiyLw4zqQc+t01bkcfjMbRE2DtjpRwmlF6tw5sKnLSi3CzM3iRZl3OhLtv8A1hdcIuH6WFhdiUJupxKXKBJplKTyu++vY3QJaFTuumhdFqSXHpgCMCzSqXrCnYewqgTZqzzZ8nxnSwnuUuLq1UFvvurhLFLmIk6aYzbdvCotoPR/awPXi7bR9Mc06QFvpXkkIBWenT+HtkcEoazbhaw20gOqqtfS3HZUYpNd71sDcp2KhtZge2gqk/AW+NODWLY9r5bZMNszcniS55un0TyEznwTAb9p6T7qWxl8iPv6XSDcnal8ndy2hujGi0UR7VpGsjqQN6L7j81W1revimF3o0AJks3s/PwdFO/R+WlKXQuU/llXnAfAQR3WpNS6ASyqe7DSpGPjz2Czc7TADoAnAFwH4DPANyJsVuYsohOXUQ3M/nogdHI/xGx0cmE66OobnrKkUYDblc67Eih0yGd9rz4Pr8XWhEanEm00FEukXwGcLP4vJKPe2LL5zMz6v4A4Fge8KI/ORsJnWxU6Z44mpHykcdBPB4F3xc9X+L5/2oQW97fHamzI8Me/X5fvVCuQexnvHjogcVqzfUpdII9wOK8+D4GcaVWltabVzp8Q9Sko3Ob4BpDk14m8jETmwNrlI22AJgfIztfMpOlk8t5ePzcxjLLKwAe0nGgfZ72U2ipUK4znhbJvqrDq/zgHsZAmO/QFtM251GyOntmMn7wSPwLPt5KY7Fq7McAAAAASUVORK5CYII="/>
                      </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12">
            <div class="bg-blue-person">
                <div class="button-work">
                    <a href="{{ route('site.contact') }}">
                    <i class="btn-description">Contato</i>&nbsp;&nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="46" viewBox="0 0 40 46">
                        <image id="Objeto_Inteligente_de_Vetor" data-name="Objeto Inteligente de Vetor" width="40" height="46" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAsCAYAAAAacYo8AAAEXUlEQVRYhc2ZT2gdVRTGf8/31FRt1VCysbQgQqGFNhhsWqMVEhBSVKqrVGrVWsWFtnVlFy4EF1FEEaxRSGiptrgpVgSzCKmShX8ixGqDXWRRRKVarH8aLNY2ySc3flOek5mX92feSz44MG/Oued8c+bcO/eeh6SsZb2kIUlTlnC9Lus4V5EtngRGgXXAq5Zw/RWwK9NIGWXgBkmH9R8GJTUX6Zp9L+CwbWuOmQXptZK+c1nsk5RLsMlZN2XbtQtN/FFJFySdkbS5DPt7bBvG7KgX8YKklySdVeNx1rELafwKJcr/NWA3cBT4EpiO6ZcBq4ExYKbCqRUWhduBCWAypssDG4EXHGNPJZNzqaTLkvoymrzVSJ85LE0am7YcroLZt3G8wkxmiePmsCrtlSUhKqF4eTQSUezEcs76A9QwpE3O6P41KfpXgPaMSIYv7fMJ96PYiRyTbq4EDvh6RUqw34E/q+OZ6CsJUezA5T7gh//ZxGZrt6TfJE165d66gKvKVnOYNKfupFUlrJ0vA4PA98C2jLKZBbaZ06A55qOMh6/TR366/ZKuldS6iDLeak77/TtwLYQaHwDu95Z0YBFluhj/AM8A3wD9gWcg3m2DJ4ChOZMgGc8CbRmRCluGN8uwW2mOAd2BeAvwLvAA8DXwCPDzPE5uA1ozIB1wvgybkNz3XN+B6w5cN3sl3SppzL8PLKIaj7iMmWPgquIv52ngTqAPeNz3mjPKajWIYgcub5nb6St+ijJe/LRPS5rx+tm1ANnucuwZcynWzcl4Md7xXvuMJ+yLV9bP+iLvWEOOvdpc5iIl45EskTRgm9BmaKljllscQ465JMWuZMYj/O22wmNAh9fRu+uQ88323eFYuxw7FeVuaw8BG7yx+hTYB+QyIJyzr0+APxzjUFkj5ymVuBT3Tz6O9U8qlWr7LWWVShx/AduBp4Auv95NVWR6k8d22td2+y4b1Z6A+n0SD3uIEWBvmaWTs+2Ix260r8pRYanEJZzAj9rHiKRbStiusI08JvH0Xm6p1Eo8Iv+F/fwqqS3Bps062bZa0lXXeBx3ASeBO/zKLwCfuxwKlud8L+j6bXvSY6tHlRm/WlKvpGlJE5I2+P7Nkj60z4uWgGPWYdsJj+21r4aUyhpJJzzubUnXJdjca1K9vo7rr/dY2deaehIPreI9zuIvkrbUUKeRbLGvi/ad1KKuiXhYLYZt+4Gk5RmQjmS5fcoxSq1MFU3OHmDcn+OdwEPAuRondTHO2edOxxh3zJIoRfwm4AjwPnAKWA8czJBwHAcd45RjHjGHZKSUSqekHyVd8l8g+QxLYz7JO+Ylc+hMK5XLbqAHNAGvA8NuuLe7CdPIru20Y7abw7A5NVm/bJazpFEfREPjZdxv4A1JTQ3Mcpo0mYvMrdVcR4Oyx4rwj9hPC3TGnE+6zG3KXHtm103gM5+ivwWOldnraCRuBB705A3bh47iJ33YZRMmxWJD4BS4BY5I4l9ZACOjDln8uAAAAABJRU5ErkJggg=="/>
                      </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row margin-mobile-only-top">
        <div class="col-md-12 col-xs-12 col-lg-12 col-xl-12 col-sm-12">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                width="100%" height="2px">
                <path fill-rule="evenodd"  fill="rgb(16, 49, 133)"
                d="M-0.000,-0.000 L1171.000,-0.000 L1171.000,-0.000 L1171.000,2.001 L1171.000,2.001 L-0.000,2.001 L-0.000,2.001 L-0.000,-0.000 L-0.000,-0.000 Z"/>
                </svg>
        </div>
    </div>
    <div class="row margin-mobile">
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 text-right" style="padding: 7% 2% 7% 1%">
            <span class="text-certificate">Certificações</span>
        </div>
        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12 col-xs-12 text-center">
            <div class="row">
                @foreach ($certificates as $certificate)
		<div class="p-1">
                {!! img('gallery/certificate/'.$certificate->path, 240, 120, true, true) !!}
		</div>
                @endforeach
              </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    
$(document).ready(function() {   
    $(window).bind('scroll load', function(){
       // Add class after x distance from top
     if( $(this).scrollTop() >= 720 ) {
       $('#menu-nav').addClass('bg-blue-person');
       $('#menu-nav').removeClass('p-4');
       $('#menu-nav').addClass('p-3');
     } else {
       $('#menu-nav').removeClass('bg-blue-person');
       $('#menu-nav').addClass('p-4');
       $('#menu-nav').removeClass('p-3');
     }  
}); 
});
    $('.certificate-badge').slick({

    infinite: true,
  speed: 300,
  slidesToShow: 1,
  centerMode: true,
  variableWidth: true,
  prevArrow :$("#slick_prev"),
  nextArrow :$("#slick_next")
});
</script>
@endsection
