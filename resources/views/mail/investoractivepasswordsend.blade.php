@component('mail::message')

{!! str_replace('@password',$data['password'],str_replace('@name',$data['name'],$data['content_email'])) !!}

@component('mail::button', ['url' => route("site.investor")."#inicial"  ])
Acessar
@endcomponent
@endcomponent
