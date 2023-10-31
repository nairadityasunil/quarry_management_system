<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Store_status;
use App\Models\Store_in;
use App\Models\Store_out;


class StoreController extends Controller
{
    // Functions Related To Store Status
    public function view_current_store_status()
    {
        if(session()->has('username'))
        {
            $store_status = Store_status::all();
            $data = compact('store_status');
            return view('store_status')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_store_status(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'item_name'=>'required'
                ],
                [
                    'item_name.required'=>'* No Parameters For Search. *'
                ]
            );
            $item_name = $request['item_name'];
            $store_status = Store_status::where('item_name' , 'Like' , $item_name.'%')->get();
            $data = compact('store_status' , 'item_name');
            return view('store_status')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Function Related To Store In
    public function save_store_in(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'item_name'=>'required',
                    'seller'=>'required',
                    'unit'=>'required',
                    'quantity'=>'required|numeric',
                    'price_per_unit'=>'required|numeric',
                    'total_value'=>'required|numeric'
                ],
                [
                    'item_name.required'=>'* Please Enter Item Name. *',
                    'seller.required'=>'* Please Enter Seller Name. *',
                    'unit.required'=>'* Please Select Unit. *',
                    'quantity.required'=>'* Please Enter Quantity. *',
                    'quantity.numeric'=>'* Please Enter Integer Or Decimal Value For Quantity. *',
                    'price_per_unit.required'=>'* Please Enter Price. *',
                    'price_per_unit.numeric'=>'* Please Enter Integer Or Decimal Value For Price. *',
                    'total_value.required'=>'* Please Enter Price And Quantity To Get Total Value. *',
                    'total_value.numeric'=>'* Please Enter Integer Or Decimal Value For Total Value. *',
                ]
            );
            $store_in = new Store_in;
            $store_in->item_name = $request['item_name'];
            $store_in->seller = $request['seller'];
            $store_in->unit = $request['unit'];
            $store_in->quantity = $request['quantity'];
            $store_in->price_per_unit = $request['price_per_unit'];
            $store_in->total_value = $request['total_value'];
            $item = $request->item_name;
    
            if($store_in->save())
            {
                $search_store_status = Store_status::where([['item_name' , '=' , $item]])->first();
                $store_status = new Store_status;
             
                if ($search_store_status)
                {
                    $search_store_status = Store_status::where([['item_name' , '=' , $item]])->get();
                    foreach ($search_store_status as $search_id)
                        {
                            $id = $search_id->id;
                            $old_quantity = $search_id->quantity;   
                            $input_quantity = $request['quantity'];
                            $new_quantity = $old_quantity + $input_quantity;
                            $save_store_status = Store_status::find($id);
                    
                            $save_store_status->item_name = $request['item_name'];
                            $save_store_status->quantity = $new_quantity;
                            $save_store_status->unit = $request['unit'];
                    
                            if($save_store_status->save())
                            {
                                // echo "<script>alert('Store In Saved!!');</script>";
                                session()->flash('store_in_status','Store-In Saved!!!');
                            }
                            else
                            {
                                session()->flash('store_in_status','Store-In Not Saved!!!');
                                // echo "<script>alert('Store In Not Saved!!');</script>";
                            }
                        }
                }
                else 
                {
                    $store_status->item_name = $request['item_name'];
                    $store_status->quantity = $request['quantity'];
                    $store_status->unit = $request['unit'];
                    
                    if ($store_status->save())
                    {
                        // echo "<script>alert('Store In Saved!!');</script>";
                        session()->flash('store_in_status','Store-In Saved!!!');

                    }
                    else
                    {
                        // echo "<script>alert('Store In Not Saved!!');</script>";
                        session()->flash('store_in_status','Store-In Not Saved!!!');

                    }
                }
            }
            return redirect('/store_status');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function store_in_list()
    {
        if(session()->has('username'))
        {
            $store_in_list = Store_in::all();
            $data = compact('store_in_list');
            return view('store_in_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_store_in(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'item_name'=>'required'
                ],
                [
                    'item_name.required'=>'* No Parameters For Search. *'
                ]
            );
            $item_name = $request['item_name'];
            $store_in_list = Store_in::where('item_name' , 'Like' , $item_name.'%')->get();
            $data = compact('store_in_list' , 'item_name');
            return view('store_in_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm_store_in($id)
    {
        if(session()->has('username'))
        {
            $id_search = Store_status::where('id' , '=' , $id)->get();
            foreach($id_search as $element)
            {
                $item_name = $element->item_name;
                $unit = $element->unit;
            }
            $data = compact('item_name' , 'unit');
            return view('store_in_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Functions Related To Store Out
    public function store_out_list()
    {
        if(session()->has('username'))
        {
            $store_out_list = Store_out::all();
            $data = compact('store_out_list');
            return view('store_out_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm_store_out($id)
    {
        if(session()->has('username'))
        {
            $id_search = Store_status::where('id' , '=' , $id)->get();
            foreach($id_search as $element)
            {
                $item_name = $element->item_name;
                $quantity = $element->quantity;
                $unit = $element->unit;
            }
            $data = compact('item_name' , 'unit' , 'quantity');
            return view('store_out_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function save_store_out(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'item_name'=>'required',
                    'unit'=>'required',
                    'available_quantity'=>'required|numeric',
                    'store_out_quantity'=>'required|numeric',
                ],
                [
                    'item_name.required'=>'* Please Enter Item Name. *',
                    'unit.required'=>'* Please Select Unit Type. *',
                    'store_out_quantity.required'=>'* Please Enter Withdrawl Quantity. *',
                    'store_out_quantity.numeric'=>'* Please Enter Interger Or Decimal Values For Withdrawl Quantity. *',
                    'available_quantity.required'=>'* Please Enter Available Quantity. *',
                    'available_quantity.numeric'=>'* Please Enter Interger Or Decimal Values For Available Quantity. *'
                ]
            );
            $store_out = new Store_out;
            $store_out->item_name = $request['item_name'];
            $store_out->unit = $request['unit'];
            $store_out->quantity = $request['store_out_quantity'];
            $item = $request['item_name'];
            if($store_out->save())
            {
                $available_quantity = $request['available_quantity'];
                $withdrawl_quantity = $request['store_out_quantity'];
                $remaining_quantity = $available_quantity - $withdrawl_quantity;
                $search_store_status = Store_status::where([['item_name' , '=' , $item]])->get();
                if ($remaining_quantity>0)
                {
                    foreach ($search_store_status as $search_id)
                    {
                        $id = $search_id->id;
                        $save_store_status = Store_status::find($id);
                        $save_store_status->item_name = $request['item_name'];
                        $save_store_status->quantity = $remaining_quantity;
                        $save_store_status->unit = $request['unit'];
                        $save_store_status->save();
                    }
                }
                else
                {
                    foreach ($search_store_status as $search_id)
                    {
                        $id = $search_id->id;
                        $store_status_element_found = Store_status::find($id);
                        $store_status_element_found->delete();
                    }
                }
                echo "<script>alert('Store Out Successfull')</script>";
            }
            else
            {
                echo "<script>alert('Store Out UnSuccessfull')</script>";
            }
            return redirect('/store_status');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_store_out(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'item_name'=>'required'
                ],
                [
                    'item_name.required'=>'* No Parameters For Search. *'
                ]
            );
            $item_name = $request['item_name'];
            $store_out_list = Store_out::where('item_name' , 'Like' , $item_name.'%')->get();
            $data = compact('store_out_list' , 'item_name');
            return view('store_out_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
}
