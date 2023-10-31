<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Past_employees;

class EmployeeController extends Controller
{

    public function employee_list()
    {
        if(session()->has('username'))
        {
            $employee_details = Employees::all();
            $data = compact('employee_details');
            return view('employee_master')->with($data);
        }
        else
        {
            return redirect('/');
        }
    }

    public function store_employee(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'employee_name'=>'required|regex:/^[a-z A-Z]+$/|unique:Employees,emp_name',
                    'gender'=>'required|regex:/^[a-z A-Z]+$/',
                    'address'=>'required',
                    'contact'=>'required|regex:/[0-9]{10}/|unique:Employees,contact_no',
                    'designation'=>'required|regex:/^[a-z A-Z]+$/',
                    'joining_date'=>'required',
                    'emp_photo'=>'required|max:2048|image',
                ],
                [
                    'employee_name.required'=>'* Please Enter Employee Name. *',
                    'employee_name.regex'=>'* Please Enter Only Alphabets In Employee Name. *',
                    'employee_name.unique'=>'* Employee Already Exists. *',
                    'gender.regex'=>'* Please Select Gender. *',
                    'address.required'=>'* Please Enter Address. *',
                    'contact.required'=>'* Please Enter Contact Number. *',
                    'contact.regex'=>'* Please Enter Valid Phone Number. *',
                    'contact.unique'=>'* Contact Number Already Exists. *',
                    'designation.required'=>'* Please Enter Designation. *',
                    'designation.regex'=>'* Please Enter Valid Designation. *',
                    'joining_date'=>'* Please Select Joining Date. *',
                    'emp_photo.required'=>'* Please Select Employee Photo. *',
                    'emp_photo.image'=>'* Only Image Formats Allowed. *',
                    'emp_photo.max'=>'* Please Select Image With Size Less Than 2MB. *'
                ]
            );
            $employee_details = new Employees;
            // echo $request['joining_date'];
            if ($request->hasfile('emp_photo'))
            {
                $file = $request->file('emp_photo');
                // $destination = 'uploads/employee_photos'.'/';
                $extension= $file->getClientOriginalExtension();
                // $mainFilename = time().'.'.$ext;
                $filename = $request['employee_name'].'.'.$extension;
                $file->move('uploads/employee_photos' , $filename);
    
                $employee_details->emp_name = $request['employee_name'];
                $employee_details->gender = $request['gender'];
                $employee_details->address = $request['address'];
                $employee_details->contact_no = $request['contact'];
                $employee_details->designation = $request['designation'];
                $employee_details->joining_date = $request['joining_date'];
                $employee_details->emp_photo = $filename;
                if ($employee_details->save())
                {
                    // echo "<script>alert('Employee Added Successfully');</script>";
                    session()->flash('status' , 'Employee Added !!!');
                    return redirect('/employee_master');
                }
                else
                {
                    // echo "<script>alert('Unable To Add Employee');</script>";
                    session()->flash('status' , 'Employee Not Added !!!');
                    return redirect('/employee_master');
                }
            }
            // return redirect('/employee_master');
        }
        else
        {
            return redirect('/');
        }
    }

    public function confirm_employee_details($id)
    {
        if(session()->has('username'))
        {
            $employee_details = Employees::find($id);
            $data = compact('employee_details');
            return view('update_employee')->with($data);
        }
        else
        {
            return redirect('/');
        }
    }
   
    public function update_employee(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'employee_name'=>'required|regex:/^[a-z A-Z]+$/|unique:Employees,emp_name,'.$request->id,
                    'gender'=>'required|regex:/^[a-z A-Z]+$/',
                    'address'=>'required',
                    'contact'=>'required|regex:/[0-9]{10}/|unique:Employees,contact_no,'.$request->id,
                    'designation'=>'required|regex:/^[a-z A-Z]+$/',
                    'joining_date'=>'required',
                    'old_photo'=>'required',
                ],
                [
                    'employee_name.required'=>'* Please Enter Employee Name. *',
                    'employee_name.regex'=>'* Please Enter Only Alphabets In Employee Name. *',
                    'employee_name.unique'=>'* Employee Already Exists. *',
                    'gender.regex'=>'* Please Select Gender. *',
                    'address.required'=>'* Please Enter Address. *',
                    'contact.required'=>'* Please Enter Contact Number. *',
                    'contact.regex'=>'* Please Enter Valid Phone Number. *',
                    'contact.unique'=>'* Contact Number Already Exists. *',
                    'designation.required'=>'* Please Enter Designation. *',
                    'designation.regex'=>'* Please Enter Valid Designation. *',
                    'joining_date'=>'* Please Select Joining Date. *',
                    'old_photo.required'=>'* Please Select Employee Photo. *',
                ]
            );
            $update_details = Employees::find($request->id);
     
            if (!is_null($update_details))
            {
                 $update_details->emp_name = $request['employee_name'];
                 $update_details->gender = $request['gender'];
                 $update_details->address = $request['address'];
                 $update_details->contact_no = $request['contact'];
                 $update_details->designation = $request['designation'];
                 $update_details->joining_date = $request['joining_date'];
                 if ($request->hasfile('emp_photo'))
                 {    
                    $image = $request['old_photo'];
                    File::delete(public_path('uploads/employee_photos/'.$image));

                     $file = $request->file('emp_photo');
                     $extension= $file->getClientOriginalExtension();
                     $filename = $request['employee_name'].'.'.$extension;
                     $file->move('uploads/employee_photos' , $filename);
                     $update_details->emp_photo = $filename;
                 }
                 else
                 { 
                     $update_details->emp_name = $request['employee_name'];
                     $update_details->gender = $request['gender'];
                     $update_details->address = $request['address'];
                     $update_details->contact_no = $request['contact'];
                     $update_details->designation = $request['designation'];
                     $update_details->joining_date = $request['joining_date'];
                     $update_details->emp_photo = $request['old_photo'];

                 }
                 if($update_details->save())
                 {
                    session()->flash('status' , 'Employee Updated !!!');
                    return redirect('/employee_master');
                 }
                 else
                 {
                    session()->flash('status' , 'Employee Not Updated !!!');
                    return redirect('/employee_master');
                 }
            }
        }
        else
        {
            return redirect('/');
        }

    }

    public function delete_employee($id)
    {
        if(session()->has('username'))
        {
            $employee_details = Employees::find($id);
            if (!is_null($employee_details))
            {
                $image = $employee_details->emp_photo;
                // echo $image;
                File::delete(public_path('uploads/employee_photos/'.$image));
                if($employee_details->delete())
                {
                    session()->flash('status' , 'Employee Deleted !!!');
                    return redirect('/employee_master');
                }
                else
                {
                    session()->flash('status' , 'Employee Not Deleted !!!');
                    return redirect('/employee_master');
                }
                // return redirect('/employee_master');
            }
        }
        else
        {
            return redirect('/');
        } 
    }

    public function return_to_update_page()
    {
        if(session()->has('username'))
        {
            return redirect()->back();
        }
        else
        {
            return redirect('/');
        } 
    }

    public function search_employee(Request $request)
    {
        if(session()->has('username'))
        {
            $emp_name = $request['search_item'];
            $employee_details = Employees::where('emp_name' , 'Like' , '%'.$emp_name)->get();
            if (!is_null($employee_details))
            {
                $data = compact('employee_details');
                return view('employee_master')->with($data);
            }
        }
        else
        {
            return redirect('/');
        } 
    }
}
 