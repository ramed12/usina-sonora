<div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators d-md-none">
        @for ($i = 0; $i < count($carousel); $i++)
          <li data-target="#carouselExampleCaptions" data-slide-to="{{ $i }}" @if($i  === 0) class="active" @endif></li>
        @endfor
    </ol>
    @php
        $y = 1;
        $z = 0;
    @endphp
        <div class="carousel-inner">
        @foreach ( $carousel as $item )
          <div class="carousel-item drk  @if($z  === 0) active @endif">
            <div data-id="{{ $y }}"></div>
          @if($item->type == 'jpg' || $item->type == 'png' || $item->type == 'gif' || $item->type == 'webp')
          {!! img('gallery/carousel/'.$item->path, 1900, 1200, true, true,array("alt" => $item->name, "class" =>'d-none d-sm-block')) !!}
          {!! img('gallery/carousel/'.$item->path, 1280, 800, true, true,array("alt" => $item->name, "class" =>'d-md-none d-xl-none d-lg-none')) !!}
          @elseif($item->type == 'youtube')
          <div class="embed-responsive embed-responsive-16by9">
            <div id="player" class="embed-responsive-item"></div>
          </div>
          @php
            $explode = explode('https://www.youtube.com/embed/',$item->path); 
            $id = $explode[1];   
          @endphp
<script>
     var tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/iframe_api";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                    var player;
  function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
         width: '100%',
      videoId: '{{ $id }}',
      playerVars: {   
            'autoplay': 1,   
            'rel': 0,
            'showinfo': 0,
            'modestbranding': 1,
            'playsinline': 1, 
            'playlist': '{{ $id }}',
            'rel': 0,
            'controls': 0,
            'color':'white',
            'loop': 1,
            'mute':1,
            'disablekb': 1
      },
      events: {
        'onReady': onPlayerReady,
        // 'onStateChange': onPlayerStateChange
      }
    });
  }
  function onPlayerReady(event) {
    player.playVideo();
    player.mute();
  }var done = false;
  function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING && !done) {
      setTimeout(stopVideo, 10000);
      done = true;
    }
  }
  function stopVideo() {
    player.stopVideo();
  }
</script>
            @elseif($item->type == 'mp4')
            <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item" height="800" id="video-carousel" loop autoplay muted>
              <source src="{{ url('storage/gallery/carousel/'.$item->path) }}" type="video/mp4"> 
            Your browser does not support the video tag.
            </video>
            </div> 
            @endif
            <div class="carousel-caption-person">
                <?php echo $item->description; ?>
            </div>

          </div>
    @php
        $y++;
        $z++;
    @endphp
        @endforeach
        </div>
        <a href="#carouselExampleCaptions" class="carousel-news-prev-2 Circle_BG d-none d-sm-block" data-slide="prev"><i class="fas fa-1x text-white fa-angle-left mx-auto mt-3" ></i></a>
        <i class="count-carousel-princ d-none d-sm-block"> <i id="alterar">&nbsp;</i>/{{ count($carousel) }}</i>
        <a href="#carouselExampleCaptions" class="carousel-news-next-2 Circle_BG d-none d-sm-block" data-slide="next"><i class="fas  fa-1x text-white fa-angle-right mx-auto mt-3"></i></a>
         <div class="w-25 text-white position-absolute  d-none d-sm-block" style="top:94%;left:70%;z-index:4">
            <b>Conecte-se</b>   <i style="vertical-align: super" class="ml-3 mr-3">_____________</i>
            @if(!empty($facebook))<a href="{{ $facebook }}" class="text-white"  target="_blank"><i class="fab mr-2 fa-facebook-f"></i></a>@endif
            @if(!empty($twitter))<a href="{{ $twitter }}" class="text-white" target="_blank" ><i class="fab mr-2 fa-twitter"></i></a>@endif
            @if(!empty($linkedin))<a href="{{ $linkedin }}" class="text-white" target="_blank"><i class="fab mr-2 fa-linkedin-in"></i></a>@endif
            @if(!empty($instagram))<a href="{{ $instagram }}" class="text-white" target="_blank"><i class="fab mr-2 fa-instagram"></i></a>@endif
            @if(!empty($googleplus))<a href="{{ $googleplus }}" class="text-white" target="_blank"><i class="fab fa-google-plus-g"></i></a>@endif
        </div>
    </div>
