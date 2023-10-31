<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MailController;



// Routes For Login Page
Route::get('/', [LoginController::class , 'check_user'])->name('login');
Route::post('/authentication' , [LoginController::class , 'authentication'])->name('authentication');
Route::get('/send_otp' , function(){return view('send_otp');})->name('send_otp');
Route::post('/send_login_otp' , [LoginController::class , 'send_login_otp'])->name('send_login_otp');
Route::post('/verify_otp' , [LoginController::class , 'verify'])->name('verify_otp');
Route::get('/register' , [LoginController::class , 'check_user'])->name('register');
Route::post('/register_user' , [UserController::class , 'register_user'])->name('register_user');


// Routes Related To Home Page
Route::get('/home' , [HomeController::class , 'home'])->name('home');

// Routes Related To Purchase In
Route::get('/purchase_in_entry', [PurchaseController::class , 'get_purchase'])->name('purchase_in_entry');
Route::post('/purchase_in_entry', [PurchaseController::class , 'store_purchase_in']);
Route::get('/purchase_in_list', [PurchaseController::class , 'purchase_in_list'])->name('purchase_in_list');
Route::get('/purchase_in_delete/{id}' , [PurchaseController::class , 'delete_purchase_in'])->name('purchase_in_delete');
Route::get('/purchase_in_update/{id}' , [PurchaseController::class , 'update_purchase_in'])->name('purchase_in_update');
Route::get('/pending_purchase_list' , [PurchaseController::class , 'get_pending_purchase_list'])->name('pending_purchase_list');
Route::get('/search_purchase_in' , [PurchaseController::class , 'search_purchase_in_list'])->name('search_purchase_in');
Route::post('/confirm_purchase_in_update' , [PurchaseController::class , 'confirm_purchase_in_update'])->name('confirm_purchase_in_update');
Route::get('/search_pending_purchase' , [PurchaseController::class , 'search_pending_purchase_list'])->name('search_pending_purchase');


// Direct Purchase Routes
Route::get('/direct_purchase', [PurchaseController::class , 'direct_purchase'])->name('direct_purchase');
Route::post('/confirm_direct_purchase' , [PurchaseController::class , 'store_direct_purchase'])->name('confirm_direct_purchase');

// Routes Related To Purchase Out
Route::get('/purchase_out_entry' , function(){return view('purchase_out_entry');})->name('purchase_out_entry');
Route::get('/purchase_out_entry_route' , [PurchaseController::class , 'get_purchase_out'])->name('purchase_out_entry_route');
Route::get('/purchase_out_entry/{id}', [PurchaseController::class , 'confirm']); 
Route::post('/confirm_purchase_out' , [PurchaseController::class , 'store_purchase_out'])->name('confirm_purchase_out');
Route::get('/purchase_out_list', [PurchaseController::class , 'purchase_out_list'])->name('purchase_out_list');
Route::get('/purchase_out_delete/{id}' , [PurchaseController::class , 'delete_purchase_out'])->name('purchase_out_delete');
Route::get('/purchase_out_update/{id}' ,[PurchaseController::class , 'update_purchase_out'])->name('purchase_out_update');
Route::post('/confirm_purchase_out_update' , [PurchaseController::class , 'confirm_purchase_out_update'])->name('confirm_purchase_out_update');
Route::get('/search_purchase_out' , [PurchaseController::class , 'search_purchase_out_list'])->name('search_purchase_out');

// Routes Related To Sales in
Route::get('/sales_in_entry', [SalesController::class , 'get_sales'])->name('sales_in_entry');
Route::post('/sales_in_entry', [SalesController::class , 'store_sales_in']);
Route::get('/sales_in_list', [SalesController::class , 'sales_in_list'])->name('sales_in_list');
Route::get('/pending_sales_list' , [SalesController::class , 'get_pending_sales_list'])->name('pending_sales_list');
Route::get('/sales_in_update/{id}' , [SalesController::class , 'update_sales_in'])->name('sales_in_update');
Route::post('/confirm_sales_in_update' , [SalesController::class , 'confirm_sales_in_update'])->name('confirm_sales_in_update');
Route::get('/sales_in_delete/{id}' , [SalesController::class , 'delete_sales_in'])->name('sales_in_delete');
Route::get('/search_sales_in' , [SalesController::class , 'search_sales_in_list'])->name('search_sales_in');
Route::get('/search_pending_sales' , [SalesController::class , 'search_pending_sales_list'])->name('search_pending_sales');

// Direct Sales Routes
Route::get('/direct_sales' , [SalesController::class , 'direct_sales'])->name('direct_sales');
Route::post('/confirm_direct_sales' , [SalesController::class , 'store_direct_sales'])->name('confirm_direct_sales');

// Routes Related To Sales Out
Route::get('/sales_out_entry' , function(){return view('sales_out_entry');})->name('sales_out_entry');
Route::get('/sales_out_entry_route' , [SalesController::class , 'get_sales_out'])->name('sales_out_entry_route');
Route::get('/sales_out_entry/{id}' , [SalesController::class , 'confirm']);
Route::post('/confirm_sales_out' , [SalesController::class , 'store_sales_out'])->name('confirm_sales_out');
Route::get('/sales_out_list', [SalesController::class , 'sales_out_list'])->name('sales_out_list');
Route::get('/sales_out_update/{id}' ,[SalesController::class , 'update_sales_out'])->name('sales_out_update');
Route::post('/confirm_sales_out_update' , [SalesController::class , 'confirm_sales_out_update'])->name('confirm_sales_out_update');
Route::get('/sales_out_delete/{id}' , [SalesController::class , 'delete_sales_out'])->name('sales_out_delete');
Route::get('/search_sales_out' , [SalesController::class , 'search_sales_out_list'])->name('search_sales_out');

// Route For Auto-Complete Vehicle List
Route::get('/find_vehicle' , [SalesController::class , 'find_vehicle'])->name('find_vehicle');

// Routes Related To Item Master
Route::get('/add_item' , function(){return view('add_item');})->name('add_item');
Route::get('/item_master' , [ItemController::class , 'item_master'])->name('item_master');
Route::post('/store_item' ,[ItemController::class , 'store_item'])->name('store_item');
Route::get('/update_item/{id}' ,[ItemController::class , 'update_item_list'])->name('update_item');
Route::post('/confirm_update_item' ,[ItemController::class , 'confirm_item_update'])->name('confirm_update_item');
Route::get('/item_delete/{id}' ,[ItemController::class , 'delete_item'])->name('item_delete');
Route::get('/search_items' , [ItemController::class , 'search_item'])->name('search_items');

// Routes Related To Vehicle Master
Route::get('/add_vehicle' , function(){return view('add_vehicle');})->name('add_vehicle'); 
Route::get('/vehicle_master' ,[VehicleController::class , 'vehicle_master'])->name('vehicle_master');
Route::post('/store_new_vehicle',[VehicleController::class , 'store_new_vehicle'])->name('store_new_vehicle');
Route::get('/update_vehicle/{id}' ,[VehicleController::class , 'update_vehicle_list'])->name('update_vehicle');
Route::post('/confirm_vehicle_update' ,[VehicleController::class , 'confirm_vehicle_update'])->name('confirm_vehicle_update');
Route::get('/vehicle_delete/{id}' , [VehicleController::class , 'delete_vehicle'])->name('vehicle_delete');
Route::get('/search_vehicle' ,[VehicleController::class , 'search_vehicle'])->name('search_vehicle');

// Routes Related To Store Status
Route::get('/store_status' , [StoreController::class , 'view_current_store_status'])->name('store_status');
Route::get('/search_store_status' ,[StoreController::class , 'search_Store_status'])->name('search_store_status');

// Routes Related To Store In
Route::get('/store_in_entry' , function(){return view('store_in_entry');})->name('store_in_entry');
Route::post('/save_store_in' ,[StoreController::class , 'save_store_in'])->name('save_store_in');
Route::get('/store_in_list' , [StoreController::class , 'store_in_list'])->name('store_in_list');
Route::get('/search_store_in' , [StoreController::class , 'search_store_in'])->name('search_store_in');
Route::get('/confirm_store_in/{id}' , [StoreController::class , 'confirm_store_in'])->name('confirm_store_in');
 
// Routes Related To Store Out
Route::get('/store_out_list' ,[StoreController::class , 'store_out_list'])->name('store_out_list');
Route::get('confirm_store_out/{id}' ,[StoreController::class , 'confirm_store_out'])->name('confirm_store_out');
Route::post('/save_store_out' , [StoreController::class , 'save_store_out'])->name('save_store_out');
Route::get('/search_store_out' ,[StoreController::class , 'search_store_out'])->name('search_store_out');

// Routes Related To Fuel Type Management
Route::get('/fuel_type_entry' , function(){return view('fuel_type_entry');})->name('fuel_type_entry');
Route::post('/save_fuel_type' , [FuelController::class , 'save_fuel_type'])->name('save_fuel_type');
Route::get('/fuel_type_list' , [FuelController::class , 'fuel_type_list'])->name('fuel_type_list');
Route::get('/delete_fuel_type/{id}' , [FuelController::class , 'delete_fuel_type'])->name('delete_fuel_type');

// Routes Related To Fuel-In
Route::get('/fuel_in_entry' , [FuelController::class , 'fuel_in_entry'])->name('fuel_in_entry');
Route::post('/save_fuel_in' , [FuelController::class , 'save_fuel_in'])->name('save_fuel_in');
Route::get('/fuel_in_list' , [FuelController::class ,'fuel_in_list'])->name('fuel_in_list');
Route::get('/confirm_fuel_in/{id}' , [FuelController::class , 'confirm_fuel_in'])->name('confirm_fuel_in');
Route::get('/update_fuel_in/{id}' , [FuelController::class , 'update_fuel_in'])->name('update_fuel_in');
Route::post('/confirm_fuel_in_update' , [FuelController::class , 'confirm_fuel_in_update'])->name('confirm_fuel_in_update');
Route::get('/search_fuel_in' , [FuelController::class , 'search_fuel_in_list'])->name('search_fuel_in');

// Routes Related To Available Fuel
Route::get('/available_fuel_list' , [FuelController::class , 'available_fuel_list'])->name('available_fuel_list');
Route::get('/search_available_fuel' , [FuelController::class , 'search_available_fuel'])->name('search_available_fuel');

// Routes Related To Fuel Out
Route::get('/confirm_fuel_out/{id}' ,[FuelCOntroller::class , 'confirm_fuel_out'])->name('confirm_fuel_out');
Route::post('/save_fuel_out' , [FuelController::class , 'save_fuel_out'])->name('save_fuel_out');
Route::get('/fuel_out_list' , [FuelController::class , 'fuel_out_list'])->name('fuel_out_list');
Route::get('/update_fuel_out/{id}' , [FuelController::class , 'update_fuel_out'])->name('update_fuel_out');
Route::post('/confirm_fuel_out_update' , [FuelController::class , 'confirm_fuel_out_update'])->name('confirm_fuel_out_update');
Route::get('/search_fuel_out_list' , [FuelController::class , 'search_fuel_out_list'])->name('search_fuel_out_list');

// Routes Related To Lease Master
Route::get('/lease_master' , [LeaseController::class , 'lease_list'])->name('lease_master');
Route::get('/add_lease' , function(){return view('add_lease');})->name('add_lease');
Route::post('/store_lease' , [LeaseController::class , 'store_lease'])->name('store_lease');
Route::get('/confirm_lease_update_id/{id}' , [LeaseController::class , 'confirm_lease_update_id'])->name('confirm_lease_update_id');
Route::post('/update_lease' , [LeaseController::class , 'update_lease'])->name('update_lease');
Route::get('/confirm_lease_delete_id/{id}' , [LeaseController::class , 'confirm_lease_delete_id'])->name('confirm_lease_delete_id');

// Routes Related To Employee Master
Route::get('/employee_master' , [EmployeeController::class , 'employee_list'])->name('employee_master');
Route::get('/add_employee' , function(){return view('add_employee');})->name('add_employee');
Route::post('/store_employee' , [EmployeeController::class , 'store_employee'])->name('store_employee');
Route::get('/confirm_employee_details/{id}' , [EmployeeController::class , 'confirm_employee_details'])->name('confirm_employee_details');
Route::get('/delete_employee/{id}' , [EmployeeController::class ,'delete_employee'])->name('delete_employee');
Route::post('/update_employee' , [EmployeeController::class , 'update_employee'])->name('update_employee');
Route::get('/search_employee' , [EmployeeController::class , 'search_employee'])->name('search_employee');
Route::get('/return_to_update' , [EmployeeController::class , 'return_to_update_page'])->name('return_to_update');
Route::get('/search_employee' , [EmployeeController::class , 'search_employee'])->name('search_employee');

// Routes Related To Print Page
Route::get('/print_employee_details/{id}' , [PrintController::class , 'print_employee_details'])->name('print_employee_details');
Route::get('/print_contractor_details/{id}' , [PrintController::class , 'print_contractor_details'])->name('print_contractor_details');
Route::get('/print_purchase_in/{id}' , [PrintController::class , 'print_purchase_in'])->name('print_purchase_in');
Route::get('/print_purchase_out/{id}' , [PrintController::class , 'print_purchase_out'])->name('print_purchase_out');
Route::get('/print_sales_in/{id}' , [PrintController::class , 'print_sales_in'])->name('print_sales_in');
Route::get('/print_sales_out/{id}' , [PrintController::class , 'print_sales_out'])->name('print_sales_out');
Route::get('/print_store_in/{id}' , [PrintController::class , 'print_store_in'])->name('print_store_in');
Route::get('/print_store_out/{id}' , [PrintController::class , 'print_store_out'])->name('print_store_out');
Route::get('/print_fuel_in/{id}' , [PrintController::class , 'print_fuel_in'])->name('print_fuel_in');
Route::get('/print_fuel_out/{id}' , [PrintController::class , 'print_fuel_out'])->name('print_fuel_out');

// Routes Related To User Master
Route::get('/user_master' , [UserController::class , 'user_master'])->name('user_master');
Route::get('/add_user' , [UserController::class , 'add_user'])->name('add_user');
Route::post('/store_user' , [UserController::class , 'store_user'])->name('store_user');
Route::get('/delete_user/{id}' , [UserController::class , 'delete_user'])->name('/delete_user');

// Routes Related To Contractor Master
Route::get('/contractor_master' , [ContractorController::class , 'contractor_master'])->name('contractor_master');
Route::get('/add_contractor' , [ContractorController::class , 'add_contractor'])->name('add_contractor');
Route::post('/store_contractor' , [ContractorController::class , 'store_contractor'])->name('store_contractor');
Route::get('/update_contractor/{id}' , [ContractorController::class , 'update_contractor'])->name('update_contractor');
Route::post('/confirm_contractor_update' , [ContractorController::class , 'confirm_contractor_update'])->name('confirm_contractor_update');
Route::get('/delete_contractor/{id}' , [ContractorController::class , 'delete_contractor'])->name('delete_contractor');


// Routes Related To Report Master
Route::get('/report_master' , [ReportController::class , 'report_master'])->name('report_master');
// Purchase Reports
Route::post('/get_purchase_report' , [ReportController::class , 'get_purchase_report'])->name('get_purchase_report');
Route::get('/download_purchase_pdf' , [ReportController::class , 'download_purchase_pdf'])->name('download_purchase_pdf');
Route::get('/download_purchase_full_pdf' , [ReportController::class , 'download_purchase_pdf'])->name('download_purchase_full_pdf');
Route::get('/download_purchase_in_pdf' , [ReportController::class , 'download_purchase_in_pdf'])->name('download_purchase_in_pdf');
Route::get('/download_purchase_excel' , [ReportController::class , 'download_purchase_excel'])->name('download_purchase_excel');
Route::get('/download_purchase_full_excel' , [ReportController::class , 'download_purchase_full_excel'])->name('download_purchase_full_excel');
Route::get('/download_purchase_in_excel' , [ReportController::class , 'download_purchase_in_excel'])->name('download_purchase_in_excel');
Route::get('/mail_purchase_pdf' , [ReportController::class , 'mail_purchase_pdf'])->name('mail_purchase_pdf');
Route::get('/mail_purchase_excel' , [ReportController::class , 'mail_purchase_excel'])->name('mail_purchase_excel');

// Sales Reports
Route::post('/get_sales_report' , [ReportController::class , 'get_sales_report'])->name('get_sales_report');
Route::get('/download_sales_pdf' , [ReportController::class , 'download_sales_pdf'])->name('download_sales_pdf');
Route::get('/download_sales_in_pdf' , [ReportController::class , 'download_sales_in_pdf'])->name('download_sales_in_pdf');
Route::get('/download_sales_full_pdf' , [ReportController::class , 'download_sales_full_pdf'])->name('download_sales_full_pdf');
Route::get('/download_sales_excel' , [ReportController::class , 'download_sales_excel'])->name('download_sales_excel');
Route::get('/download_sales_in_excel' , [ReportController::class , 'download_sales_in_excel'])->name('download_sales_in_excel');
Route::get('/download_sales_full_excel' , [ReportController::class , 'download_sales_full_excel'])->name('download_sales_full_excel');
Route::get('/mail_sales_pdf' , [ReportController::class , 'mail_sales_pdf'])->name('mail_sales_pdf');
Route::get('/mail_sales_excel' , [ReportController::class , 'mail_sales_excel'])->name('mail_sales_excel');

// Fuel-In Reports
Route::post('/get_fuel_in_report' , [ReportController::class , 'get_fuel_in_report'])->name('get_fuel_in_report');
Route::get('/download_fuel_in_pdf' , [ReportController::class , 'download_fuel_in_pdf'])->name('download_fuel_in_pdf');
Route::get('/download_fuel_in_excel' , [ReportController::class , 'download_fuel_in_excel'])->name('download_fuel_in_excel');
Route::get('/mail_fuel_in_pdf' , [ReportController::class , 'mail_fuel_in_pdf'])->name('mail_fuel_in_pdf');
Route::get('/mail_fuel_in_excel' , [ReportController::class , 'mail_fuel_in_excel'])->name('mail_fuel_in_excel');

// Fuel-Out Reports
Route::post('/get_fuel_out_report' , [ReportController::class , 'get_fuel_out_report'])->name('get_fuel_out_report');
Route::get('/download_fuel_out_pdf' , [ReportController::class , 'download_fuel_out_pdf'])->name('download_fuel_out_pdf');
Route::get('/download_fuel_out_excel' , [ReportController::class , 'download_fuel_out_excel'])->name('download_fuel_out_excel');
Route::get('/mail_fuel_out_pdf' , [ReportController::class , 'mail_fuel_out_pdf'])->name('mail_fuel_out_pdf');
Route::get('/mail_fuel_out_excel' , [ReportController::class , 'mail_fuel_out_excel'])->name('mail_fuel_out_excel');

// Fuel Available Reports
Route::get('/download_fuel_available_pdf' , [ReportController::class , 'download_fuel_available_pdf'])->name('download_fuel_available_pdf');
Route::get('/download_fuel_available_excel' , [ReportController::class , 'download_fuel_available_excel'])->name('download_fuel_available_excel');
Route::post('/mail_fuel_available' , [ReportController::class , 'mail_fuel_available'])->name('mail_fuel_available');

// Store-In Reports
Route::post('/get_store_in_report' , [ReportController::class , 'get_store_in_report'])->name('get_store_in_report');
Route::get('/download_store_in_pdf' , [ReportController::class , 'download_store_in_pdf'])->name('download_store_in_pdf');
Route::get('/download_store_in_excel' , [ReportController::class , 'download_store_in_excel'])->name('download_store_in_excel');
Route::get('/mail_store_in_pdf' , [ReportController::class , 'mail_store_in_pdf'])->name('mail_store_in_pdf');
Route::get('/mail_store_in_excel' , [ReportController::class , 'mail_store_in_excel'])->name('mail_store_in_excel');

// Store-Out Reports
Route::post('/get_store_out_report' , [ReportController::class , 'get_store_out_report'])->name('get_store_out_report');
Route::get('/download_store_out_pdf' , [ReportController::class , 'download_store_out_pdf'])->name('download_store_out_pdf');
Route::get('/download_store_out_excel' , [ReportController::class , 'download_store_out_excel'])->name('download_store_out_excel');
Route::get('/mail_store_out_pdf' , [ReportController::class , 'mail_store_out_pdf'])->name('mail_store_out_pdf');
Route::get('/mail_store_out_excel' , [ReportController::class , 'mail_store_out_excel'])->name('mail_store_out_excel');

// Store Status Reports
Route::get('/download_store_status_pdf' , [ReportController::class , 'download_store_status_pdf'])->name('download_store_status_pdf');
Route::get('/download_store_status_excel' , [ReportController::class , 'download_store_status_excel'])->name('download_store_status_excel');
Route::post('/mail_store_status' , [ReportController::class , 'mail_store_status'])->name('mail_store_status');


// Routes Related To Mail Master
Route::get('/add_mail' , function(){return view('add_mail');})->name('add_mail');
Route::get('/mail_master' , [MailController::class , 'mail_master'])->name('mail_master');
Route::post('/store_mail' , [MailController::class , 'store_mail'])->name('store_mail');
Route::get('/delete_mail/{id}' , [MailController::class , 'delete_mail'])->name('delete_mail');