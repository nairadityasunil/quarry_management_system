<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fuel_type;
use App\Models\Fuel_in;
use App\Models\Fuel_available;
use App\Models\Fuel_out;


class FuelController extends Controller
{
    // Functions Related To Fuel Type Management
    public function save_fuel_type(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'fuel_type'=>'required'
                ],
                [
                    'fuel_type.required'=>'* Please Enter Fuel Type. *'
                ]
            );
            $fuel_type = new Fuel_type;
            $fuel_type->fuel_type = $request['fuel_type'];
            if($fuel_type->save())
            {
                // echo "<script>alert('Fuel Type Added!!')</script>";
                session()->flash('status' , 'Fuel Type Added !!!');
                return redirect('/fuel_type_list');
            }
            else
            {
                session()->flash('status' , 'Fuel Type Not Added !!!');
                return redirect('/fuel_type_list');
            }
            // return redirect('/fuel_type_list'); 
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function fuel_type_list()
    {
        if(session()->has('username'))
        {
            $fuel_type = Fuel_type::all();
            $data = compact('fuel_type');
            return view('fuel_type_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Functions Related To Available Fuel
    public function available_fuel_list()
    {
        if(session()->has('username'))
        {
            $available_fuel = Fuel_available::all();
            $data = compact('available_fuel');
            return view('fuel_available')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_available_fuel(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'fuel_type'=>'required'
                ],
                [
                    'fuel_type.required'=>'* No Parameters For Search. *'
                ]
            );
            $fuel_type = $request['fuel_type'];
            $available_fuel = Fuel_available::where('fuel_type' , 'Like' , $fuel_type.'%')->get();
            $data = compact('available_fuel' , 'fuel_type');
            return view('fuel_available')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
    

    // Functions Related To Fuel In
    public function fuel_in_entry()
    {
        if(session()->has('username'))
        {
            $fuel_type = Fuel_type::all();
            $data = compact('fuel_type');
            return view('fuel_in_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function fuel_in_list()
    {
        if(session()->has('username'))
        {
            $fuel_in_list = Fuel_in::all();
            $data = compact('fuel_in_list');
            return view('fuel_in_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function save_fuel_in(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'bill_no'=>'required',
                    'seller'=>'required',
                    'fuel_type'=>'required',
                    'quantity'=>'required|numeric',
                    'rate'=>'required|numeric',
                    'amount'=>'required|numeric',
                    'vehicle_no'=>'required|alphanum',
                    'driver_name'=>'required|regex:/^[a-z A-Z]+$/'
                ],
                [
                    'bill_no.required'=>'* Please Enter Bill No. *',
                    'seller.required'=>'* Please Enter Seller Name. *',
                    'fuel_type.required'=>'* Please Select Fuel Type. *',
                    'quantity.required'=>'* Please Enter Quantity. *',
                    'quantity.numeric'=>'* Enter Only Integer Or Decimal Value For Quantity. *',
                    'rate.required'=>'* Please Enter Rate. *',
                    'rate.numeric'=>'* Enter Only Integer Or Decimal Value For Rate. *',
                    'amount.required'=>'* Please Enter Quantity And Rate To Get Amount. *',
                    'amount.numeric'=>'* Please Enter Only Integer Or Decimal Value For Amount. *',
                    'vehicle_no.required'=>'* Please Enter Vehicle Number. *',
                    'vehicle_no.alphanum'=>'* Please Enter Valid Vehicle Number. *',
                    'driver_name.required'=>'* Please Enter Driver Name. *',
                    'driver_name.regex'=>'* Please Enter Only Alphabets In Driver Name. *'
                ]
            );
            $fuel_in = new Fuel_in();
            $fuel_in->bill_no=$request['bill_no'];
            $fuel_in->seller=$request['seller'];
            $fuel_in->fuel_type=$request['fuel_type'];
            $fuel_in->quantity=$request['quantity'];
            $fuel_in->rate=$request['rate'];
            $fuel_in->amount=$request['amount'];
            $fuel_in->vehicle_no=$request['vehicle_no'];
            $fuel_in->driver_name=$request['driver_name'];
    
            $fuel_type = $request['fuel_type'];
            if ($fuel_in->save())
            {
                $check_fuel_availability = Fuel_available::where([['fuel_type' , '=' , $fuel_type]])->first();
                $available_fuel = new Fuel_available;
    
                if($check_fuel_availability)
                {
                    $check_fuel_availability = Fuel_available::where([['fuel_type' , '=' , $fuel_type]])->get();
                    foreach($check_fuel_availability as $fuel)
                    {
                        $id = $fuel->id;
                        $old_quantity = $fuel->quantity;
                        $input_quantity = $request['quantity'];
                        $new_quantity = $old_quantity + $input_quantity;
    
                        $save_fuel_available = Fuel_available::find($id);
                        $save_fuel_available->fuel_type = $request['fuel_type'];
                        $save_fuel_available->quantity = $new_quantity;
    
                        if($save_fuel_available->save())
                        {
                            echo "<script>alert('Fuel In Saved!!');</script>";
                        }
                        else
                        {
                            echo "<script>alert('Fuel In Not Saved!!');</script>";
                        }
                    }
                }
                else 
                {
                    $available_fuel->fuel_type = $request['fuel_type'];
                    $available_fuel->quantity = $request['quantity'];
    
                    if($available_fuel->save())
                    {
                        echo "<script>alert('Fuel In Saved!!');</script>";
                    }
                    else
                    {
                        echo "<script>alert('Fuel In Not Saved!!');</script>";
                    }
                }
                return redirect('/available_fuel_list');
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm_fuel_in($id)
    {
        if(session()->has('username'))
        {
            $id_search = Fuel_available::where('id' , '=' , $id)->get();
            foreach($id_search as $element)
            {
                $fuel_name = $element->fuel_type;
                $quantity = $element->quantity;
            }
            $fuel_type = Fuel_type::all();
            $data = compact('fuel_name' , 'quantity' , 'fuel_type');
            return view('fuel_in_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function update_fuel_in($id)
    {
        if(session()->has('username'))
        {
            $fuel_name = Fuel_in::find($id);
            if (!is_null($fuel_name))
            {
                $fuel_type = Fuel_type::all();
                $data = compact('fuel_name' , 'fuel_type');
                return view('update_fuel_in')->with($data);
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm_fuel_in_update(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'bill_no'=>'required',
                    'seller'=>'required',
                    'fuel_type'=>'required',
                    'quantity'=>'required|numeric',
                    'rate'=>'required|numeric',
                    'amount'=>'required|numeric',
                    'vehicle_no'=>'required|alphanum',
                    'driver_name'=>'required|regex:/^[a-z A-Z]+$/'
                ],
                [
                    'bill_no.required'=>'* Please Enter Bill No. *',
                    'seller.required'=>'* Please Enter Seller Name. *',
                    'fuel_type.required'=>'* Please Select Fuel Type. *',
                    'quantity.required'=>'* Please Enter Quantity. *',
                    'quantity.numeric'=>'* Enter Only Integer Or Decimal Value For Quantity. *',
                    'rate.required'=>'* Please Enter Rate. *',
                    'rate.numeric'=>'* Enter Only Integer Or Decimal Value For Rate. *',
                    'amount.required'=>'* Please Enter Quantity And Rate To Get Amount. *',
                    'amount.numeric'=>'* Please Enter Only Integer Or Decimal Value For Amount. *',
                    'vehicle_no.required'=>'* Please Enter Vehicle Number. *',
                    'vehicle_no.alphanum'=>'* Please Enter Valid Vehicle Number. *',
                    'driver_name.required'=>'* Please Enter Driver Name. *',
                    'driver_name.regex'=>'* Please Enter Only Alphabets In Driver Name. *'
                ]
            );
            $find_id = Fuel_in::find($request['id']);
            if (!is_null($find_id))
            {
                $find_id->bill_no = $request['bill_no'];
                $find_id->seller = $request['seller'];
                $find_id->fuel_type = $request['fuel_type'];
                $find_id->quantity = $request['quantity'];
                $find_id->rate = $request['rate'];
                $find_id->amount = $request['amount'];
                $find_id->vehicle_no = $request['vehicle_no'];
                $find_id->driver_name = $request['driver_name'];
    
                if ($find_id->save())
                {
                    echo "<script>alert('Fuel In Updated!!');</script>";
                }
                else 
                {
                    echo "<script>alert('Fuel In Not Updated!!');</script>";
                }
    
                return redirect('/fuel_in_list');
            }
        }

        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_fuel_in_list(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'fuel_type'=>'required'
                ],
                [
                    'fuel_type.required'=>'* No Parameters For Search. *'
                ]
            );
            $fuel_type = $request['fuel_type'];
            $fuel_in_list  = Fuel_in::where('fuel_type' , '=' , $fuel_type);
            $data = compact('fuel_type' , 'fuel_in_list');
            return view('fuel_in_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Functions Related To Fuel Out
    public function confirm_fuel_out($id)
    {
        if(session()->has('username'))
        {
            $id_search = Fuel_available::where('id' , '=' , $id)->get();
            foreach($id_search as $element)
            {
                $fuel_name = $element->fuel_type;
                $quantity = $element->quantity;
            }
            $data = compact('fuel_name' , 'quantity');
            return view('fuel_out_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function save_fuel_out(Request $request)
    {
        if(session()->has('username'))
        {
            $fuel_out = new Fuel_out;
            $fuel_out->fuel_type = $request['fuel_type'];
            $fuel_out->quantity = $request['fuel_out_quantity'];
            $fuel_out->vehicle_no = $request['vehicle_no'];
            $fuel_name = $request['fuel_type'];
    
            if($fuel_out->save())
            {
                $available_quantity = $request['available_quantity'];
                $withdrawl_quantity = $request['fuel_out_quantity'];
    
                $remaining_quantity = $available_quantity - $withdrawl_quantity;
                $search_available_fuel = Fuel_available::where([['fuel_type' , '=' , $fuel_name]])->get();
    
                if ($remaining_quantity>0)
                {
                    foreach($search_available_fuel as $search_id)
                    {
                        $id = $search_id->id;
                        $save_fuel_available = Fuel_available::find($id);
                        $save_fuel_available->fuel_type = $request['fuel_type'];
                        $save_fuel_available->quantity = $remaining_quantity;
                        $save_fuel_available->save();
                    }
                }
                else
                {
                    foreach($search_available_fuel as $search_id)
                    {
                        $id = $search_id->id;
                        $fuel_available_element_found = Fuel_available::find($id);
                        $fuel_available_element_found->delete();
                    }
                }
                echo "<script>alert('Fuel Out Saved!!!!')</script>";
            }
            else
            {
                echo "<script>alert('Fuel Out Not Saved!!!!')</script>";  
            }
            return redirect('/available_fuel_list');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function fuel_out_list()
    {
        if(session()->has('username'))
        {
            $fuel_type = Fuel_out::all();
            $data = compact('fuel_type');
            return view('fuel_out_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function update_fuel_out($id)
    {
        if(session()->has('username'))
        {
            $fuel_name = Fuel_out::find($id);
            if (!is_null($fuel_name))
            {
                $fuel_type = Fuel_type::all();
                $data = compact('fuel_name' , 'fuel_type');
                return view('update_fuel_out')->with($data);
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm_fuel_out_update(Request $request)
    {
        if(session()->has('username'))
        {
            $find_id = Fuel_out::find($request['id']);
            if (!is_null($find_id))
            {
                $find_id->fuel_type = $request['fuel_type'];
                $find_id->quantity = $request['fuel_out_quantity'];
                $find_id->vehicle_no = $request['vehicle_no'];
    
                if ($find_id->save())
                {
                    echo "<script>alert('Fuel In Updated!!');</script>";
                }
                else 
                {
                    echo "<script>alert('Fuel In Not Updated!!');</script>";
                }
    
                return redirect('/fuel_out_list');
            }
        }

        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_fuel_out_list(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'vehicle_no'=>'required'
                ],
                [
                    'vehicle_no.required'=>'* No Parameters For Search. *'
                ]
            );
            $vehicle_no = $request['vehicle_no'];
            $fuel_type = Fuel_out::where('vehicle_no' , 'LIKE' , "%$vehicle_no")->get();
            $data = compact('fuel_type' , 'vehicle_no');
            return view('/fuel_out_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function delete_fuel_type($id)
    {
        if(session()->has('username'))
        {
            $delete_sales_out = Fuel_type::find($id);
            if (!is_null($delete_sales_out))
            {
                if($delete_sales_out->delete())
                {
                        echo "<script>alert('Purchase Out Entry Deleted!!');</script>";
                }
                else
                {
                    echo "<script>alert('Purchase Out Entry Not Deleted!!');</script>";
                }
            }
            return redirect()->back();
        }

        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
}
