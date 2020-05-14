<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function contactInsert($input)
    {
        $contact = new Contact;

        if(!empty($input['name']))
            $contact->name = $input['name'];
        if(!empty($input['email']))
            $contact->email = $input['email'];
        if(!empty($input['phone']))
            $contact->phone = $input['phone'];
        if(!empty($input['departament']))
            $contact->departament_id = $input['departament'];
        if(!empty($input['subject']))
            $contact->subject = $input['subject'];
        if(!empty($input['message']))
            $contact->content = $input['message'];

        $contact->status = 1;

        $contact->save();

        return $contact;
    }

    public function contactUpdate($input,$id)
    {
        $contact = Contact::find($id);

        if(!empty($input['name']))
            $contact->name = $input['name'];
        if(!empty($input['email']))
            $contact->email = $input['email'];
        if(!empty($input['phone']))
            $contact->phone = $input['phone'];
        if(!empty($input['departament']))
            $contact->departament = $input['departament'];
        if(!empty($input['subject']))
            $contact->subject = $input['subject'];
        if(!empty($input['message']))
            $contact->message = $input['message'];

        $contact->save();

        return $contact;
    }

    public function contactDel($id)
    {
        $data = Contact::where('id',$id)->update([
            'status'    => 0
        ]);
        return $data;
    }
}
