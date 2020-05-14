{{-- @component('mail::message')

{!! str_replace('@password',$data['password'],str_replace('@year',$data['year'],str_replace('@month',$data['month'],str_replace('@nomearquivo',$data['nomearquivo'],str_replace('@name',$data['name'],$data['content_email']))))) !!}

@component('mail::button', ['url' => route("site.investor")."#inicial"  ])
Acessar
@endcomponent
@endcomponent
 --}}
 <style>
    @import url('https://fonts.googleapis.com/css2?family=Asap&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
 </style>

 <body style="background: #103185">
    
 <div style="width: 100%;text-align: center;padding-top:1rem"><img src="https://i.ibb.co/xFGT1JC/logo-white.png" alt="logo-white" border="0"></div>
 <div style="width: 50%;background: white;margin-left: auto; margin-right: auto;padding:2rem;margin-top:3rem;font-family: 'Roboto', sans-serif;"> 
    {!! str_replace('@password',$input2['password'],str_replace('@year',$input2['year'],str_replace('@month',$input2['month'],str_replace('@nomearquivo',$input2['nomearquivo'],str_replace('@name','Investidor',$input2['content_email']))))) !!}
 
 </div>
 <div style="color: #FFF;text-align: center;margin-top:2rem;font-family: 'Roboto', sans-serif;font-size:10px">
    Todos os direitos reservados Usina Sonora - MS© - {{ date('Y') }}
</div>
 </body>
 