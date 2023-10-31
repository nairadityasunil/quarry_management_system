<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Purchase_in;
use App\Models\Purchase_out;
use App\Models\Pending_purchase;
use App\Models\Item;
use App\Models\Vehicles;
use App\Models\Lease;


class PurchaseController extends Controller
{
    // Functions For Direct Purchase
    public function direct_purchase()
    {
        if(session()->has('username'))
        {
            $all_vehicles = Vehicles::where([['group' , '=' , "Purchase Group"]])->get();
            $item = Item::all();
            $lease = Lease::all();
            $pending_p = Pending_purchase::all();
            $current_date_time = Carbon::now()->toDateTimeString();
            $data = compact('all_vehicles' , 'item' ,'current_date_time' , 'pending_p' , 'lease');
            return view('direct_purchase')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function store_direct_purchase(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate([
                'lease'=>'required',
                'purch_company'=>'required|regex:/^[a-z A-Z]+$/',
                'supplier'=>'required|regex:/^[a-z A-Z]+$/',
                'date_time'=>'required',
                'item'=>'required',
                'vehicle_no'=>'required|alphanum',
                'driver_name'=>'required|regex:/^[a-z A-Z]+$/',
                'tare_weight'=>'required|numeric',
                'net_weight'=>'required|numeric',
                'gross_weight'=>'required|numeric'
            ],
            [
                'lease.required'=>'* Please Select Lease. *',
                'purch_company.required'=>'* Please Enter Company Name. *',
                'purch_company.regex'=>'* Please Enter Only Alphabets In Company Name. *',
                'vehicle_no.required'=>'* Please Enter Vehicle Number. *',
                'vehicle_no.alphanum'=>'* Please Select A Vehicle. *',
                'supplier.required'=>'* Please Enter Supplier Name. *',
                'supplier.regex'=>'* Please Enter Only Alphabets In Supplier Name. *',
                'item.required'=>'* Please Select An Item. *',
                'driver_name.required'=>'* Please Enter Driver Name. *',
                'driver_name.regex'=>'* Please Enter Only Alphabets In Driver Name. *',
                'tare_weight.required'=>'Select Vehicle To Get Tare Weight. *',
                'tare_weight.numeric'=>'Only Numeric Values Allowed For Weight. *',
                'gorss_weight.required'=>'* Please Enter Gross Weight. *',
                'gross_weight.numeric'=>'Enter Integer Or Decimal Values In Gross Weight. *',
                'net_weight.required'=>'* Please Select Vehicle And Enter Gross Weight To Get Net Weight. *'
            ]
            );
            $purchase_out = new Purchase_out;
            $purchase_out->lease = $request['lease'];
            $purchase_out->purch_company = $request['purch_company'];
            $purchase_out->supplier = $request['supplier'];
            $purchase_out->date_time = $request['date_time'];
            $purchase_out->item = $request['item'];
            $purchase_out->vehicle_no = $request['vehicle_no'];
            $purchase_out->driver_name = $request['driver_name'];
            $purchase_out->tare_weight = $request['tare_weight'];
            $purchase_out->gross_weight = $request['gross_weight'];
            $purchase_out->net_weight = $request['net_weight'];
            
            if ($purchase_out->save())
            {
                $last_purchase_out = Purchase_out::all()->last();
                $last_purchase_out_id = $last_purchase_out->id;
                $purchase_in_find_last = Purchase_in::find($last_purchase_out_id);
    
                if(is_null($purchase_in_find_last))
                {
                    $purchase_in = new Purchase_in;
                    $purchase_in->lease = $request['lease'];
                    $purchase_in->purch_company = $request['purch_company'];
                    $purchase_in->vehicle_no = $request['vehicle_no'];
                    $purchase_in->supplier = $request['supplier'];
                    $purchase_in->item = $request['item'];
                    $purchase_in->tare_weight = $request['tare_weight'];
                    
                    if ($purchase_in->save())
                    {
                        echo "<script>alert('Direct Purchase Saved!!');</script>";
                    }
                }
                else
                {
                    $pending_p_delete = Pending_purchase::find($request['ticket_no']); 
                    if (!is_null($pending_p_delete))
                    {
                        $pending_p_delete->delete();
                    }
                    echo "<script>alert('Direct Purchase Saved!!');</script>";
                }
            }
            else
            {
                echo "<script>alert('Direct Purchase Not Saved!!');</script>";
            }
            $item = Item::all();
            $lease = Lease::all();
            $all_vehicles = Vehicles::where([['group' , '=' , "Purchase Group"]])->get();
            $pending_p = Pending_purchase::all();
            $data = compact('pending_p' , 'item' , 'lease' , 'all_vehicles');
            return view('purchase_in_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Functions For Purchase In Section 
    public function get_purchase()
    {
        if (session()->has('username'))
        {
            $all_vehicles = Vehicles::where([['group' , '=' , "Purchase Group"]])->get();
            $item = Item::all();
            $lease = Lease::all();
            $pending_p = Pending_purchase::all();
            $data = compact('pending_p', 'item', 'all_vehicles','lease');
            return view('purchase_in_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function purchase_in_list()
    {
        if(session()->has('username'))
        {
            $purchase_in = Purchase_in::all();
            $data = compact('purchase_in');
            return view('purchase_in_list')->with($data);
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
            $all_vehicles = Vehicles::where([['group' , '=' , "Purchase Group"]])->get();
            $item = Item::all();
            $pending_p = Pending_purchase::all();
            $pending_purchase = Pending_purchase::find($id);
            $current_date_time = Carbon::now()->toDateTimeString();
            $data = compact('pending_p' , 'pending_purchase' , 'current_date_time' , 'item' , 'all_vehicles');
            return view('purchase_out_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function store_purchase_in(Request $request)
    {
        if (session()->has('username'))
        {
            $request->validate(
                [
                    'lease'=>'required',
                    'purch_company'=>'required|regex:/^[a-z A-Z]+$/',
                    'vehicle_no'=>'required|alphanum',
                    'supplier'=>'required|regex:/^[a-z A-Z]+$/',
                    'item'=>'required',
                    'tare_weight'=>'required|numeric',
                ],
                [
                    'lease.required'=>'* Please Select Lease. *',
                    'purch_company.required'=>'* Please Enter Company Name. *',
                    'purch_company.regex'=>'* Please Enter Only Alphabets In Company Name. *',
                    'vehicle_no.required'=>'* Please Enter Vehicle Number. *',
                    'vehicle_no.alphanum'=>'* Please Enter Valid Vehicle Number. *',
                    'supplier.required'=>'* Please Enter Supplier Name. *',
                    'supplier.regex'=>'* Please Enter Only Alphabets In Supplier Name. *',
                    'item.required'=>'* Please Select An Item. *',
                    'tare_weight.required'=>'* Please Enter Tare Weight. *',
                    'tare_weight.numeric'=>'* Enter Integer Or Decimal Values In Tare Weight. *'
                ]
            );
            $purchase_in = new Purchase_in;
            $purchase_in->lease = $request['lease'];
            $purchase_in->purch_company = $request['purch_company'];
            $purchase_in->vehicle_no = $request['vehicle_no'];
            $purchase_in->supplier = $request['supplier'];
            $purchase_in->item = $request['item'];
            $purchase_in->tare_weight = $request['tare_weight'];
            $purchase_in->save();
    
            $pending_purchase = new Pending_purchase;
            $pending_purchase->lease = $request['lease'];
            $pending_purchase->purch_company = $request['purch_company'];
            $pending_purchase->vehicle_no = $request['vehicle_no'];
            $pending_purchase->supplier = $request['supplier'];
            $pending_purchase->item = $request['item'];
            $pending_purchase->tare_weight = $request['tare_weight'];
            $pending_purchase->save();
    
            $all_vehicles = Vehicles::where([['group' , '=' , "Purchase Group"]])->get();
            $item = Item::all();
            $lease = Lease::all();
            $pending_p = Pending_purchase::all();
            $data = compact('pending_p' , 'item' ,'lease' , 'all_vehicles');
            return view('purchase_in_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    } 

    public function get_pending_purchase_list()
    {
        if(session()->has('username'))
        {
            $pending_p = Pending_purchase::all();
            $data = compact('pending_p');
            return view('pending_purchase')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // public function delete_purchase_in($id)
    // {
    //     if(session()->has('username'))
    //     {
    //         $delete_purchase_in = Purchase_in::find($id);
    //         if (!is_null($delete_purchase_in))
    //         {
    //             if($delete_purchase_in->delete())
    //             {
    //                 $delete_purchase_out = Purchase_out::find($id);
    //                 if ($delete_purchase_out->delete())
    //                 {
    //                     echo "<script>alert('Purchase In Entry Deleted!!');</script>";
    //                 }
    //             }
    //             else
    //             {
    //                 echo "<script>alert('Purchase In Entry Not Deleted!!');</script>";
    //             }
    //         }
    //         return redirect('/purchase_in_list');
    //     }
    //     else
    //     {
    //         return redirect('/');
    //     }  
    // }

    // public function update_purchase_in($id)
    // {
    //     if(session()->has('username'))
    //     {
    //         $purchase_id_details = Purchase_in::find($id);
    //         if (!is_null($purchase_id_details))
    //         {
    //             $all_vehicles = Vehicles::where([['group' , '=' , "Purchase Group"]])->get();
    //             $item = Item::all();
    //             $lease = Lease::all();
    //             $data = compact('purchase_id_details' , 'item' , 'lease' , 'all_vehicles');
    //             return view('update_purchase_in')->with($data);
    //         }
    //     }
    //     else
    //     {
    //         return redirect('/');
    //     }
    // }

    // public function confirm_purchase_in_update(Request $request)
    // {
    //     if(session()->has('username'))
    //     {

    //     }
    //     $confirm_update_id = Purchase_in::find($request->id);
    //     if (!is_null($confirm_update_id))
    //     {
    //         $confirm_update_id->lease = $request['lease'];
    //         $confirm_update_id->purch_company = $request['purch_company'];
    //         $confirm_update_id->vehicle_no = $request['vehicle_no'];
    //         $confirm_update_id->supplier = $request['supplier'];
    //         $confirm_update_id->item = $request['item'];
    //         $confirm_update_id->tare_weight = $request['tare_weight'];
    //         $confirm_update_id->save();

    //         $confirm_update_id_purchase_out = Purchase_out::find($request->id);
    //         if (!is_null($confirm_update_id_purchase_out))
    //         {
    //             $confirm_update_id_purchase_out->lease = $request['lease'];
    //             $confirm_update_id_purchase_out->purch_company = $request['purch_company'];
    //             $confirm_update_id_purchase_out->vehicle_no = $request['vehicle_no'];
    //             $confirm_update_id_purchase_out->supplier = $request['supplier'];
    //             $confirm_update_id_purchase_out->item = $request['item'];
    //             $confirm_update_id_purchase_out->tare_weight = $request['tare_weight'];
                
    //             if ($confirm_update_id_purchase_out->save())
    //             {
    //                 echo "<script>alert('Entry Updated!!');</script>";
    //                 $purchase_in = Purchase_in::all();
    //                 $data = compact('purchase_in');
    //                 return view('purchase_in_list')->with($data);
    //             }
    //         }
    //         else 
    //         {
    //             echo "<script>alert('Unable To Update Entry!!');</script>";
    //             $purchase_in = Purchase_in::all();
    //             $data = compact('purchase_in');
    //             return view('purchase_in_list')->with($data);
    //         }
    //     }
    // }

    public function search_purchase_in_list(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate([
                'search_item'=>'required|alphanum'
                ],
                [
                    'search_item.required'=>'* Please Enter Vehicle Number. *',
                    'search_item.alphanum'=>'* Please Enter Valid Vehicle Number. *'
                ]
            );
            $search_item = $request['search_item'];
            $purchase_in = Purchase_in::where('vehicle_no' , 'LIKE' , "%$search_item")->get();
            $data = compact('purchase_in' , 'search_item');
            return view('purchase_in_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_pending_purchase_list(Request $request)
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
            $pending_p = Pending_purchase::where('vehicle_no' , 'LIKE' , "%$search_item")->get();
            $data = compact('pending_p' , 'search_item');
            return view('pending_purchase')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }


    // Functions For Purchase Out Section
    public function get_purchase_out()
    {
        if(session()->has('username'))
        {
            $all_vehicles = Vehicles::where([['group' , '=' , "Purchase Group"]])->get();
            $current_date_time = Carbon::now()->toDateTimeString();
            $pending_p = Pending_purchase::all();
            $item = Item::all();
            $data = compact('pending_p' , 'current_date_time' , 'item' , 'all_vehicles');
            return view('purchase_out_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function purchase_out_list()
    {
        if(session()->has('username'))
        {
            $purchase_out = Purchase_out::all();
            $data = compact('purchase_out');
            return view('purchase_out_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function store_purchase_out(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate([
                'ticket_no'=>'required',
                'lease'=>'required',
                'purch_company'=>'required|regex:/^[a-z A-Z]+$/',
                'supplier'=>'required|regex:/^[a-z A-Z]+$/',
                'date_time'=>'required',
                'item'=>'required',
                'vehicle_no'=>'required|alphanum',
                'driver_name'=>'required|regex:/^[a-z A-Z]+$/',
                'tare_weight'=>'required|numeric',
                'net_weight'=>'required|numeric',
                'gross_weight'=>'required|numeric'
            ],
            [
                'ticket_no'=>'* Ticket Number Field Is Required. *',
                'lease.required'=>'* Please Select Lease. *',
                'purch_company.required'=>'* Please Enter Company Name. *',
                'purch_company.regex'=>'* Please Enter Only Alphabets In Company Name. *',
                'vehicle_no.required'=>'* Please Enter Vehicle Number. *',
                'vehicle_no.alphanum'=>'* Please Enter Valid Vehicle Number. *',
                'supplier.required'=>'* Please Enter Supplier Name. *',
                'supplier.regex'=>'* Please Enter Only Alphabets In Supplier Name. *',
                'item.required'=>'* Please Select An Item. *',
                'driver_name.required'=>'* Please Enter Driver Name. *',
                'driver_name.regex'=>'* Please Enter Only Alphabets In Driver Name. *',
                'gross_weight.required'=>'* Please Enter Gross Weight. *',
                'gross_weight.numeric'=>'* Enter Integer Or Decimal Values In Gross Weight. *',
                'tare_weight.required'=>'* Tare Weight Is Required. *',
                'tare_weight.numeric'=>'* Only Integer Or Decimal Values Allowed For Tare Weight. *',
                'net_weight.required'=>'* Net Weight Is Required. *',
                'net_weight.numeric'=>'* Only Integer Or Decimal Values Allowed In Net Weight. *'
            ]
            );
            $purchase_out = new Purchase_out;
            $purchase_out->lease = $request['lease'];
            $purchase_out->purch_company = $request['purch_company'];
            $purchase_out->supplier = $request['supplier'];
            $purchase_out->date_time = $request['date_time'];
            $purchase_out->item = $request['item'];
            $purchase_out->vehicle_no = $request['vehicle_no'];
            $purchase_out->driver_name = $request['driver_name'];
            $purchase_out->tare_weight = $request['tare_weight'];
            $purchase_out->gross_weight = $request['gross_weight'];
            $purchase_out->net_weight = $request['net_weight'];
            
            if ($purchase_out->save())
            {
                $last_purchase_out = Purchase_out::all()->last();
                $last_purchase_out_id = $last_purchase_out->id;
                $purchase_in_find_last = Purchase_in::find($last_purchase_out_id);
    
                if(is_null($purchase_in_find_last))
                {
                    $purchase_in = new Purchase_in;
                    $purchase_in->lease = $request['lease'];
                    $purchase_in->purch_company = $request['purch_company'];
                    $purchase_in->vehicle_no = $request['vehicle_no'];
                    $purchase_in->supplier = $request['supplier'];
                    $purchase_in->item = $request['item'];
                    $purchase_in->tare_weight = $request['tare_weight'];
                    
                    if ($purchase_in->save())
                    {
                        echo "<script>alert('Purchase Out Saved!!');</script>";
                    }
                }
                else
                {
                    $pending_p_delete = Pending_purchase::find($request['ticket_no']); 
                    if (!is_null($pending_p_delete))
                    {
                        $pending_p_delete->delete();
                    }
                    echo "<script>alert('Purchase Out Saved!!');</script>";
                }
            }
            else
            {
                echo "<script>alert('Purchase Out Not Saved!!');</script>";
            }
            $item = Item::all();
            $lease = Lease::all();
            $all_vehicles = Vehicles::where([['group' , '=' , "Purchase Group"]])->get();
            $pending_p = Pending_purchase::all();
            $data = compact('pending_p' , 'item' , 'lease' , 'all_vehicles');
            return view('purchase_in_entry')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
        
    }

    public function delete_purchase_out($id)
    {
        if(session()->has('username'))
        {
            $delete_purchase_out = Purchase_out::find($id);
            if (!is_null($delete_purchase_out))
            {
                if($delete_purchase_out->delete())
                {
                    $delete_purchase_in = Purchase_in::find($id);
                    if($delete_purchase_in->delete())
                    {
                        session()->flash('status' , 'Entry Deleted !!!');
                        return redirect('/purchase_out_list');
                    }
                }
                else
                {
                    session()->flash('status' , 'Entry Not Deleted !!!');
                    return redirect('/purchase_out_list');
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

    public function update_purchase_out($id)
    {
        if(session()->has('username'))
        {
            $purchase_out_id_details = Purchase_out::find($id);
            if (!is_null($purchase_out_id_details))
            {
                $item = Item::all();
                $lease = Lease::all();
                $all_vehicles = Vehicles::where([['group' , '=' , "Purchase Group"]])->get();
                $data = compact('purchase_out_id_details' , 'item' , 'lease' , 'all_vehicles');
                return view('update_purchase_out')->with($data);
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm_purchase_out_update(Request $request)
    {
        if(session()->has('username'))
        {
            $confirm_update_id = Purchase_out::find($request->id);
            if (!is_null($confirm_update_id))
            {
                $request->validate([
                    'id'=>'required',
                    'lease'=>'required',
                    'purch_company'=>'required|regex:/^[a-z A-Z]+$/',
                    'supplier'=>'required|regex:/^[a-z A-Z]+$/',
                    'date_time'=>'required',
                    'item'=>'required',
                    'vehicle_no'=>'required|alphanum',
                    'driver_name'=>'required|regex:/^[a-z A-Z]+$/',
                    'gross_weight'=>'required|numeric'
        
                ],
                [
                    'id'=>'* Ticket Number Field Is Required. *',
                    'lease.required'=>'* Please Select Lease. *',
                    'purch_company.required'=>'* Please Enter Company Name. *',
                    'purch_company.regex'=>'* Please Enter Only Alphabets In Company Name. *',
                    'vehicle_no.required'=>'* Please Enter Vehicle Number. *',
                    'vehicle_no.alphanum'=>'* Please Enter Valid Vehicle Number. *',
                    'supplier.required'=>'* Please Enter Supplier Name. *',
                    'supplier.regex'=>'* Please Enter Only Alphabets In Supplier Name. *',
                    'item.required'=>'* Please Select An Item. *',
                    'driver_name.required'=>'* Please Enter Driver Name. *',
                    'driver_name.regex'=>'* Please Enter Only Alphabets In Driver Name. *',
                    'gorss_weight.required'=>'* Please Enter Gross Weight. *',
                    'gross_weight.numeric'=>'* Enter Integer Or Decimal Values In Gross Weight. *',
                ]
                );
                $confirm_update_id->lease = $request['lease'];
                $confirm_update_id->purch_company = $request['purch_company'];
                $confirm_update_id->supplier = $request['supplier'];
                $confirm_update_id->date_time = $request['date_time'];
                $confirm_update_id->item = $request['item'];
                $confirm_update_id->vehicle_no = $request['vehicle_no'];
                $confirm_update_id->driver_name = $request['driver_name'];
                $confirm_update_id->tare_weight = $request['tare_weight'];
                $confirm_update_id->gross_weight = $request['gross_weight'];
                $confirm_update_id->net_weight = $request['net_weight'];
                $confirm_update_id->save();
    
                $confirm_update_id_purchase_out = Purchase_in::find($request->id);
                if (!is_null($confirm_update_id_purchase_out))
                {
                    $confirm_update_id_purchase_out->lease = $request['lease'];
                    $confirm_update_id_purchase_out->purch_company = $request['purch_company'];
                    $confirm_update_id_purchase_out->vehicle_no = $request['vehicle_no'];
                    $confirm_update_id_purchase_out->supplier = $request['supplier'];
                    $confirm_update_id_purchase_out->item = $request['item'];
                    $confirm_update_id_purchase_out->tare_weight = $request['tare_weight'];
                    
                    if ($confirm_update_id_purchase_out->save())
                    {
                        // echo "<script>alert('Entry Updated!!');</script>";
                        // $purchase_out = Purchase_out::all();
                        // $data = compact('purchase_out');
                        // return view('purchase_out_list')->with($data);
                        session()->flash('status' , 'Entry Updated !!!');
                        return redirect('/purchase_out_list');
                    }
                }
                else 
                {
                    // echo "<script>alert('Unable To Update Entry!!');</script>";
                    // $purchase_out = Purchase_out::all();
                    // $data = compact('purchase_out');
                    // return view('purchase_out_list')->with($data);
                    session()->flash('status' , 'Entry Not Updated !!!');
                    return redirect('/purchase_out_list');
                }
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_purchase_out_list(Request $request)
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
            $purchase_out = Purchase_out::where('vehicle_no' , 'LIKE' , "%$search_item")->get();
            $data = compact('purchase_out' , 'search_item');
            return view('purchase_out_list')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
}