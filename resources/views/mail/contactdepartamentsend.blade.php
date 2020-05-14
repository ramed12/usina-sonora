@component('mail::message')
{!! str_replace('@departament',$data['departament_name'],str_replace('@message',$data['message'],str_replace('@subject',$data['subject'],str_replace('@phone',$data['phone'],str_replace('@email',$data['email'],str_replace('@name',$data['name'],$data['content_email'])))))) !!}
@endcomponent
