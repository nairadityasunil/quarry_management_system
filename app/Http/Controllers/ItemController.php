<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function item_master()
    {
        if(session()->has('username'))
        {
            $item = Item::all();
            $data = compact('item');
            return view('item_master')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function store_item(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'item_name'=>'required|unique:Item,item_name',
                    'hsn_code'=>'required|unique:Item,hsn_code',
                    'unit_type'=>'required'
                ],
                [
                    'item_name.required'=>'* Please Enter Item Name. *',
                    'item_name.unique'=>'* Item Already Exists. *',
                    'hsn_code.required'=>'* Please Enter HSN Code. *',
                    'hsn_code.unique'=>'* HSN Code Already Exists. *',
                    'unit_type.required'=>'* Please Select Unit Type. *'
                ]
            );
            $item = new Item;
            $item->item_name=$request['item_name'];
            // $item->order_no=$request['order_no'];
            $item->hsn_code=$request['hsn_code'];
            $item->unit_type=$request['unit_type'];
    
            if ($item->save())
            {
                echo "<script>alert('Item Added!!');</script>";
                $item = Item::all();
                $data = compact('item');
                return view('item_master')->with($data);
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function update_item_list($id)
    {
        if(session()->has('username'))
        {
            $item_id_details = Item::find($id);
            if (!is_null($item_id_details))
            {
                $data = compact('item_id_details');
                return view('update_item')->with($data);
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function confirm_item_update(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'item_name'=>'required|unique:Item,item_name,'.$request->id,
                    'hsn_code'=>'required|unique:Item,hsn_code,'.$request->id,
                    'unit_type'=>'required'
                ],
                [
                    'item_name.required'=>'* Please Enter Item Name. *',
                    'item_name.unique'=>'* Item Already Exists. *',
                    'hsn_code.required'=>'* Please Enter HSN Code. *',
                    'hsn_code.unique'=>'* HSN Code Already Exists. *',
                    'unit_type.required'=>'* Please Select Unit Type. *'
                ]
            );
            $confirm_update_id = Item::find($request->id);
            if (!is_null($confirm_update_id))
            {
                $confirm_update_id->item_name = $request['item_name'];
                // $confirm_update_id->order_no = $request['order_no'];
                $confirm_update_id->hsn_code = $request['hsn_code'];
                $confirm_update_id->unit_type = $request['unit_type'];
    
                if ($confirm_update_id->save())
                {
                    // echo "<script>alert('Item Updated!!');</script>";
                    // $item = Item::all();
                    // $data = compact('item');
                    // return view('item_master')->with($data);
                    session()->flash('status' , 'Item Updated !!!');
                    return redirect('/item_master');
                }
                else
                {
                    // echo "<script>alert('Item Not Updated!!');</script>";
                    // $item = Item::all();
                    // $data = compact('item');
                    // return view('item_master')->with($data);
                    session()->flash('status' , 'Item Not Updated !!!');
                    return redirect('/item_master');
                }
            }
        }

        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function delete_item($id)
    {
        if(session()->has('username'))
        {
            $delete_item = Item::find($id);
            if (!is_null($delete_item))
            {
                if($delete_item->delete())
                {
                    // echo "<script>alert('Item Deleted!!');</script>";
                    session()->flash('status' , 'Item Deleted !!!');
                    return redirect('/item_master');
                }
                else
                {
                    // echo "<script>alert('Item Not Deleted!!');</script>";
                    session()->flash('status' , 'Item Not Deleted !!!');
                    return redirect('/item_master');
                }
            }
            return redirect('/item_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function search_item(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'search_item'=>'required'
                ],
                [
                    'search_item.required'=>'* No Parameters For Search. *'
                ]
            );
            $search_item = $request['item'];
            $item = Item::where('item_name' , 'LIKE' , "$search_item%")->get();
            $data = compact('item' , 'search_item');
            return view('item_master')->with($data);
        }

        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
}
