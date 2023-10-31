<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Contractor;
use App\Models\Purchase_in;
use App\Models\Purchase_out;
use App\Models\Sales_in;
use App\Models\Sales_out;
use App\Models\Store_in;
use App\Models\Store_out;
use App\Models\Fuel_in;
use App\Models\Fuel_out;


class PrintController extends Controller
{
    // Function To Print Employee Details
    public function print_employee_details($id)
    {
        $print_details = Employees::find($id);
        if(!is_null($print_details))
        {
            $data = compact('print_details');
            return view('view_employee')->with($data);
        }
    }

    // Function To Print Contractor Details
    public function print_contractor_details($id)
    {
        $print_details = Contractor::find($id);
        if (!is_null($print_details))
        {
            $data = compact('print_details');
            return view('view_contractor')->with($data);
        }
    }

    // Function To Print Purchase-In
    public function print_purchase_in($id)
    {
        $purchase_in = Purchase_in::find($id);
        $data = compact('purchase_in');
        return view('purchase_in_print')->with($data);
    }

    // Function To Print Purchase Out
    public function print_purchase_out($id)
    {
        $purchase_out = Purchase_out::find($id);
        $data = compact('purchase_out');
        return view('purchase_out_print')->with($data);
    }

    // Function To Print Sales In
    public function print_sales_in($id)
    {
        $sales_in = Sales_in::find($id);
        $data = compact('sales_in');
        return view('sales_in_print')->with($data);
    }

    // Function To Print Sales Out
    public function print_sales_out($id)
    {
        $sales_out = Sales_out::find($id);
        $data = compact('sales_out');
        return view('sales_out_print')->with($data);
    }

    // Function To Print Store-In
    public function print_store_in($id)
    {
        $store_in = Store_in::find($id);
        $data = compact('store_in');
        return view('store_in_print')->with($data);
    }

    // Function To Print Store-Out
    public function print_store_out($id)
    {
        $store_out = Store_out::find($id);
        $data = compact('store_out');
        return view('store_out_print')->with($data);
    }

    // Function To Print Fuel-In
    public function print_fuel_in($id)
    {
        $fuel_in = Fuel_in::find($id);
        $data = compact('fuel_in');
        return view('fuel_in_print')->with($data);
    }

    // Function To Print Fuel-Out
    public function print_fuel_out($id)
    {
        $fuel_out = Fuel_out::find($id);
        $data = compact('fuel_out');
        return view('fuel_out_print')->with($data);
    }
}
