@extends('adminlte::page')
@section('content_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-md-8 col-xs-8">
        <h1> Investidores </h1>
    </div>
    <div class="col-md-4 col-xs-4">
        <ol class="breadcrumb m-1">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">Listar Investidores</li>
        </ol>
    </div>
</div>
@stop
@section('content')
<div class="card card-outline card-primary">
      <div class="card-body table-responsive no-padding">
        <div class="row">
            <div class="col-md-12 col-xs-12 text-right mb-2">
                <a href="{{ route('investor.add') }}" class="btn btn-primary" style="border-radius: 0px !important"><i class="fas fa-plus-circle"></i> Adicionar</a>
            </div>
          </div>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" width="5%">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col" width="5%">Status</th>
                    <th scope="col" width="3%" align="center" colspan="4"><center>Ações</center></th>
                </tr>
            </thead>
            @if(count($data) > 0)
            @foreach ($data as $item)
                <tbody>
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td align="center">
                            <center>
                                <span id="status_active_{{ $item->id }}" class="badge badge-success @if($item->status != 1) sr-only @endif">Ativo</span>
                                <span id="status_inactive_{{ $item->id }}" class="badge badge-danger @if($item->status != 0) sr-only @endif">Inativo</span>
                            </center>
                        </td>
                        <td>
                            <a href="{{ route('investor.edit',$item->id) }}" class="btn btn-info"><i class="far fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="{{ route('investor.send.file.password',$item->id) }}" class="btn btn-secondary"><i class="fas fa-mail-bulk"></i></a>
                        </td>
                        <td>
                            <a href="javascript:void(0)"  id="button_del_{{ $item->id }}" onclick="deleteRegister({{ $item->id }},{{ $item->status }},'{{ route('investor.send.del',$item->id) }}')" class="btn btn-danger @if($item->status == 0)disabled @endif"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td>
                            <a href="javascript:void(0)" onclick="detailRegister({{ $item->id }},'{{ $item->name }}','{{ $item->phone }}','{{ $item->email }}')" class="btn bg-purple"><i class="far fa-eye"></i></a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
            @else
            <tbody>
                <tr>
                    <td colspan="8"><center>Não possui registro.</center></td>
                </tr>
            </tbody>
            @endif
        </table>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title-name">&nbsp;</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <div class="col-md-12 col-xs-12"><label for="name">Nome do Investidor</label></div>
                    <div class="col-md-12 col-xs-12"><input type="text" readonly id="name" class="form-control"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-6"><label for="email">E-mail</label></div>
                    <div class="col-md-6 col-xs-6"><label for="phone">Telefone</label></div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-6"><input type="text" readonly id="email" class="form-control"></div>
                    <div class="col-md-6 col-xs-6"><input type="text" readonly id="phone" class="form-control"></div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12"><label for="password">Gerar Senha</label></div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-6"><input type="password"  id="password" name="password" class="form-control"></div>
                    <div class="col-md-3 col-xs-3"><button class="btn btn-info" onclick="getPassword()"><i class="fas fa-key"></i> Gerar Senha</button></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="passwordGenerate" class="btn btn-primary"><i class="fas fa-inbox"></i> Ativar e Enviar E-mail com a senha</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> Fechar</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('footer')
    <center><b>Todos os direitos a Usina Sonora MS - {{ \Carbon\Carbon::now()->format('Y') }}</b></center>
@endsection
@section('js')
<script src="{{ asset('assets/js/logic-delete.js') }}"></script>
<script src="{{ asset('assets/js/detail-register.js') }}"></script>
<script src="{{ asset('assets/js/generate-password.js') }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
@endsection
