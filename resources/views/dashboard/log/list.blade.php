@extends('adminlte::page')
@section('content_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-md-8 col-xs-8">
        <h1> Log do Investidor </h1>
    </div>
    <div class="col-md-4 col-xs-4">
        <ol class="breadcrumb m-1">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">Listar Log do Investidor</li>
        </ol>
    </div>
</div>
@stop
@section('content')
<div class="card card-outline card-primary">
      <div class="card-body table-responsive no-padding"> 
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" width="5%">#</th>
                    <th scope="col">IP</th>
                    <th scope="col">Nome do Usuário</th>
                    <th scope="col">Página</th> 
                    <th scope="col">Data</th>  
                </tr>
            </thead>
            @if(count($data) > 0)
            @foreach ($data as $item)
                <tbody>
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->ip }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->page }}</td>  
                        <td>{!! date('d/m/Y H:i:s',strtotime($item->created_at)) !!}</td>  
                    </tr>
                </tbody>
            @endforeach
            @else
            <tbody>
                <tr>
                    <td colspan="4"><center>Não possui registro.</center></td>
                </tr>
            </tbody>
            @endif
        </table>
    </div>
</div>

@endsection
@section('footer')
    <center><b>Todos os direitos a Usina Sonora MS - {{ \Carbon\Carbon::now()->format('Y') }}</b></center>
@endsection
@section('js')
<script src="{{ asset('assets/js/logic-delete.js') }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
@endsection
