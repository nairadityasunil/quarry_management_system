<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mail_report;


class MailController extends Controller
{
    public function mail_master()
    {
        $all_mails = Mail_report::all();
        $data = compact('all_mails');
        return view('mail_master')->with($data);
    }

    public function store_mail(Request $request)
    {
        $request->validate(
            [
                'email'=>'required|email|unique:Mail_report,email'
            ],
            [
                'email.required'=>'* Please Enter Email. *',
                'email.email'=>'* Please Enter Valid Email. *',
                'email.unique'=>'* Email Already Exists. *'
            ]
        );
        $store_mail = new Mail_report;
        $store_mail->email = $request['email'];

        if($store_mail->save())
        {
            session()->flash('mail_status','New Mail Address Added');
            return redirect('/mail_master');
        }
        else
        {
            session()->flash('mail_status','New Mail Address Not Added');
            return redirect('/mail_master');
        }
    }

    public function delete_mail($id)
    {
        $delete_id = Mail_report::find($id);
        if (!is_null($delete_id))
        {
            if($delete_id->delete())
            {
                session()->flash('mail_status','Mail Address Deleted');
                return redirect('/mail_master');
            }
            else
            {
                session()->flash('mail_status','Mail Address Not Deleted');
                return redirect('/mail_master');
            }
        }
    }
}
