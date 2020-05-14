<header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top text-center bg-blue-person-mobile p-4" id="menu-nav">
    <div class="container-fluid">
            <div class="row"> 
            <div class="col-12 col-md-3 col-lg-3 col-xl-3">        
                <div class="row">
                    <div class="col-9 col-md-12 col-lg-12 col-xl-12">
                        <a class="navbar-brand text-md-left text-lg-left text-lx-left" href="{{ route('site.home') }}">
                            <img src="{{ url('storage/logo/logo-white.png') }}" class="mr-md-4 mr-lg-4 mr-xl-4 image-logo">
                        </a>
                    </div>
                    <div class="col-2">
                        
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button> 
                    </div>
                </div>
            
        </div>
        <div class="col-md-9 col-lg-9 col-xl-9 col-12">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">

                @foreach($menu as $item)
                        <li class="nav-item dropdown pl-md-2 pl-lg-2 pl-xl-2 pr-lg-2 pr-xl-2 pr-md-2 text-center">
                            <a class="nav-link dropdown-toggle" href="#" id="factory" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $item->name }}<br/><i id="arrow1" class="fas fa-fw fa-angle-down" style="font-size: .780em"></i></a>
                                <div class="dropdown-menu" aria-labelledby="{{ $item->url }}">
                                @foreach($submenu as $data)
                                    @if($item->url == $data->tag)
                                    @php
                                     $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ' );

                                    // matriz de saída
                                    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','-' );

                                        $name = strtolower($item->name);
                                        $url = strtolower(str_replace($what,$by,$data->name));
                                    @endphp
                                    <a class="dropdown-item text-center text-md-left text-lg-left text-xl-left" href="{{ urL('/'.$name.'/'.$data->id.'/'.$url) }}#inicio">{{ $data->name }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </li>
                        @endforeach

                <li class="nav-item pl-md-2 pl-lg-2 pl-xl-2 pr-lg-2 pr-xl-2 pr-md-2 ">
                    <a class="nav-link" href="{{ route('site.investor') }}#inicio">Investidor</a>
                </li>
                <li class="nav-item pl-md-2 pl-lg-2 pl-xl-2 pr-lg-2 pr-xl-2 pr-md-2 ">
                    <a class="nav-link" href="{{ route('site.idea') }}#inicio">Caixa de Idéias</a>
                </li>

                
                <li class="nav-item pl-md-2 pl-lg-2 pl-xl-2 pr-lg-2 pr-xl-2 pr-md-2 ">
                    <a class="nav-link" href="{{ route('site.work') }}">Trabalhe Conosco</a>
                </li>
                <li class="nav-item pl-md-2 pl-lg-2 pl-xl-2 pr-lg-2 pr-xl-2 pr-md-2 ">
                    <a class="nav-link" href="{{ route('site.contact') }}#inicio">Contato</a>
                </li>

                
            </ul>
        </div>
        </div>
    </div>
    </div>
    </nav>
</header>
