<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Sales_in;
use App\Models\Sales_out;
use App\Models\Pending_sales;
use App\Models\Item;
use App\Models\Vehicles;
use App\Models\Lease;

class SalesController extends Controller
{
    // Functions Of Direct Sales Sales
    public function direct_sales()
    { 
        if(session()->has('username'))
        {
            $all_vehicles = Vehicles::where([['group' , '=' , "Sales Group"]])->get();
            $item = Item::all();
            $lease = Lease::all();
            $pending_s = Pending_sales::all();
            $current_date_time = Carbon::now()->toDateTimeString();
            $data = compact('all_vehicles' , 'item' ,'current_date_time' , 'pending_s' , 'lease');
            return view('direct_sales')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
        
    }

    public function store_direct_sales(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'lease'=>'required',
                    'selling_company'=>'required|regex:/^[a-z A-Z]+$/',
                    'customer_name'=>'required|regex:/^[a-z A-Z]+$/',
                    'item'=>'required',
                    'vehicle_no'=>'required|alphanum',
                    'driver_name'=>'required|regex:/^[a-z A-Z]+$/',
                    'gross_weight'=>'required|numeric',
                    'tare_weight'=>'required|numeric',
                    'net_weight'=>'required|numeric'
                ],
                [
                    'lease.required'=>'* Please Select Lease. *',
                    'selling_company.required'=>'* Please Enter Company Name. *',
                    'selling_company.regex'=>'* Please Enter Only Alphabets In Company Name. *',
                    'customer_name.required'=>'* Please Enter Customer Name. *',
                    'customer_name.regex'=>'* Please Enter Only Alphabets In Customer Name. *',
                    'vehicle_no.required'=>'* Please Enter Vehicle Number. *',
                    'vehicle_no.alphanum'=>'* Please Select Vehicle Number. *',
                    'driver_name.required'=>'* Please Select Vehicle Number To Get Driver Name. *',
                    'driver_name.regex'=>'* Please Enter Only Alphabets In Driver Name. *',
                    'tare_weight.required'=>'* Please Select Vehicle To Get Tare Weight. *',
                    'tare_weight.numeric'=>'* Please Enter Only Integer Or Decimal Values In Tare Weight. *',
                    'gross_weight.required'=>'* Please Enter Gross Weight. *',
                    'gross_weight.numeric'=>'* Please Enter Only Integer Or Decimal Values In Gross Weight. *',
                    'net_weight.required'=>'* Please Select Vehicle And Enter Gross Weight For Net Weight. *',
                    'net_weight.numeric'=>'* Please Enter Only Integer Or Decimal Values In Tare Weight. *'
                ]
            );
            $sales_out = new Sales_out;
            $sales_out->lease = $request['lease'];
            $sales_out->selling_company = $request['selling_company'];
            $sales_out->customer_name = $request['customer_name'];
            $sales_out->item = $request['item'];
            $sales_out->date_time = Carbon::now()->toDateTimeString();
            $sales_out->vehicle_no = $request['vehicle_no'];
            $sales_out->driver_name = $request['driver_name'];
            $sales_out->tare_weight = $request['tare_weight'];
            $sales_out->gross_weight = $request['gross_weight'];
            $sales_out->net_weight = $request['net_weight'];
            // $sales_out->loader = $request['loader'];         
    
        if ($sales_out->save())
        {
            $last_sales_out = Sales_out::all()->last();
            $last_sales_out_id = $last_sales_out->id;
            $sales_in_find_last = Sales_in::find($last_sales_out_id);
    
            if(is_null($sales_in_find_last))
            {
                $sales_in = new Sales_in;
                $sales_in->lease = $request['lease'];
                $sales_in->selling_company = $request['selling_company'];
                $sales_in->vehicle_no = $request['vehicle_no'];
                $sales_in->driver_name = $request['driver_name'];
                $sales_in->customer_name = $request['customer_name'];
                $sales_in->item = $request['item'];
                $sales_in->tare_weight = $request['tare_weight'];
                
                if ($sales_in->save())
                {
                    echo "<script>alert('Sales Out Saved!!');</script>";
                }
            }
            else
            {
                $pending_s_delete = Pending_sales::find($request['ticket_no']); 
                if (!is_null($pending_s_delete))
                {
                    $pending_s_delete->delete();
                }
                echo "<script>alert('Sales Out Saved!!');</script>";
            }
        }
        else
        {
            echo "<script>alert('Sales Out Not Saved!!');</script>";
        }
        $all_vehicles = Vehicles::where([['group' , '=' , "Sales Group"]])->get();
        $current_date_time = Carbon::now()->toDateTimeString();
        $item = Item::all();
        $pending_s = Pending_sales::all();
        $lease = Lease::all();
        $data = compact('pending_s', 'item' , 'all_vehicles' , 'current_date_time' , 'lease');
        return view('direct_sales')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Functions For Sales In Section
    public function get_sales()
    {
        if(session()->has('username'))
        {
            $all_vehicles = Vehicles::where([['group' , '=' , "Sales Group"]])->get();
            $item = Item::all();
            $lease = Lease::all();
            $pending_s = Pending_sales::all();
            $data = compact('pending_s' , 'item' , 'all_vehicles' , 'lease');
            return view('sales_in_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm($id)
    {
        if(session()->has('username'))
        {
            $item = Item::all();
            $pending_s = Pending_sales::all();
            $pending_sales = Pending_sales::find($id);
            $current_date_time = Carbon::now()->toDateTimeString();
            $data = compact('pending_s' , 'pending_sales' , 'current_date_time' , 'item');
            return view('sales_out_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function store_sales_in(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'lease'=>'required',
                    'selling_company'=>'required|regex:/^[a-z A-Z]+$/',
                    'customer_name'=>'required|regex:/^[a-z A-Z]+$/',
                    'item'=>'required',
                    'vehicle_no'=>'required|alphanum',
                    'driver_name'=>'required|regex:/^[a-z A-Z]+$/',
                    'tare_weight'=>'required|numeric',
                ],
                [
                    'lease.required'=>'* Please Select Lease. *',
                    'selling_company.required'=>'* Please Enter Company Name. *',
                    'selling_company.regex'=>'* Please Enter Only Alphabets In Company Name. *',
                    'customer_name.required'=>'* Please Enter Customer Name. *',
                    'customer_name.regex'=>'* Please Enter Only Alphabets In Customer Name. *',
                    'vehicle_no.required'=>'* Please Enter Vehicle Number. *',
                    'vehicle_no.alphanum'=>'* Please Select Vehicle Number. *',
                    'driver_name.required'=>'* Please Enter Driver Name. *',
                    'driver_name.regex'=>'* Please Enter Only Alphabets In Driver Name. *',
                    'tare_weight.required'=>'* Please Enter Tare Weight. *',
                    'tare_weight.numeric'=>'* Please Enter Only Integer Or Decimal Values In Tare Weight. *',
                ]
            );
            $sales_in = new Sales_in;
            $sales_in->lease = $request['lease'];
            $sales_in->selling_company = $request['selling_company'];
            $sales_in->vehicle_no = $request['vehicle_no'];
            $sales_in->driver_name = $request['driver_name'];
            $sales_in->customer_name = $request['customer_name'];
            $sales_in->item = $request['item'];
            $sales_in->tare_weight = $request['tare_weight'];
            $sales_in->save();
    
            $pending_sales = new Pending_sales;
            $pending_sales->lease = $request['lease'];
            $pending_sales->selling_company = $request['selling_company'];
            $pending_sales->vehicle_no = $request['vehicle_no'];
            $pending_sales->driver_name = $request['driver_name'];
            $pending_sales->customer_name = $request['customer_name'];
            $pending_sales->item = $request['item'];
            $pending_sales->tare_weight = $request['tare_weight'];
            $pending_sales->save();
    
            $all_vehicles = Vehicles::where([['group' , '=' , "Sales Group"]])->get();
            $item = Item::all();
            $lease = Lease::all();
            $pending_s = Pending_sales::all();
            $data = compact('pending_s' , 'item', 'all_vehicles' , 'lease');
            return view('sales_in_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function sales_in_list()
    {
        if(session()->has('username'))
        {
            $sales_in = Sales_in::all();
            $data = compact('sales_in');
            return view('sales_in_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function get_pending_sales_list()
    {
        if(session()->has('username'))
        {
            $pending_s = Pending_sales::all();
            $data = compact('pending_s');
            return view('pending_sales')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // public function update_sales_in($id)
    // {
    //     $sales_id_details = Sales_in::find($id);
    //     if (!is_null($sales_id_details))
    //     {
    //         $lease = Lease::all();
    //         $item = Item::all();
    //         $data = compact('sales_id_details' , 'item' , 'lease');
    //         return view('update_sales_in')->with($data);
    //     }
    // }

    // public function confirm_sales_in_update(Request $request)
    // {
    //     $confirm_update_id = Sales_in::find($request->id);
    //     if (!is_null($confirm_update_id))
    //     {
    //         $confirm_update_id->lease = $request['lease'];
    //         $confirm_update_id->selling_company = $request['selling_company'];
    //         $confirm_update_id->vehicle_no = $request['vehicle_no'];
    //         $confirm_update_id->driver_name = $request['driver_name'];
    //         $confirm_update_id->customer_name = $request['customer_name'];
    //         $confirm_update_id->item = $request['item'];
    //         $confirm_update_id->tare_weight = $request['tare_weight'];
    //         $confirm_update_id->save();

    //         $confirm_update_id_sales_out = Sales_out::find($request->id);
    //         if (!is_null($confirm_update_id_sales_out))
    //         {
    //             $confirm_update_id_sales_out->lease = $request['lease'];
    //             $confirm_update_id_sales_out->selling_company = $request['selling_company'];
    //             $confirm_update_id_sales_out->vehicle_no = $request['vehicle_no'];
    //             $confirm_update_id_sales_out->driver_name = $request['driver_name'];
    //             $confirm_update_id_sales_out->customer_name = $request['customer_name'];
    //             $confirm_update_id_sales_out->item = $request['item'];
    //             $confirm_update_id_sales_out->tare_weight = $request['tare_weight'];
                
    //             if ($confirm_update_id_sales_out->save())
    //             {
    //                 echo "<script>alert('Entry Updated!!');</script>";
    //                 $sales_in = Sales_in::all();
    //                 $data = compact('sales_in');
    //                 return view('sales_in_list')->with($data);
    //             }
    //         }
    //         else 
    //         {
    //             echo "<script>alert('Unable To Update Entry!!');</script>";
    //             $sales_in = Sales_in::all();
    //             $data = compact('sales_in');
    //             return view('sales_in_list')->with($data);
    //         }
    //     }
    // }

    // public function delete_sales_in($id)
    // {
    //     $delete_sales_in = Sales_in::find($id);
    //     if (!is_null($delete_sales_in))
    //     {
    //         if($delete_sales_in->delete())
    //         {
    //             $delete_sales_out = Sales_out::find($id);
    //             if ($delete_sales_out->delete())
    //             {
    //                 echo "<script>alert('Sales In Entry Deleted!!');</script>";
    //             }
    //         }
    //         else
    //         {
    //             echo "<script>alert('Sales In Entry Not Deleted!!');</script>";
    //         }
    //     }
    //     return redirect('/sales_in_list');
    // }

    public function search_sales_in_list(Request $request)
    {
        if(session()->has('username'))
        {
            $customer_name = $request['customer_name'];
            $item = $request['item'];
            $vehicle_no = $request['vehicle_no'];

                if (!is_null($customer_name) && !is_null($item) && !is_null($vehicle_no))
                {
                    $sales_in = Sales_in::where([
                        ['customer_name' , 'LIKE' , "%$customer_name%"],
                        ['item' , 'LIKE' , "%$item%"],
                        ['vehicle_no' , 'LIKE' , "%$vehicle_no"]
                    ])->get();
                    $data = compact('sales_in' , 'customer_name' , 'item' , 'vehicle_no');
                    return view('sales_in_list')->with($data);
                }
        
                elseif (!is_null($customer_name) && !is_null($item) && is_null($vehicle_no))
                {
                    $sales_in = Sales_in::where([
                        ['customer_name' , 'LIKE' , "%$customer_name%"],
                        ['item' , 'LIKE' , "%$item%"],
                    ])->get();
                    $data = compact('sales_in' , 'customer_name' , 'item' );
                    return view('sales_in_list')->with($data);
                }
        
                elseif (!is_null($customer_name) && is_null($item) && !is_null($vehicle_no))
                {
                    $sales_in = Sales_in::where([
                        ['customer_name' , 'LIKE' , "%$customer_name%"],
                        ['vehicle_no' , 'LIKE' , "%$vehicle_no"]
                    ])->get();
                    $data = compact('sales_in' , 'customer_name' , 'vehicle_no');
                    return view('sales_in_list')->with($data);
                }
        
                elseif (is_null($customer_name) && !is_null($item) && !is_null($vehicle_no))
                {
                    $sales_in = Sales_in::where([
                        ['item' , 'LIKE' , "%$item%"],
                        ['vehicle_no' , 'LIKE' , "%$vehicle_no"]
                    ])->get();
                    $data = compact('sales_in' , 'item' , 'vehicle_no');
                    return view('sales_in_list')->with($data);
                }
        
                elseif(!is_null($customer_name))
                {
                    $sales_in = Sales_in::where([
                        ['customer_name' , 'LIKE' , "%$customer_name%"],
                    ])->get();
                    $data = compact('sales_in' , 'customer_name');
                    return view('sales_in_list')->with($data);
                }
        
                elseif(!is_null($item))
                {
                    $sales_in = Sales_in::where([
                        ['item' , 'LIKE' , "%$item%"],
                    ])->get();
                    $data = compact('sales_in' , 'item');
                    return view('sales_in_list')->with($data);
                }
        
                elseif(!is_null($vehicle_no))
                {
                    $sales_in = Sales_in::where([
                        ['vehicle_no' , 'LIKE' , "%$vehicle_no"],
                    ])->get();
                    $data = compact('sales_in' , 'vehicle_no');
                    return view('sales_in_list')->with($data);
                }
                else
                {
                    session()->flash('no_record', '* No Parameters For Search. *');
                    return redirect()->back();
                }

        }

        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_pending_sales_list(Request $request)
    {
        if(session()->has('username'))
        {
            $customer_name = $request['customer_name'];
            $item = $request['item'];
            $vehicle_no = $request['vehicle_no'];
             
            if (!is_null($customer_name) && !is_null($item) && !is_null($vehicle_no))
            {
                $pending_sales = Pending_sales::where([
                    ['customer_name' , 'LIKE' , "%$customer_name%"],
                    ['item' , 'LIKE' , "%$item%"],
                    ['vehicle_no' , 'LIKE' , "%$vehicle_no"]
                ])->get();
                $data = compact('pending_sales' , 'customer_name' , 'item' , 'vehicle_no');
                return view('pending_sales')->with($data);
            }
    
            elseif (!is_null($customer_name) && !is_null($item) && is_null($vehicle_no))
            {
                $pending_s = Pending_sales::where([
                    ['customer_name' , 'LIKE' , "%$customer_name%"],
                    ['item' , 'LIKE' , "%$item%"],
                ])->get();
                $data = compact('pending_s' , 'customer_name' , 'item' );
                return view('pending_sales')->with($data);
            }
    
            elseif (!is_null($customer_name) && is_null($item) && !is_null($vehicle_no))
            {
                $pending_s = Pending_sales::where([
                    ['customer_name' , 'LIKE' , "%$customer_name%"],
                    ['vehicle_no' , 'LIKE' , "%$vehicle_no"]
                ])->get();
                $data = compact('pending_s' , 'customer_name' , 'vehicle_no');
                return view('pending_sales')->with($data);
            }
    
            elseif (is_null($customer_name) && !is_null($item) && !is_null($vehicle_no))
            {
                $pending_s = Pending_sales::where([
                    ['item' , 'LIKE' , "%$item%"],
                    ['vehicle_no' , 'LIKE' , "%$vehicle_no"]
                ])->get();
                $data = compact('pending_s' , 'item' , 'vehicle_no');
                return view('pending_sales')->with($data);
            }
    
            elseif(!is_null($customer_name))
            {
                $pending_s = Pending_sales::where([
                    ['customer_name' , 'LIKE' , "%$customer_name%"],
                ])->get();
                $data = compact('pending_s' , 'customer_name');
                return view('pending_sales')->with($data);
            }
    
            elseif(!is_null($item))
            {
                $pending_s = Pending_sales::where([
                    ['item' , 'LIKE' , "%$item%"],
                ])->get();
                $data = compact('pending_s' , 'item');
                return view('pending_sales')->with($data);
            }
    
            elseif(!is_null($vehicle_no))
            {
                $pending_s = Pending_sales::where([
                    ['vehicle_no' , 'LIKE' , "%$vehicle_no"],
                ])->get();
                $data = compact('pending_s' , 'vehicle_no');
                return view('pending_sales')->with($data);
            }
            else
            {
                session()->flash('no_record', '* No Parameters For Search. *');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }


    // Functions For Sales Out Section
    public function get_sales_out()
    {
        if(session()->has('username'))
        {
            $item = Item::all();
            $lease = Lease::all();
            $all_vehicles = Vehicles::where([['group' , '=' , "Sales Group"]])->get();
            $current_date_time = Carbon::now()->toDateTimeString();
            $pending_s = Pending_sales::all();
            $data = compact('pending_s' , 'current_date_time' , 'item' , 'lease' , 'all_vehicles');
            return view('sales_out_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function store_sales_out(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'lease'=>'required',
                    'selling_company'=>'required|regex:/^[a-z A-Z]+$/',
                    'customer_name'=>'required|regex:/^[a-z A-Z]+$/',
                    'item'=>'required',
                    'vehicle_no'=>'required|alphanum',
                    'driver_name'=>'required|regex:/^[a-z A-Z]+$/',
                    'gross_weight'=>'required|numeric',
                    'tare_weight'=>'required|numeric',
                    'net_weight'=>'required|numeric'
                ],
                [
                    'lease.required'=>'* Please Select Lease. *',
                    'selling_company.required'=>'* Please Enter Company Name. *',
                    'selling_company.regex'=>'* Please Enter Only Alphabets In Company Name. *',
                    'customer_name.required'=>'* Please Enter Customer Name. *',
                    'customer_name.regex'=>'* Please Enter Only Alphabets In Customer Name. *',
                    'vehicle_no.required'=>'* Please Enter Vehicle Number. *',
                    'vehicle_no.alphanum'=>'* Please Select Vehicle Number. *',
                    'driver_name.required'=>'* Please Select Vehicle Number To Get Driver Name. *',
                    'driver_name.regex'=>'* Please Enter Only Alphabets In Driver Name. *',
                    'tare_weight.required'=>'* Please Select Vehicle To Get Tare Weight. *',
                    'tare_weight.numeric'=>'* Please Enter Only Integer Or Decimal Values In Tare Weight. *',
                    'gross_weight.required'=>'* Please Enter Gross Weight. *',
                    'gross_weight.numeric'=>'* Please Enter Only Integer Or Decimal Values In Gross Weight. *',
                    'net_weight.required'=>'* Please Enter Gross Weight And Tare Weight To Get Net Weight. *',
                    'net_weight.numeric'=>'* Please Enter Only Integer Or Decimal Values In Tare Weight. *'
                ]
            );
            $sales_out = new Sales_out;
            $sales_out->lease = $request['lease'];
            $sales_out->selling_company = $request['selling_company'];
            $sales_out->customer_name = $request['customer_name'];
            $sales_out->item = $request['item'];
            $sales_out->date_time = $request['date_time'];
            $sales_out->vehicle_no = $request['vehicle_no'];
            $sales_out->driver_name = $request['driver_name'];
            $sales_out->tare_weight = $request['tare_weight'];
            $sales_out->gross_weight = $request['gross_weight'];
            $sales_out->net_weight = $request['net_weight'];
            // $sales_out->loader = $request['loader'];
    
            if ($sales_out->save())
            {
                $pending_s_delete = Pending_sales::find($request['ticket_no']); 
                    if (!is_null($pending_s_delete))
                    {
                        $pending_s_delete->delete();
                    }
                    echo "<script>alert('Sales Out Saved!!');</script>";
            }
            else
            {
                echo "<script>alert('Sales Out Not Saved!!');</script>";
            }
            $all_vehicles = Vehicles::all();
            $item = Item::all();
            $lease = Lease::all();
            $pending_s = Pending_sales::all();
            $data = compact('pending_s', 'item' , 'all_vehicles' , 'lease');
            return view('sales_in_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function sales_out_list()
    {
        if(session()->has('username'))
        {
            $sales_out = Sales_out::all();
            $data = compact('sales_out');
            return view('sales_out_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function update_sales_out($id)
    {
        if(session()->has('username'))
        {
            $sales_out_id_details = Sales_out::find($id);
            if (!is_null($sales_out_id_details))
            {
                $lease = Lease::all();
                $item = Item::all();
                $data = compact('sales_out_id_details' , 'item' , 'lease');
                return view('update_sales_out')->with($data);
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm_sales_out_update(Request $request)
    {
        if(session()->has('username'))
        {
            $confirm_update_id = Sales_out::find($request->id);
            if (!is_null($confirm_update_id))
            {
                $confirm_update_id->lease = $request['lease'];
                $confirm_update_id->selling_company = $request['selling_company'];
                $confirm_update_id->customer_name = $request['customer_name'];
                $confirm_update_id->item = $request['item'];
                $confirm_update_id->date_time = $request['date_time'];
                $confirm_update_id->vehicle_no = $request['vehicle_no'];
                $confirm_update_id->driver_name = $request['driver_name'];
                $confirm_update_id->tare_weight = $request['tare_weight'];
                $confirm_update_id->gross_weight = $request['gross_weight'];
                $confirm_update_id->net_weight = $request['net_weight'];
                // $confirm_update_id->loader = $request['loader'];
                $confirm_update_id->save();
    
                $confirm_update_id_sales_out = Sales_in::find($request->id);
                if (!is_null($confirm_update_id_sales_out))
                {
                    $confirm_update_id_sales_out->lease = $request['lease'];
                    $confirm_update_id_sales_out->selling_company = $request['selling_company'];
                    $confirm_update_id_sales_out->vehicle_no = $request['vehicle_no'];
                    $confirm_update_id_sales_out->driver_name = $request['driver_name'];
                    $confirm_update_id_sales_out->customer_name = $request['customer_name'];
                    $confirm_update_id_sales_out->item = $request['item'];
                    $confirm_update_id_sales_out->tare_weight = $request['tare_weight'];
                    
                    if ($confirm_update_id_sales_out->save())
                    {
                        // echo "<script>alert('Entry Updated!!');</script>";
                        // $sales_out = Sales_out::all();
                        // $data = compact('sales_out');
                        // return view('sales_out_list')->with($data);
                        session()->flash('status' , 'Entry Updated !!!');
                        return redirect('/sales_out_list');
                    }
                }
                else 
                {
                    // echo "<script>alert('Unable To Update Entry!!');</script>";
                    // $sales_out = Sales_out::all();
                    // $data = compact('sales_out');
                    // return view('sales_out_list')->with($data);
                    session()->flash('status' , 'Entry Not Updated !!!');
                    return redirect('/sales_out_list');
                }
            }
        }

        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function delete_sales_out($id)
    {
        if(session()->has('username'))
        {
            $delete_sales_out = Sales_out::find($id);
            if (!is_null($delete_sales_out))
            {
                if($delete_sales_out->delete())
                {
                    $delete_sales_in = Sales_in::find($id);
                    if($delete_sales_in->delete())
                    {
                        // echo "<script>alert('Purchase Out Entry Deleted!!');</script>";
                        session()->flash('status' , 'Entry Deleted !!!');
                        return redirect('/sales_out_list');
                    }
                }
                else
                {
                    // echo "<script>alert('Purchase Out Entry Not Deleted!!');</script>";
                    session()->flash('status' , 'Entry Not Deleted !!!');
                    return redirect('/sales_out_list');
                }
            }
            // return redirect()->back();
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_sales_out_list(Request $request)
    {
        if(session()->has('username'))
        {
            $customer_name = $request['customer_name'];
            $item = $request['item'];
            $vehicle_no = $request['vehicle_no'];
             
            if (!is_null($customer_name) && !is_null($item) && !is_null($vehicle_no))
            {
                $sales_out = Sales_out::where([
                    ['customer_name' , 'LIKE' , "%$customer_name%"],
                    ['item' , 'LIKE' , "%$item%"],
                    ['vehicle_no' , 'LIKE' , "%$vehicle_no"]
                ])->get();
                $data = compact('sales_out' , 'customer_name' , 'item' , 'vehicle_no');
                return view('sales_out_list')->with($data);
            }
    
            elseif (!is_null($customer_name) && !is_null($item) && is_null($vehicle_no))
            {
                $sales_out = Sales_out::where([
                    ['customer_name' , 'LIKE' , "%$customer_name%"],
                    ['item' , 'LIKE' , "%$item%"],
                ])->get();
                $data = compact('sales_out' , 'customer_name' , 'item' );
                return view('sales_out_list')->with($data);
            }
    
            elseif (!is_null($customer_name) && is_null($item) && !is_null($vehicle_no))
            {
                $sales_out = Sales_out::where([
                    ['customer_name' , 'LIKE' , "%$customer_name%"],
                    ['vehicle_no' , 'LIKE' , "%$vehicle_no"]
                ])->get();
                $data = compact('sales_out' , 'customer_name' , 'vehicle_no');
                return view('sales_out_list')->with($data);
            }
    
            elseif (is_null($customer_name) && !is_null($item) && !is_null($vehicle_no))
            {
                $sales_out = Sales_out::where([
                    ['item' , 'LIKE' , "%$item%"],
                    ['vehicle_no' , 'LIKE' , "%$vehicle_no"]
                ])->get();
                $data = compact('sales_out' , 'item' , 'vehicle_no');
                return view('sales_out_list')->with($data);
            }
    
            elseif(!is_null($customer_name))
            {
                $sales_out = Sales_out::where([
                    ['customer_name' , 'LIKE' , "%$customer_name%"],
                ])->get();
                $data = compact('sales_out' , 'customer_name');
                return view('sales_out_list')->with($data);
            }
    
            elseif(!is_null($item))
            {
                $sales_out = Sales_out::where([
                    ['item' , 'LIKE' , "%$item%"],
                ])->get();
                $data = compact('sales_out' , 'item');
                return view('sales_out_list')->with($data);
            }
    
            elseif(!is_null($vehicle_no))
            {
                $sales_out = Sales_out::where([
                    ['vehicle_no' , 'LIKE' , "%$vehicle_no"],
                ])->get();
                $data = compact('sales_out' , 'vehicle_no');
                return view('sales_out_list')->with($data);
            }
            else
            {
                session()->flash('no_record', '* No Parameters For Search. *');
                return redirect()->back();
            }
        }

        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function find_vehicle(Request $request)
    {
        if(session()->has('username'))
        {
            if ($request->ajax())
            {
                $all_vehicles = Vehicles::where([['vehicle_no' , 'LIKE' , "%".$request->vehicle_no]])->get();
                $output = '';
                if (count($all_vehicles)>0)
                {
                    $output = "<ul class='list-group' style='display:block; position:relative; z-index:1;'>"; 
                     foreach ($all_vehicles as $vehicle)
                     {
                        $output .= "<li class='list-group-item'>".$vehicle->vehicle_no."'</li>'";
                     }
                    $output .= "</ul>";
                }
                return $output;
            }
            return view('direct_sales');
        }
    }

}
