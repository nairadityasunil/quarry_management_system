<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin_users;

class UserController extends Controller
{
    public function register_user(Request $request)
    {
        $request->validate(
            [
                'username'=>'required',
                'email'=>'required|email',
                'confirm_password'=>'required',
                'confirm_admin_password'=>'required'
            ],
            [
                'username.required'=>'* Please Enter Username. *',
                'email.required'=>'* Please Enter Email. *',
                'email.email'=>'* Please Enter Valid Email. *',
                'confirm_password.required'=>'* Please Enter Password. *',
                'confirm_admin_password.required'=>'* Please Enter Admin Password. *'
            ]
        );
            $user = new Admin_users;
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->password = md5($request['confirm_password']);
            $user->admin_password = md5($request['confirm_admin_password']);
            
            if($user->save())
            {
                // echo "<script>alert('User Added Successfully')</script>";
                session()->flash('status' , 'User Registered !!!');
                return redirect('/');
            }
            else
            {
                // echo "<script>alert('Unable To Add User Successfully')</script>";
                session()->flash('status' , 'User Not Registered !!!');
                return redirect('/register');
            }
    
            // return redirect('/user_master');
        
    }

    public function add_user()
    {
        if(session()->has('username'))
        {
            $users = Admin_users::all();
            $data = compact('users');
            return view('add_user')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function store_user(Request $request)
    {
        if(session()->has('username'))
        {
            $request->validate(
                [
                    'username'=>'required|unique:Admin_users,username',
                    'email'=>'required|email|unique:Admin_users,email',
                    'confirm_password'=>'required',
                    'confirm_admin_password'=>'required'
                ],
                [
                    'username.required'=>'* Please Enter Username. *',
                    'username.unique'=>'* Username Already Exists. *',
                    'email.required'=>'* Please Enter Email. *',
                    'email.email'=>'* Please Enter Valid Email. *',
                    'email.unique'=>'* Email Already Exists. *',
                    'confirm_password.required'=>'* Please Enter Password. *',
                    'confirm_admin_password.required'=>'* Please Enter Admin Password. *'
                ]
            );
            $user = new Admin_users;
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->password = md5($request['confirm_password']);
            $user->admin_password = md5($request['confirm_admin_password']);
            
            if($user->save())
            {
                // echo "<script>alert('User Added Successfully')</script>";
                session()->flash('status' , 'User Added !!!');
                return redirect('/user_master');
            }
            else
            {
                // echo "<script>alert('Unable To Add User Successfully')</script>";
                session()->flash('status' , 'User Not Added !!!');
                return redirect('/user_master');
            }
    
            // return redirect('/user_master');
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function delete_user($id)
    {
        if(session()->has('username'))
        {
            $users = Admin_users::all();
            $user_count = count($users);
            if ($user_count>1)
            {
                $delete_user = Admin_users::find($id);
            
                if (!is_null($delete_user))
                {

                    $delete_username = $delete_user->username;
                    $user_logged_in = session()->get('username');
                    if ($delete_username==$user_logged_in)
                    {
                        if ($delete_user->delete())
                        {
                            session()->flash('status' , 'User '.$delete_username.' Deleted!!!');
                            // return redirect()->back();
                            return redirect('/');
                        }
                    }
                    else
                    {
                        if ($delete_user->delete())
                        {
                            session()->flash('status' , 'User '.$delete_username.' Deleted!!!');
                            return redirect()->back();
                            // return redirect('/');
                        }
                    }
                }
            }
            else
            {
                session()->flash('status' , 'User Cannot Be Deleted Only One User Available');
                return redirect()->back();
            }
        }

        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }

    public function user_master()
    {
        if(session()->has('username'))
        {
            $users = Admin_users::all();
            $data = compact('users');
            return view('/user_master')->with($data);
        }
        else
        {
            session()->flash('session_expired' , 'Session Expired!!!');
            return redirect('/');
        }
    }
}
