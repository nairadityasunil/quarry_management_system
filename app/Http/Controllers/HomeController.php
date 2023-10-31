<?php

namespace App\Http\Controllers;
use App\Models\Pending_purchase;
use App\Models\Pending_sales;
use App\Models\Purchase_out;
use App\Models\Sales_out;
use App\Models\Vehicles;
use App\Models\Employees;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function home()
    {
        if(session()->has('username'))
        {
            $pending_purchase = Pending_purchase::all();
            $total_pending_purchase = count($pending_purchase);
            $pending_sales = Pending_sales::all();
            $total_pending_sales = count($pending_sales);
            $current_date = Carbon::now();
            $current_date = $current_date->toDateTimeString();
            $current_date = Str::substr($current_date , 0 ,10);
    
            // Total Purchase
            $total_purchase = Purchase_out::all();
            $total_purchase_quantity = 0;
            foreach ($total_purchase as $tp)
            {
                $total_purchase_quantity = $total_purchase_quantity + $tp->net_weight;
            }
    
            // Total Purchase Today
            $purchase_out_details = Purchase_out::whereBetween('created_at', [$current_date.' 00:00:00', $current_date.' 23:59:59'])->first();
            $purchase_out_details = Purchase_out::whereBetween('created_at', [$current_date.' 00:00:00', $current_date.' 23:59:59'])->get();
            if($purchase_out_details)
            {
                $purchase_out_details = Purchase_out::whereBetween('created_at', [$current_date.' 00:00:00', $current_date.' 23:59:59'])->get();
                $purchase_today_trips = count($purchase_out_details);
                $total_purchase_today = 0;
                foreach ($purchase_out_details as $p_o_d)
                {
                    $total_purchase_today = $total_purchase_today + $p_o_d->net_weight;
                }
            }
            else
            {
                $purchase_today_trips = 0;
                $total_purchase_today = 0;
            }
    
            // Total Sales
            $total_sales = Sales_out::all();
            $total_sales_quantity = 0;
            foreach ($total_sales as $ts)
            {
                $total_sales_quantity = $total_sales_quantity + $ts->net_weight;
            }
            
            // Total Sales Today
            $sales_out_details = Sales_out::whereBetween('created_at', [$current_date.' 00:00:00', $current_date.' 23:59:59'])->first();
            $sales_out_details = Sales_out::whereBetween('created_at', [$current_date.' 00:00:00', $current_date.' 23:59:59'])->get();
            if($sales_out_details)
            {
                $sales_out_details = Sales_out::whereBetween('created_at', [$current_date.' 00:00:00', $current_date.' 23:59:59'])->get();
                $sales_today_trips = count($sales_out_details);
                $total_sales_today = 0;
                foreach ($sales_out_details as $s_o_d)
                {
                    echo $s_o_d->quantity;
                    $total_sales_today = $total_sales_today + $s_o_d->net_weight;
                }
            }
            else
            {
                $sales_today_trips = 0;
                $total_sales_today = 0;
            }
    
            // Purchase_vehicles
            $purchase_vehicles = Vehicles::where('group' , '=' , 'Purchase Group')->get();
            $total_purchase_vehicles = count($purchase_vehicles);
    
            // Sales Vehicels
            $sales_vehicles = Vehicles::where('group' , '=' , 'Sales Group')->get();
            $total_sales_vehicles = count($sales_vehicles);
    
            // Employees
            $employees = Employees::all();
            $total_employees = count($employees);
            $data = compact('pending_purchase' , 'pending_sales' , 'purchase_out_details' , 'sales_out_details' ,'total_purchase_today' , 'total_sales_today' , 'total_purchase_quantity' ,'total_purchase_vehicles' , 'total_sales_quantity' , 'total_sales_vehicles' , 'total_employees' , 'purchase_today_trips' , 'sales_today_trips' , 'total_pending_purchase' , 'total_pending_sales');
            return view('home')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
}
