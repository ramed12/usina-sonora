@extends('adminlte::page')
@section('content_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-md-9 col-xs-9">
        <h1> LGPD </h1>
    </div>
    <div class="col-md-3 col-xs-3">
        <ol class="breadcrumb m-1">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">Listar LGPD</li>
        </ol>
    </div>
</div>
@stop
@section('content')
<div class="card card-outline card-primary">
    <div class="card-body table-responsive no-padding">
        <div class="row">
            <div class="col-md-12 col-xs-12 text-right mb-2">
                <a href="{{ route('lgpd.add') }}" class="btn btn-primary" style="border-radius: 0px !important"><i class="fas fa-plus-circle"></i> Adicionar</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" width="5%">#</th>
                    <th scope="col">Nome </th>
                    <th scope="col">Copiar URL</th>
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
                        <td>
                            
                        <input type="hidden" id="url_{{ $item->id }}" value="{{ url('lgpd/'.$item->slug) }}" />
                        <a href="#" class="btn btn-success" onclick="copyUrl({{ $item->id }})" data-toggle="tooltip" data-placement="top" title="Copiado a URL" ><i class="fas fa-copy"></i></a>

                        </td>
                        <td align="center">
                                <span id="status_active_{{ $item->id }}" class="badge badge-success @if($item->status != 1) sr-only @endif">Ativo</span>
                                <span id="status_inactive_{{ $item->id }}" class="badge badge-danger @if($item->status != 0) sr-only @endif">Inativo</span>
                        </td>
                        <td>
                            <a href="{{ route('lgpd.edit',$item->id) }}" class="btn btn-info"><i class="far fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="javascript:void(0)" id="button_del_{{ $item->id }}" onclick="deleteRegister({{ $item->id }},{{ $item->status }},'{{ route('lgpd.send.del',$item->id) }}')" class="btn btn-danger @if($item->status == 0)disabled @endif"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
            @else
            <tbody>
                <tr>
                    <td colspan="5"><center>Não possui registro.</center></td>
                </tr>
            </tbody>
            @endif
        </table>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('assets/js/logic-delete.js') }}"></script>

<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


    function copyUrl(id){
        var  url = $("#url_" + id).val();
        let inputTest = document.createElement("input");

        inputTest.value = url;
        document.body.appendChild(inputTest);
        inputTest.select();


      document.execCommand('copy');
      document.body.removeChild(inputTest);

    }
  </script>
@endsection
@section('footer')
    <center><b>Todos os direitos a Usina Sonora MS - {{ \Carbon\Carbon::now()->format('Y') }}</b></center>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
@endsection
