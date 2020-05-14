@component('mail::message')

{!!
str_replace('@name',$data['name'],str_replace('@departament',$data['departament'],str_replace('@subject',$data['subject'],str_replace('@message',$data['message'],$data['content_email']))));
!!}
@endcomponent