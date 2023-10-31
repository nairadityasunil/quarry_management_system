<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contractor;

class ContractorController extends Controller
{
    public function add_contractor()
    {
        if (session()->has('username'))
        {
            return view('add_contractor');
        }
        else
        {
            return redirect('/');
        }
    }


    public function contractor_master()
    {
        if (session()->has('username'))
        {
            $contractor_details = Contractor::all();
            $data = compact('contractor_details');
            return view('contractor_master')->with($data);
        }
        else
        {
            return redirect('/');
        }
    }

    public function store_contractor(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'contractor_name' => 'required|unique:Contractor,contractor_name',
                    'contractor_type' => 'required|regex:/^[a-z A-Z]+$/',  
                    'address' => 'required',
                    'contact' => 'required|regex:/[0-9]{10}/|unique:Contractor,contact',
                    'email' => 'required|email|unique:Contractor,email'
                ],
                [
                    'contractor_name.required'=>'* Please Enter Contractor Name. *',
                    'contractor_name.unique'=>'* Contractor Already Exists. *',
                    'contractor_type.required'=>'* Please Enter Contractor Type. *',
                    'contractor_type.regex'=>'* Please Enter Only Alphabets In Contractor Type. *',
                    'address.required'=>'* Please Enter Address. *',
                    'contact.required'=>'* Please Enter Contact Number. *',
                    'contact.unique'=>'* Contact Number Already Exists. *',
                    'contact.regex'=>'* Please Enter Valid Contact Number. *',
                    'email.required'=>'* Please Enter Email Address. *',
                    'email.email'=>'* Please Enter Valid Email Address. *',
                    'email.unique'=>'* Email Already Exists. *'
                ]
            );
            $contractor = new Contractor;
            $contractor->contractor_name = $request['contractor_name'];
            $contractor->contractor_type = $request['contractor_type'];
            $contractor->address = $request['address'];
            $contractor->contact = $request['contact'];
            $contractor->email = $request['email'];
             
            if ($contractor->save())
            {
                // echo "<script>alert('Contractor Added!!')</script>";
                session()->flash('status' , 'Contractor Added!!!');
                return redirect('/contractor_master');
            }
            else
            {
                // echo "<script>alert('Contractor Not Added!!')</script>";
                session()->flash('status' , 'Contractor Not Added!!!');
                return redirect('/contractor_master');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function update_contractor($id)
    {
        if (session()->has('username'))
        {
            $update_details = Contractor::find($id);
            $data = compact('update_details');
            session()->put('contractor_id' , $id);
            return view('update_contractor')->with($data);
        }
        else
        {
            return redirect('/');
        }
    }

    public function confirm_contractor_update(Request $request)
    {
        if (session()->has('username'))
        {
            $request->validate(
                [
                    'contractor_name' => 'required|unique:Contractor,contractor_name,'.session()->get('contractor_id'),
                    'contractor_type' => 'required|regex:/^[a-z A-Z]+$/',  
                    'address' => 'required',
                    'contact' => 'required|regex:/[0-9]{10}/|unique:Contractor,contact,'.session()->get('contractor_id'),
                    'email' => 'required|email|unique:Contractor,email,'.session()->get('contractor_id')
                ],
                [
                    'contractor_name.required'=>'* Please Enter Contractor Name. *',
                    'contractor_name.unique'=>'* Contractor Already Exists. *',
                    'contractor_type.required'=>'* Please Enter Contractor Type. *',
                    'contractor_type.regex'=>'* Please Enter Only Alphabets In Contractor Type. *',
                    'address.required'=>'* Please Enter Address. *',
                    'contact.required'=>'* Please Enter Contact Number. *',
                    'contact.regex'=>'* Please Enter Valid Contact Number. *',
                    'contact.unique'=>'* Contact Number Already Exists. *',
                    'email.required'=>'* Please Enter Email. *',
                    'email.email'=>'* PLease Enter Valid Email. *',
                    'email.unique'=>'* Email Already Exists. *'
                ]
            );
            // session()->forget('contractor_id');
            $update_id = session()->get('contractor_id');
            $update_contractor = Contractor::find($update_id);
            if (!is_null($update_contractor))
            {
                $update_contractor->contractor_name = $request['contractor_name'];
                $update_contractor->contractor_type = $request['contractor_type'];
                $update_contractor->address = $request['address'];
                $update_contractor->contact = $request['contact'];
                $update_contractor->email = $request['email'];

                if($update_contractor->save())
                {
                    session()->flash('status' , 'Contractor Updated!!!');
                    return redirect('/contractor_master');
                }
                else
                {
                    session()->flash('status' , 'Contractor Not Updated!!!');
                    return redirect('/contractor_master');
                }
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function delete_contractor($id)
    {
        if(session()->has('username'))
        {
            $contractor_details = Contractor::find($id);
            if (!is_null($contractor_details))
            {
                if($contractor_details->delete())
                {
                    session()->flash('status' , 'Contractor Deleted !!!');
                    return redirect('/contractor_master');
                }
                else
                {
                    session()->flash('status' , 'Contractor Not Deleted !!!');
                    return redirect('/contractor_master');
                }
                // return redirect('/employee_master');
            }
        }
        else
        {
            return redirect('/');
        } 
    }
}
