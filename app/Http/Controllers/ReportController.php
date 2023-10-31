<?php

namespace App\Http\Controllers;


use PDF;
use Illuminate\Http\Request;
use App\Models\Purchase_in;
use App\Models\Purchase_out;
use App\Models\Sales_out;
use App\Models\Mail_report;
use App\Models\Fuel_in;
use App\Models\Fuel_out;
use App\Models\Fuel_available;
use App\Models\Store_in;
use App\Models\Store_out;
use App\Models\Store_status;
use App\Exports\Sales_excel;
use App\Exports\Sales_in_excel;
use App\Exports\Sales_full_excel;
use App\Exports\Purchase_excel;
use App\Exports\Purchase_full_excel;
use App\Exports\Purchase_in_excel;
use App\Exports\Fuel_in_excel;
use App\Exports\Fuel_out_excel;
use App\Exports\Fuel_available_excel;
use App\Exports\Store_in_excel;
use App\Exports\Store_out_excel;
use App\Exports\Store_status_excel;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    // Function Related To Report Master
    public function report_master()
    {
        if(session()->has('username'))
        {
            $all_mails = Mail_report::all();
            $data = compact('all_mails');
            return view('report_master')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Functions To Get Purchase Report
    public function get_purchase_report(Request $request)
    {
        if(session()->has('username'))
        {
            $purchase_details = Purchase_out::whereBetween('created_at', [$request->purchase_date_from.' 00:00:00', $request->purchase_date_to.' 23:59:59'])->first();
            if ($purchase_details)
            {
                $purchase_details = Purchase_out::whereBetween('created_at', [$request->purchase_date_from.' 00:00:00', $request->purchase_date_to.' 23:59:59'])->get();
                $data = compact('purchase_details');
                $request->session()->put('email' , $request->email);
                $request->session()->put('purchase_from',$request->purchase_date_from);
                $request->session()->put('purchase_to', $request->purchase_date_to);
                return view('purchase_report')->with($data);
            }
            else
            {
                session()->flash('purchase_status','Error : No Records Found');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_purchase_pdf()
    {
        if(session()->has('username'))
        {
            $purchase_from = session()->get('purchase_from');
            $purchase_to = session()->get('purchase_to');
            $purchase_details = Purchase_out::whereBetween('created_at', [$purchase_from.' 00:00:00', $purchase_to.' 23:59:59'])->get();
            $data = compact('purchase_details');
            $pdf = PDF::loadView('purchase_pdf' ,$data);
            return $pdf->download('purchase_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_purchase_full_pdf()
    {
        if(session()->has('username'))
        {
            $purchase_details= Purchase_out::all();
            $data = compact('purchase_details');
            $pdf = PDF::loadView('purchase_pdf' ,$data);
            return $pdf->download('purchase_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_purchase_in_pdf()
    {
        if(session()->has('username'))
        {
            $purchase_details= Purchase_in::all();
            $data = compact('purchase_details');
            $pdf = PDF::loadView('purchase_in_pdf' ,$data);
            return $pdf->download('purchase_in_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_purchase_full_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Purchase_full_excel , 'purchase_full_report.xlsx');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_purchase_in_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Purchase_in_excel , 'purchase_in_report.xlsx');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function mail_purchase_pdf()
    {
        if(session()->has('username'))
        {
            $purchase_from = session()->get('purchase_from');
            $purchase_to = session()->get('purchase_to');
            $purchase_details = Purchase_out::whereBetween('created_at', [$purchase_from.' 00:00:00', $purchase_to.' 23:59:59'])->get();
            $data = compact('purchase_details');
            $pdf = PDF::loadView('purchase_pdf' ,$data);
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Purchase Report PDF',
                'body' => 'Purchase Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $data, $pdf){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($pdf->output(), "purchase_report.pdf");
            });
    
            session()->flash('purchase_mail_status','Purchase PDF Report Sent As Mail');
            return redirect('/report_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_purchase_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Purchase_excel , 'purchase_report.xlsx');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function mail_purchase_excel()
    {
        if(session()->has('username'))
        {
            $purchase_from = session()->get('purchase_from');
            $purchase_to = session()->get('purchase_to');
            $purchase_details = Purchase_out::whereBetween('created_at', [$purchase_from.' 00:00:00', $purchase_to.' 23:59:59'])->get();
            $type = 'xlsx';
    
            $attachment = Excel::raw(new Purchase_excel , 'Xlsx');
    
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Purchase Report Excel',
                'body' => 'Purchase Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $attachment){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($attachment , 'purchase_report.xlsx');
            });
            session()->flash('purchase_mail_status','Purchase Report Excel Sent As Mail');
            return redirect('/report_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Functions To Get Sales Report
    public function get_sales_report(Request $request)
    {
        if(session()->has('username'))
        {
            $sales_details = Sales_out::whereBetween('created_at', [$request->sales_date_from.' 00:00:00', $request->sales_date_to.' 23:59:59'])->first();
            if ($sales_details)
            {
                $sales_details = Sales_out::whereBetween('created_at', [$request->sales_date_from.' 00:00:00', $request->sales_date_to.' 23:59:59'])->get();
                $data = compact('sales_details');
                $request->session()->put('email' , $request->email);
                $request->session()->put('sales_from',$request->sales_date_from);
                $request->session()->put('sales_to', $request->sales_date_to);
                return view('sales_report')->with($data);
            }
            else
            {
                session()->flash('sales_status','Error : No Records Found');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_sales_pdf()
    {
        if(session()->has('username'))
        {
            $sales_from = session()->get('sales_from');
            $sales_to = session()->get('sales_to');
            $sales_details = Sales_out::whereBetween('created_at', [$sales_from.' 00:00:00', $sales_to.' 23:59:59'])->get();
            $data = compact('sales_details');
            $pdf = PDF::loadView('sale_pdf' ,$data);
            return $pdf->download('sales_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_sales_full_pdf()
    {
        if(session()->has('username'))
        {
            $sales_details = Sales_out::all();
            $data = compact('sales_details');
            $pdf = PDF::loadView('sale_pdf' ,$data);
            return $pdf->download('sales_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_sales_full_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Sales_full_excel , 'sales_full_report.xlsx');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_sales_in_pdf()
    {
        if(session()->has('username'))
        {
            $sales_details = Sales_out::all();
            $data = compact('sales_details');
            $pdf = PDF::loadView('sales_in_pdf' ,$data);
            return $pdf->download('sales_in_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_sales_in_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Sales_in_excel , 'sales_in_report.xlsx');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function mail_sales_pdf()
    {
        if(session()->has('username'))
        {
            $sales_from = session()->get('sales_from');
            $sales_to = session()->get('sales_to');
            $sales_details = Sales_out::whereBetween('created_at', [$sales_from.' 00:00:00', $sales_to.' 23:59:59'])->get();
            $data = compact('sales_details');
            $pdf = PDF::loadView('sale_pdf' ,$data);
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Sales Report PDF',
                'body' => 'Sales Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $data, $pdf){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($pdf->output(), "sales_report.pdf");
            });
    
            session()->flash('sale_mail_status','Sales Report PDF Sent As Mail');
            return redirect('/report_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_sales_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Sales_excel , 'sales_report.xlsx');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function mail_sales_excel()
    {
        if(session()->has('username'))
        {
            $sales_from = session()->get('sales_from');
            $sales_to = session()->get('sales_to');
            $type = 'xlsx';
            $sales_report = Sales_out::whereBetween('created_at', [$sales_from.' 00:00:00', $sales_to.' 23:59:59'])->get();
    
            $attachment = Excel::raw(new Sales_excel , 'Xlsx');
    
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Sales Report Excel',
                'body' => 'Sales Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $attachment){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($attachment , 'sales_report.xlsx');
            });
            session()->flash('sale_mail_status','Sales Report Excel Sent As Mail');
            return redirect('/report_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Functions To Get Fuel-In Report
    public function get_fuel_in_report(Request $request)
    {
        if(session()->has('username'))
        {
            $fuel_in_details = Fuel_in::whereBetween('created_at', [$request->fuel_in_date_from.' 00:00:00', $request->fuel_in_date_to.' 23:59:59'])->first();
            if ($fuel_in_details)
            {
                $fuel_in_details = Fuel_in::whereBetween('created_at', [$request->fuel_in_date_from.' 00:00:00', $request->fuel_in_date_to.' 23:59:59'])->get();
                $data = compact('fuel_in_details');
                $request->session()->put('email' , $request->email);
                $request->session()->put('fuel_in_from',$request->fuel_in_date_from);
                $request->session()->put('fuel_in_to', $request->fuel_in_date_to);
                return view('fuel_in_report')->with($data);
            }
            else
            {
                session()->flash('fuel_in_status','Error : No Records Found');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_fuel_in_pdf()
    {
        if(session()->has('username'))
        {
            $fuel_in_from = session()->get('fuel_in_from');
            $fuel_in_to = session()->get('fuel_in_to');
            $fuel_in_details = Fuel_in::whereBetween('created_at', [$fuel_in_from.' 00:00:00', $fuel_in_to.' 23:59:59'])->get();
            $data = compact('fuel_in_details');
            $pdf = PDF::loadView('fuel_in_pdf' ,$data);
            return $pdf->download('fuel_in_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function mail_fuel_in_pdf()
    {
        if(session()->has('username'))
        {
            $fuel_in_from = session()->get('fuel_in_from');
            $fuel_in_to = session()->get('fuel_in_to');
            $fuel_in_details = Fuel_in::whereBetween('created_at', [$fuel_in_from.' 00:00:00', $fuel_in_to.' 23:59:59'])->get();
            $data = compact('fuel_in_details');
            $pdf = PDF::loadView('fuel_in_pdf' ,$data);
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Fuel-In Report PDF',
                'body' => 'Fuel-In Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $data, $pdf){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($pdf->output(), "fuel_in_report.pdf");
            });
    
            session()->flash('fuel_in_mail_status','Fuel-In Report PDF Sent As Mail');
            return redirect('/report_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
    
    public function download_fuel_in_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Fuel_in_excel , 'fuel_in_report.xlsx');   
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function mail_fuel_in_excel()
    {
        if(session()->has('username'))
        {
            $fuel_in_from = session()->get('fuel_in_from');
            $fuel_in_to = session()->get('fuel_in_to');
            $fuel_in_details = Fuel_in::whereBetween('created_at', [$fuel_in_from.' 00:00:00', $fuel_in_to.' 23:59:59'])->get();
            $type = 'xlsx';
    
            $attachment = Excel::raw(new Fuel_in_excel , 'Xlsx');
    
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Fuel-In Report Excel',
                'body' => 'Fuel-In Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $attachment){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($attachment , 'fuel_in_report.xlsx');
            });
            session()->flash('fuel_in_mail_status','Fuel-In Report Excel Sent As Mail');
            return redirect('/report_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Functions To Get Fuel-Out Report
    public function get_fuel_out_report(Request $request)
    {
        if(session()->has('username'))
        {
            $fuel_out_details = Fuel_out::whereBetween('created_at', [$request->fuel_out_date_from.' 00:00:00', $request->fuel_out_date_to.' 23:59:59'])->first();
            if ($fuel_out_details)
            {
                $fuel_out_details = Fuel_out::whereBetween('created_at', [$request->fuel_out_date_from.' 00:00:00', $request->fuel_out_date_to.' 23:59:59'])->get();
                $data = compact('fuel_out_details');
                $request->session()->put('email' , $request->email);
                $request->session()->put('fuel_out_from',$request->fuel_out_date_from);
                $request->session()->put('fuel_out_to', $request->fuel_out_date_to);
                return view('fuel_out_report')->with($data);
            }
            else
            {
                session()->flash('fuel_out_status','Error : No Records Found');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_fuel_out_pdf()
    {
        if(session()->has('username'))
        {
            $fuel_out_from = session()->get('fuel_out_from');
            $fuel_out_to = session()->get('fuel_out_to');
            $fuel_out_details = Fuel_in::whereBetween('created_at', [$fuel_out_from.' 00:00:00', $fuel_out_to.' 23:59:59'])->get();
            $data = compact('fuel_out_details');
            $pdf = PDF::loadView('fuel_out_pdf' ,$data);
            return $pdf->download('fuel_out_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function mail_fuel_out_pdf()
    {
        if(session()->has('username'))
        {
            $fuel_out_from = session()->get('fuel_out_from');
            $fuel_out_to = session()->get('fuel_out_to');
            $fuel_out_details = Fuel_out::whereBetween('created_at', [$fuel_out_from.' 00:00:00', $fuel_out_to.' 23:59:59'])->get();
            $data = compact('fuel_out_details');
            $pdf = PDF::loadView('fuel_out_pdf' ,$data);
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Fuel-Out Report PDF',
                'body' => 'Fuel-Out Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $data, $pdf){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($pdf->output(), "fuel_out_report.pdf");
            });
    
            session()->flash('fuel_out_mail_status','Fuel-Out Report PDF Sent As Mail');
            return redirect('/report_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
    
    public function download_fuel_out_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Fuel_out_excel , 'fuel_out_report.xlsx');   
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function mail_fuel_out_excel()
    {
        if(session()->has('username'))
        {
            $fuel_out_from = session()->get('fuel_out_from');
            $fuel_out_to = session()->get('fuel_out_to');
            $fuel_out_details = Fuel_out::whereBetween('created_at', [$fuel_out_from.' 00:00:00', $fuel_out_to.' 23:59:59'])->get();
            $type = 'xlsx';
    
            $attachment = Excel::raw(new Fuel_out_excel , 'Xlsx');
    
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Fuel-Out Report Excel',
                'body' => 'Fuel-Out Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $attachment){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($attachment , 'fuel_out_report.xlsx');
            });
            session()->flash('fuel_out_mail_status','Fuel-Out Report Excel Sent As Mail');
            return redirect('/report_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Functions Related To Fuel Available
    public function mail_fuel_available(Request $request)
    {
        if(session()->has('username'))
        {
            $format = $request['format'];
            if ($format == 'pdf')
            { 
                $fuel_available = Fuel_available::all();
                $data = compact('fuel_available');
                $pdf = PDF::loadView('fuel_available_pdf' ,$data);
                $mail_data = [
                    'recipient' => $request['email'],
                    'fromEmail' => 'quarrymanagementsystem@gmail.com',
                    'fromName' => 'Quarry Management System',
                    'subject' => 'Fuel Available Report PDF',
                    'body' => 'Fuel Available Report'
                ];
                
                Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $data, $pdf){
                    $message->to($mail_data['recipient'])
                            ->from($mail_data['fromEmail'], $mail_data['fromName'])
                            ->subject($mail_data['subject'])
                            ->attachData($pdf->output(), "fuel_available_report.pdf");
                });
        
                session()->flash('fuel_available_mail_status','Fuel Available Report PDF Sent As Mail');
                return redirect('/report_master');
            }
            else if($format == 'excel')
            {
                $fuel_available = Fuel_available::all();
                $data = compact('fuel_available');
                $type = 'xlsx';
    
                $attachment = Excel::raw(new Fuel_available_excel , 'Xlsx');
    
                $mail_data = [
                    'recipient' => $request['email'],
                    'fromEmail' => 'quarrymanagementsystem@gmail.com',
                    'fromName' => 'Quarry Management System',
                    'subject' => 'Fuel Available Report Excel',
                    'body' => 'Fuel Available Report'
                ];
            
                Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $attachment){
                    $message->to($mail_data['recipient'])
                            ->from($mail_data['fromEmail'], $mail_data['fromName'])
                            ->subject($mail_data['subject'])
                            ->attachData($attachment , 'fuel_available_report.xlsx');
                });
                session()->flash('fuel_available_mail_status','Fuel Available Report Excel Sent As Mail');
                return redirect('/report_master');
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_fuel_available_pdf()
    {
        if(session()->has('username'))
        {
            $fuel_available = Fuel_available::all();
            $data = compact('fuel_available');
            $pdf = PDF::loadView('fuel_available_pdf' ,$data);
            return $pdf->download('fuel_available_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_fuel_available_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Fuel_available_excel , 'fuel_available_report.xlsx'); 
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        } 
    }

    // Functions To Get Store-In Report
    public function get_store_in_report(Request $request)
    {
        if(session()->has('username'))
        {
            $store_in_details = Store_in::whereBetween('created_at', [$request->store_in_date_from.' 00:00:00', $request->store_in_date_to.' 23:59:59'])->first();
            if ($store_in_details)
            {
                $store_in_details = Store_in::whereBetween('created_at', [$request->store_in_date_from.' 00:00:00', $request->store_in_date_to.' 23:59:59'])->get();
                $data = compact('store_in_details');
                $request->session()->put('email' , $request->email);
                $request->session()->put('store_in_from',$request->store_in_date_from);
                $request->session()->put('store_in_to', $request->store_in_date_to);
                return view('store_in_report')->with($data);
            }
            else
            {
                session()->flash('store_in_status','Error : No Records Found');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        } 
    }

    public function download_store_in_pdf()
    {
        if(session()->has('username'))
        {
            $store_in_from = session()->get('store_in_from');
            $store_in_to = session()->get('store_in_to');
            $store_in_details = Store_in::whereBetween('created_at', [$store_in_from.' 00:00:00', $store_in_to.' 23:59:59'])->get();
            $data = compact('store_in_details');
            $pdf = PDF::loadView('store_in_pdf' ,$data);
            return $pdf->download('store_in_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        } 
    }

    public function mail_store_in_pdf()
    {
        if(session()->has('username'))
        {
            $store_in_from = session()->get('store_in_from');
            $store_in_to = session()->get('store_in_to');
            $store_in_details = Store_in::whereBetween('created_at', [$store_in_from.' 00:00:00', $store_in_to.' 23:59:59'])->get();
            $data = compact('store_in_details');
            $pdf = PDF::loadView('store_in_pdf' ,$data);
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Store-In Report PDF',
                'body' => 'Store-In Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $data, $pdf){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($pdf->output(), "store_in_report.pdf");
            });
    
            session()->flash('store_in_mail_status','Store-In Report PDF Sent As Mail');
            return redirect('/report_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_store_in_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Store_in_excel , 'store_in_report.xlsx');   
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function mail_store_in_excel()
    {
        if(session()->has('username'))
        {
            $store_in_from = session()->get('store_in_from');
            $store_in_to = session()->get('store_in_to');
            $store_in_details = Store_in::whereBetween('created_at', [$store_in_from.' 00:00:00', $store_in_to.' 23:59:59'])->get();
            $type = 'xlsx';
    
            $attachment = Excel::raw(new Store_in_excel , 'Xlsx');
    
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Store-In Report Excel',
                'body' => 'Store-In Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $attachment){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($attachment , 'store_in_report.xlsx');
            });
            session()->flash('store_in_mail_status','Store-In Report Excel Sent As Mail');
            return redirect('/report_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Functions To Get Store-Out Report
    public function get_store_out_report(Request $request)
    {
        if(session()->has('username'))
        {
            $store_out_details = Store_out::whereBetween('created_at', [$request->store_out_date_from.' 00:00:00', $request->store_out_date_to.' 23:59:59'])->first();
            if ($store_out_details)
            {
                $store_out_details = Store_out::whereBetween('created_at', [$request->store_out_date_from.' 00:00:00', $request->store_out_date_to.' 23:59:59'])->get();
                $data = compact('store_out_details');
                $request->session()->put('email' , $request->email);
                $request->session()->put('store_out_from',$request->store_out_date_from);
                $request->session()->put('store_out_to', $request->store_out_date_to);
                return view('store_out_report')->with($data);
            }
            else
            {
                session()->flash('store_in_status','Error : No Records Found');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_store_out_pdf()
    {
        if(session()->has('username'))
        {
            $store_out_from = session()->get('store_out_from');
            $store_out_to = session()->get('store_out_to');
            $store_out_details = Store_out::whereBetween('created_at', [$store_out_from.' 00:00:00', $store_out_to.' 23:59:59'])->get();
            $data = compact('store_out_details');
            $pdf = PDF::loadView('store_out_pdf' ,$data);
            return $pdf->download('store_out_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function mail_store_out_pdf()
    {
        if(session()->has('username'))
        {
            $store_out_from = session()->get('store_out_from');
            $store_out_to = session()->get('store_out_to');
            $store_out_details = Store_out::whereBetween('created_at', [$store_out_from.' 00:00:00', $store_out_to.' 23:59:59'])->get();
            $data = compact('store_out_details');
            $pdf = PDF::loadView('store_out_pdf' ,$data);
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Store-Out Report PDF',
                'body' => 'Store-Out Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $data, $pdf){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($pdf->output(), "store_out_report.pdf");
            });
    
            session()->flash('store_out_mail_status','Store-Out Report PDF Sent As Mail');
            return redirect('/report_master');
        }

        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_store_out_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Store_out_excel , 'store_out_report.xlsx');   
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function mail_store_out_excel()
    {
        if(session()->has('username'))
        {
            $store_out_from = session()->get('store_out_from');
            $store_out_to = session()->get('store_out_to');
            $store_out_details = Store_out::whereBetween('created_at', [$store_out_from.' 00:00:00', $store_out_to.' 23:59:59'])->get();
            $type = 'xlsx';
    
            $attachment = Excel::raw(new Store_out_excel , 'Xlsx');
    
            $mail_data = [
                'recipient' => session()->get('email'),
                'fromEmail' => 'quarrymanagementsystem@gmail.com',
                'fromName' => 'Quarry Management System',
                'subject' => 'Store-Out Report Excel',
                'body' => 'Store-Out  Report'
            ];
            
            Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $attachment){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject'])
                        ->attachData($attachment , 'store_out_report.xlsx');
            });
            session()->flash('store_out_mail_status','Store-In Report Excel Sent As Mail');
            return redirect('/report_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    // Function Related To Store Status
    public function mail_store_status(Request $request)
    { 
        if(session()->has('username'))
        {
            $format = $request['format'];
            if ($format == 'pdf')
            { 
                $store_status = Store_status::all();
                $data = compact('store_status');
                $pdf = PDF::loadView('store_status_pdf' ,$data);
                $mail_data = [
                    'recipient' => $request['email'],
                    'fromEmail' => 'quarrymanagementsystem@gmail.com',
                    'fromName' => 'Quarry Management System',
                    'subject' => 'Store Status Report PDF',
                    'body' => 'Store Status Report'
                ];
                
                Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $data, $pdf){
                    $message->to($mail_data['recipient'])
                            ->from($mail_data['fromEmail'], $mail_data['fromName'])
                            ->subject($mail_data['subject'])
                            ->attachData($pdf->output(), "store_status_report.pdf");
                });
        
                session()->flash('store_status_mail_status','Store Status Report PDF Sent As Mail');
                return redirect('/report_master');
            }
            else if($format == 'excel')
            {
                $store_status = Store_status::all();
                $data = compact('store_status');
                $type = 'xlsx';
    
                $attachment = Excel::raw(new Store_status_excel , 'Xlsx');
    
                $mail_data = [
                    'recipient' => $request['email'],
                    'fromEmail' => 'quarrymanagementsystem@gmail.com',
                    'fromName' => 'Quarry Management System',
                    'subject' => 'Store Status Report Excel',
                    'body' => 'Store Status Report'
                ];
            
                Mail::send('login_mail' , $mail_data, function($message) use ($mail_data, $attachment){
                    $message->to($mail_data['recipient'])
                            ->from($mail_data['fromEmail'], $mail_data['fromName'])
                            ->subject($mail_data['subject'])
                            ->attachData($attachment , 'store_status_report.xlsx');
                });
                session()->flash('store_status_mail_status','Store Status Report Excel Sent As Mail');
                return redirect('/report_master');
            }
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_store_status_pdf()
    {
        if(session()->has('username'))
        {
            $store_status = Store_status::all();
            $data = compact('store_status');
            $pdf = PDF::loadView('store_status_pdf' ,$data);
            return $pdf->download('store_status_report.pdf');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function download_store_status_excel()
    {
        if(session()->has('username'))
        {
            return Excel::download(new Store_status_excel , 'store_status_report.xlsx');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
}