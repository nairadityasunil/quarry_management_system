<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Models\Vehicles;

class VehicleController extends Controller
{
    public function vehicle_master()
    {
        if(session()->has('username'))
        {
            $all_vehicles = Vehicles::all();
            $data = compact('all_vehicles');
            return view('vehicle_master')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function store_new_vehicle(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'vehicle_number'=>'required|unique:Vehicles,vehicle_no|alphanum',
                    'registered_owner'=>'required',
                    'loading_capacity'=>'required|numeric',
                    'tare_weight'=>'required|numeric',
                    'make'=>'required',
                    'model_no'=>'required',
                    'engine_no'=>'required|unique:Vehicles,engine_no',
                    'chassis_no'=>'required|unique:Vehicles,chassis_no',
                    'passing_territory'=>'required|regex:/^[a-z A-Z]+$/',
                    'fitness_upto'=>'required',
                    'permit_upto'=>'required',
                    'driver_name'=>'required|regex:/^[a-z A-Z]+$/',
                    'license_no'=>'required',
                    'group'=>'required'
                ],
                [
                    'vehicle_number.required'=>'* Please Enter Vehicle Number. *',
                    'vehicle_number.unique'=>'* Vehicle Number Already Exists. *',
                    'vehicle_number.alphanum'=>'* Please Enter Valid Vehicle Number. *',
                    'registered_owner.required'=>'* Please Enter Owner Name. *',
                    'loading_capacity.required'=>'* Please Enter Loading Capacity. *',
                    'loading_capacity.numeric'=>'* Please Enter Only Integers Or Decimal Values For Loading Capacity. *',
                    'tare_weight.required'=>'* Please Enter Tare Weight. *',
                    'tare_weight.numeric'=>'* Please Enter Only Integers Or Decimal Values For Tare Weight. *',
                    'make.required'=>'* Please Enter Make. *',
                    'model_no.required'=>'* Please Enter Model Number. *',
                    'engine_no.required'=>'* Please Enter Engine Number. *',
                    'engine_no.unique'=>'* Engine Number Already Exists. *',
                    'chassis_no.required'=>'* Please Enter Chassis Number. *',
                    'chassis_no.unique'=>'* Chassis Number Already Exists. *',
                    'passing_territory.required'=>'* Please Enter Passing Territory. *',
                    'passing_territory.regex'=>'* Please Enter Only Alphabets In Passing Territory. *',
                    'fitness_upto.required'=>'* Please Enter Fitness Upto Date. *',
                    'permit_upto.required'=>'* Please Enter Permit Upto Date. *',
                    'driver_name.required'=>'* Please Enter Driver Name. *',
                    'driver_name.regex'=>'* Please Enter Only Alphabets In Driver Name. *',
                    'license_no.required'=>'* Please Enter License Number Of Driver. *',
                    'group.required'=>'* Please Select Vehicle Group. *'
                ]
            );
            $vehicles = new Vehicles;
            $vehicles->vehicle_no = $request['vehicle_number'];
            $vehicles->registered_owner = $request['registered_owner'];
            $vehicles->loading_capacity = $request['loading_capacity'];
            $vehicles->tare_weight = $request['tare_weight'];
            $vehicles->make = $request['make'];
            $vehicles->model_no = $request['model_no'];
            $vehicles->engine_no = $request['engine_no'];
            $vehicles->chassis_no = $request['chassis_no'];
            $vehicles->passing_territory = $request['passing_territory'];
            $vehicles->fitness_upto = $request['fitness_upto'];
            $vehicles->permit_upto = $request['permit_upto'];
            $vehicles->driver_name = $request['driver_name'];
            $vehicles->license_no = $request['license_no'];
            $vehicles->group = $request['group'];
    
            if ($vehicles->save())
            {
                echo "<script>alert('Vehicle Saved!!');</script>";
            }
            else
            {
                echo "<script>alert('Vehicle Not Saved!!');</script>";
            }
            
            $all_vehicles = Vehicles::all();
            $data = compact('all_vehicles');
            return view('vehicle_master')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function update_vehicle_list($id)
    {
        if(session()->has('username'))
        {
            $vehicle_id_details = Vehicles::find($id);
            if (!is_null($vehicle_id_details))
            {
                $data = compact('vehicle_id_details');
                return view('update_vehicle')->with($data);
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm_vehicle_update(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'vehicle_number'=>'required|unique:Vehicles,vehicle_no,'.$request->id,
                    'registered_owner'=>'required',
                    'loading_capacity'=>'required|numeric',
                    'tare_weight'=>'required|numeric',
                    'make'=>'required',
                    'model_no'=>'required',
                    'engine_no'=>'required|unique:Vehicles,engine_no,'.$request->id,
                    'chassis_no'=>'required|unique:Vehicles,chassis_no,'.$request->id,
                    'passing_territory'=>'required|regex:/^[a-z A-Z]+$/',
                    'fitness_upto'=>'required',
                    'permit_upto'=>'required',
                    'driver_name'=>'required|regex:/^[a-z A-Z]+$/',
                    'license_no'=>'required',
                    'group'=>'required'
                ],
                [
                    'vehicle_number.required'=>'* Please Enter Vehicle Number. *',
                    'vehicle_number.unique'=>'* Vehicle Number Already Exists. *',
                    'registered_owner.required'=>'* Please Enter Owner Name. *',
                    'loading_capacity.required'=>'* Please Enter Loading Capacity. *',
                    'tare_weight.required'=>'* Please Enter Tare Weight. *',
                    'make.required'=>'* Please Enter Make. *',
                    'model_no.required'=>'* Please Enter Model Number. *',
                    'engine_no.required'=>'* Please Enter Engine Number. *',
                    'engine_no.unique'=>'* Engine Number Already Exists. *',
                    'chassis_no.unique'=>'* Chassis Number Already Exists. *',
                    'passing_territory.required'=>'* Please Enter Passing Territory. *',
                    'passing_territory.regex'=>'* Please Enter Only Alphabets In Passing Territory. *',
                    'fitness_upto.required'=>'* Please Enter Fitness Upto Date. *',
                    'permit_upto.required'=>'* Please Enter Permit Upto Date. *',
                    'driver_name.required'=>'* Please Enter Driver Name. *',
                    'driver_name.regex'=>'* Please Enter Only Alphabets In Driver Name. *',
                    'license_no.required'=>'* Please Enter License Number Of Driver. *',
                    'loading_capacity.numeric'=>'* Please Enter Only Integers Or Decimal Values For Loading Capacity. *',
                    'tare_weight.numeric'=>'* Please Enter Only Integers Or Decimal Values For Tare Weight. *'
                ]
            );
            
            $confirm_update_id = Vehicles::find($request->id);
            $confirm_update_id->vehicle_no = $request['vehicle_number'];
            $confirm_update_id->registered_owner = $request['registered_owner'];
            $confirm_update_id->loading_capacity = $request['loading_capacity'];
            $confirm_update_id->tare_weight = $request['tare_weight'];
            $confirm_update_id->make = $request['make'];
            $confirm_update_id->model_no = $request['model_no'];
            $confirm_update_id->engine_no = $request['engine_no'];
            $confirm_update_id->chassis_no = $request['chassis_no'];
            $confirm_update_id->passing_territory = $request['passing_territory'];
            $confirm_update_id->fitness_upto = $request['fitness_upto'];
            $confirm_update_id->permit_upto = $request['permit_upto'];
            $confirm_update_id->driver_name = $request['driver_name'];
            $confirm_update_id->license_no = $request['license_no'];
            $confirm_update_id->group = $request['group'];
    
            if ($confirm_update_id->save())
            {
                // echo "<script>alert('Vehicle Updated!!');</script>";   
                session()->flash('status' , 'Vehicle Updated !!!');
                return redirect('/vehicle_master');
            }
            else
            {
                // echo "<script>alert('Vehicle Not Updated!!');</script>";
                session()->flash('status' , 'Vehicle Not Updated !!!');
                return redirect('/vehicle_master');
            }
            // $all_vehicles = Vehicles::all();
            // $data = compact('all_vehicles');
            // return view('vehicle_master')->with($data);
        }

        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function delete_vehicle($id)
    {
        if(session()->has('username'))
        {
            $delete_vehicle = Vehicles::find($id);
            if (!is_null($delete_vehicle))
            {
                if($delete_vehicle->delete())
                {
                    // echo "<script>alert('Item Deleted!!');</script>";
                    session()->flash('status' , 'Vehicle Deleted !!!');
                    return redirect('/vehicle_master');
                }
                else
                {
                    // echo "<script>alert('Item Not Deleted!!');</script>";
                    session()->flash('status' , 'Vehicle Not Deleted !!!');
                    return redirect('/vehicle_master');
                }
            }
            // return redirect('/vehicle_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_vehicle(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'search_item'=>'required|alphanum'
                ],
                [
                    'search_item.required'=>'* Please Enter Vehicle Number. *',
                    'search_item.alphanum'=>'* Please Enter Valid Vehicle Number. *'
                ]
            );
            $search_item = $request['search_item'];
            $all_vehicles = Vehicles::where('vehicle_no' , 'LIKE' , "%$search_item")->get();
            $data = compact('all_vehicles' , 'search_item');
            return view('vehicle_master')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
}
