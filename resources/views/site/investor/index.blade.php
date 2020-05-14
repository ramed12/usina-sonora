@extends('layouts.site.master')
@section('css')
    <style>
        form i {
    margin-left: -30px;
    cursor: pointer;
}
.form-input-personalizado {
    border: 1px solid #ccc;
padding: 10px 20px;
width: 100%;
border-radius: 5px;
    background: rgb(204, 204, 204);
}  
    </style>

@endsection
@section('content')
<div class="container" style="margin-top: 10em;margin-bottom:2em" id="inicial">
    <div class="row d-flex justify-content-center" style="color: grey">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-10 col-lg-10 col-xl-10 col-sm-10 col-xs-10 content-text-title">Área do Investidor</div>

                <div class="col-md-2 col-lg-2 col-xl-2 col-sm-2 col-xs-2 text-right"><a href="{{ route('logout') }}" class="btn bg-blue-person text-white rounded-0" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    <i class="fas fa-sign-out-alt text-white fa-fw"></i> Sair
                </a></div>
            </div>
            <hr style="color: grey" width="100%">
        </div>

        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12">
            <h5>Planilha de Investimentos</h5>
            <hr style="color: grey" width="100%">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" width="5%">Mês/Ano</th>
                        <th scope="col">Arquivo</th>
                        <th scope="col">Senha do arquivo</th>
                        <th scope="col" width="10%">Download</th>
                    </tr>
                </thead>
                <tbody>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->month}}/{{ $item->year }}</td>
                        <td>{{ $item->name }}</td>
                        <td class="text-center">
                            <form action="javscript:void(0)">
                            <input type="password" class="form-input-personalizado" readonly name="password" id="password-{!! $item->id !!}" value="{{ $item->password }}" />
                            <i class="bi bi-eye-slash" id="togglePassword-{!! $item->id !!}"></i>   
                            </form> 
                        </td>
                        <td class="text-center"><a href="{{ route('site.download',$item->id) }}" class="btn btn-warning rounded-0 text-center"><i class="fas fa-download"></i></a></td>
                    </tr>
                    <script> 
                        $( document ).ready(function() {
                            var id_file = {!!$item->id !!};
                            const togglePassword = document.querySelector("#togglePassword-"+id_file);
                            const password = document.querySelector("#password-"+id_file);

                            togglePassword.addEventListener("click", function () {
                                // toggle the type attribute
                                const type = password.getAttribute("type") === "password" ? "text" : "password";
                                password.setAttribute("type", type);
                                
                                // toggle the icon
                                this.classList.toggle("bi-eye");
                            });
                        });
                    </script>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.16.3/sweetalert2.min.css">
@endsection
@section('js')
@if (session('message'))
<script src="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.16.3/sweetalert2.all.min.js"></script>
<script>
Swal.fire({
    icon:  '{{ session('icon') }}',
    title: '{{ session('message') }}',
})
</script>
@endif

<script>
    
    $(document).ready(function(){
    $('#menu-nav').addClass('bg-blue-person');
    });
</script>
@endsection

<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
