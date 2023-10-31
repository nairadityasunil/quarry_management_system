<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lease;

class LeaseController extends Controller
{
    public function lease_list()
    {
        if(session()->has('username'))
        {
            $get_lease = Lease::all();
            $data = compact('get_lease');
            return view('lease_master')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function store_lease(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'lease_no'=>'required|unique:Lease,lease_no',
                    'address'=>'required',
                    'lease_area'=>'required|numeric',
                    'measure'=>'required',
                    'leaseholder'=>'required',
                    'lease_ton_limit'=>'required|numeric'
                ],
                [
                    'lease_no.required'=>'* Please Enter Lease Number. *',
                    'lease_no.unique'=>'* Lease Number Already Exists. *',
                    'address.required'=>'* Please Enter Address. *',
                    'lease_area.required'=>'* Please Enter Lease Area. *',
                    'lease_area.numeric'=>'* Please Enter Only Numeric Values In Lease Area. *',
                    'measure.required'=>'* Please Select Measure Type. *',
                    'leaseholder.required'=>'* Please Enter Leaseholder Name. *',
                    'lease_ton_limit.required'=>'* Please Enter Lease Ton Limit. *',
                    'lease_ton_limit.numeric'=>'* Please Enter Only Numeric Values In Lease Ton Limit. *'
                ]
            );
            $add_lease = new Lease;
            $add_lease->lease_no = $request['lease_no'];
            $add_lease->address = $request['address'];
            $add_lease->lease_area = $request['lease_area'];
            $add_lease->measure = $request['measure'];
            $add_lease->leaseholder = $request['leaseholder'];
            $add_lease->lease_ton_limit = $request['lease_ton_limit'];
    
            if($add_lease->save())
            {
                // return redirect('/lease_master');
                session()->flash('status' , 'Lease Added !!!');
                return redirect('/lease_master');
            }
            else
            {
                // echo "<script>alert('Lease Not Added')</script>";
                session()->flash('status' , 'Lease Not Added !!!');
                return redirect('/lease_master');
            }
            return redirect('/lease_master');
        }
        // return view
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm_lease_update_id($id)
    {
        if(session()->has('username'))
        {
            $get_lease_id = Lease::find($id);
            if (!is_null($get_lease_id))
            {
                $data = compact('get_lease_id');
                return view('update_lease')->with($data);
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function update_lease(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'lease_no'=>'required|unique:Lease,lease_no,'.$request->id,
                    'address'=>'required',
                    'lease_area'=>'required|numeric',
                    'measure'=>'required',
                    'leaseholder'=>'required',
                    'lease_ton_limit'=>'required|numeric'
                ],
                [
                    'lease_no.required'=>'* Please Enter Lease Number. *',
                    'lease_no.unique'=>'* Lease Number Already Exists. *',
                    'address.required'=>'* Please Enter Address. *',
                    'lease_area.required'=>'* Please Enter Lease Area. *',
                    'lease_area.numeric'=>'* Please Enter Only Numeric Values In Lease Area. *',
                    'measure.required'=>'* Please Select Measure Type. *',
                    'leaseholder.required'=>'* Please Enter Leaseholder Name. *',
                    'lease_ton_limit.required'=>'* Please Enter Lease Ton Limit. *',
                    'lease_ton_limit.numeric'=>'* Please Enter Only Numeric Values In Lease Ton Limit. *'
                ]
            );
            $update_lease = Lease::find($request['id']);
            if (!is_null($update_lease))
            {
                $update_lease->lease_no = $request['lease_no'];
                $update_lease->address = $request['address'];
                $update_lease->lease_area = $request['lease_area'];
                $update_lease->measure = $request['measure'];
                $update_lease->leaseholder = $request['leaseholder'];
                $update_lease->lease_ton_limit = $request['lease_ton_limit'];
    
                if ($update_lease->save())
                {
                    // return redirect('/lease_master');
                    session()->flash('status' , 'Lease Updated !!!');
                    return redirect('/lease_master');
                }
                else
                {
                    session()->flash('status' , 'Lease Not Updated !!!');
                    return redirect('/lease_master');
                }
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm_lease_delete_id($id)
    {
        if(session()->has('username'))
        {
            $lease_delete = Lease::find($id);
            if (!is_null($lease_delete))
            {
                if($lease_delete->delete())
                {
                    session()->flash('status' , 'Lease Deleted !!!');
                    return redirect('/lease_master');
                }
                // return redirect('/lease_master');
                else
                {
                    session()->flash('status' , 'Lease Not Deleted !!!');
                    return redirect('/lease_master');
                }
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
}
