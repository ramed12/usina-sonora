@extends('adminlte::page')
@section('content_header')
<div class="row">
    <div class="col-md-8 col-xs-8">
        <h1> {{ $page }} </h1>
    </div>
    <div class="col-md-4 col-xs-4">
        <ol class="breadcrumb m-1">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('') }}">Listar {{ $page }}</a></li>
        <li class="breadcrumb-item active">{{ $action }} {{ $page }}</li>
        </ol>
    </div>
</div>
@stop
@section('content')
<div class="card card-outline card-warning">
    <div class="card-header">
        <div class="col-md-12 col-xs-12">
            <a href="javascript:window.history.back()" class="card-link"><i class="fas fa-long-arrow-alt-left"></i> Voltar</a>
        </div>
    </div>
    <div class="card-body">
        <form role="form" id="form" method="POST" action="{{ route( $route ) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="@if(!empty($data->id)) {{ $data->id }} @endif">
            <input type="hidden" name="imageOld" value="@if(!empty($data->image)) {{ $data->image }} @endif">
            <input type="hidden" name="fileOld" value="@if(!empty($data->file)) {{ $data->file }} @endif">
            <input type="hidden" name="tag" value="@if(!empty($data->tag)) {{ $data->tag }} @else {{ $tag }} @endif">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="@if(!empty($data->name)) {{ $data->name }} @endif">
            </div>
            @if(!empty($menu))
            <div class="form-group">
                <label for="menu">Item pai</label>
                <select name="menu_id" id="menu_id" class="form-control">
                    @foreach ($menu as $item)
                    @if(!empty($data->tag))
                        @if($data->tag === $item->url)
                            <option value="{{ $item->id}}" selected> {{$item->name}}</option>
                        @else
                            <option value="{{ $item->id}}"> {{$item->name}}</option>
                        @endif
                    @else 
                        @if($tag === $item->url)
                         <option value="{{ $item->id}}" selected> {{$item->name}}</option>
                        @else
                            <option value="{{ $item->id}}"> {{$item->name}}</option>
                        @endif
                    @endif
                    @endforeach

                </select>
            </div>
            @endif
            <div class="form-group">
                <label for="position">Posição</label>
                <select name="position" id="position" class="form-control">
                    @for ($i = 0; $i < 100; $i++)
                    @if(!empty($data->position))
                        @if($i === $data->position)
                            <option value="{{ $i }}" selected> {{ $i }}</option>
                        @else
                            <option value="{{ $i }}"> {{ $i }}</option>
                        @endif
                    @else  
                            <option value="{{ $i }}"> {{ $i }}</option> 
                    @endif
                    @endfor

                </select>
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
                <textarea name="content" id="content" class="form-control" cols="30" rows="10">@if(!empty($data->content)) {{ $data->content }} @endif</textarea>
            </div> 
            <div class="form-group">
                <label for="file">Arquivo</label>
                <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input"  id="document" name="document" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01">Selecione o arquivo</label>
                    </div>
                  </div>
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
<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
    $(document).ready(function(){
  CKEDITOR.replace( 'content' );

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
<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
@endsection
