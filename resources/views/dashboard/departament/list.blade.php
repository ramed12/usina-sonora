@extends('adminlte::page')
@section('content_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-md-8 col-xs-8">
        <h1> Departamento </h1>
    </div>
    <div class="col-md-4 col-xs-4">
        <ol class="breadcrumb m-1">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">Listar  Departamentos</li>
        </ol>
    </div>
</div>
@stop
@section('content')
<div class="card card-outline card-primary">
    <div class="card-body table-responsive no-padding">
        <div class="row">
            <div class="col-md-12 col-xs-12 text-right mb-2">
                <a href="{{ route('departament.add') }}" class="btn btn-primary" style="border-radius: 0px !important"><i class="fas fa-plus-circle"></i> Adicionar</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" width="5%">#</th>
                    <th scope="col">Departamento </th>
                    <th scope="col">E-mail </th>
                    <th scope="col" width="5%">Status</th>
                    <th scope="col" width="5%" align="center" colspan="2"><center>Ações</center></th>
                </tr>
            </thead>
            @if(count($data) > 0)
            @foreach ($data as $item)
                <tbody>
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td align="center">
                                <span id="status_active_{{ $item->id }}" class="badge badge-success @if($item->status != 1) sr-only @endif">Ativo</span>
                                <span id="status_inactive_{{ $item->id }}" class="badge badge-danger @if($item->status != 0) sr-only @endif">Inativo</span>
                        </td>
                        <td>
                            <a href="{{ route('departament.edit',$item->id) }}" class="btn btn-info"><i class="far fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="javascript:void(0)" id="button_del_{{ $item->id }}" onclick="deleteRegister({{ $item->id }},{{ $item->status }},'{{ route('departament.send.del',$item->id) }}')" class="btn btn-danger @if($item->status == 0)disabled @endif"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
            @else
            <tbody>
                <tr>
                    <td colspan="6"><center>Não possui registro.</center></td>
                </tr>
            </tbody>
            @endif
        </table>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('assets/js/logic-delete.js') }}"></script>
@endsection
@section('footer')
    <center><b>Todos os direitos a Usina Sonora MS - {{ \Carbon\Carbon::now()->format('Y') }}</b></center>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
@endsection
