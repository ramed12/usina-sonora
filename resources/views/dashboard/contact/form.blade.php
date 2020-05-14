@extends('adminlte::page')
@section('content_header')
<div class="row">
    <div class="col-md-8 col-xs-8">
        <h1> Contato
        </h1>
    </div>
    <div class="col-md-4 col-xs-4">
        <ol class="breadcrumb m-1">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('contact') }}">Listar Contatos</a></li>
          <li class="breadcrumb-item active">{{ $action }} Contato</li>
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
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" class="form-control @error('email')  is-invalid @enderror" value="@if(!empty($data->email)){{ $data->email }}@endif">
                @error('email')
                <span class="error invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="phone">Telefone</label>
                <input type="text" name="phone" id="phone" class="form-control @error('phone')  is-invalid @enderror" value="@if(!empty($data->phone)){{ $data->phone }}@endif">
                @error('phone')
                <span class="error invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="subject">Assunto</label>
                <input type="text" name="subject" id="subject" class="form-control @error('subject')  is-invalid @enderror" value="@if(!empty($data->subject)){{ $data->subject }}@endif">
                @error('subject')
                <span class="error invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="departament">Departamento</label>
                <select name="departament" class="form-control" id="departament">
                    @foreach ($departament as $item)

                        @if($item->id === $data->departament_id)
                            <option value="{{ $item->id }}" selected>{{ $item->name}}</option>
                        @else
                        <option value="{{ $item->id }}">{{ $item->name}}</option>
                        @endif
                    @endforeach
                </select>
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
                <button type="submit" class="btn btn-primary btn-block"><i class="{{ $icon }}"></i> {{ $action }}</button>
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
