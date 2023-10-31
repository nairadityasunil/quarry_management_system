<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Admin_users;

class LoginController extends Controller
{
    public function check_user()
    {
        $users = Admin_users::all();
        $row_count = count($users);
        if ($row_count==0)
        {
            return view ('registration');
        }
        else
        {
            if (session()->has('username'))
            {
                session()->forget('username');
            }
            return view('login_page');
        }
    }

    public function send_login_otp(Request $request)
    {
        $username = $request['username'];
        $all_users = Admin_users::where('username' , '=' , $username)->first();
        if($all_users)
        {
            $all_users = Admin_users::where('username' , '=' , $username)->get();
            $otp = rand(100000,999999);
            $request->session()->put('otp' , $otp);
            foreach($all_users as $users)
            {
                $user_email = $users->email;
                $mail_data = [
                    'recipient' => $user_email,
                    'fromEmail' => 'quarrymanagementsystem@gmail.com',
                    'fromName' => 'Quarry Management System',
                    'subject' => 'Login OTP',
                    'body' => 'Dear '.$username.', Your One Time Password To Login To Quarry Management System : '.$otp.'.'
                ];
                Mail::send('login_mail' , $mail_data, function($message) use ($mail_data){
                    $message->to($mail_data['recipient'])
                            ->from($mail_data['fromEmail'], $mail_data['fromName'])
                            ->subject($mail_data['subject']);
                });
                $request->session()->put('user_email' , $user_email);
                $request->session()->put('username' , $username);
                return view('enter_otp');
            }
        }
        else
        {
            session()->flash('status','*User Not Found');
            return redirect()->back();
        }
    }

    public function verify(Request $request)
    {
        $user_otp = $request->otp;
        $generated_otp = session()->get('otp');

        if($user_otp==$generated_otp)
        {
            session()->forget('otp');
            return redirect('/home');
        }
        else
        {
            session()->flash('status','* Incorrect OTP');
            return redirect('/');
            session()->forget('otp');
            session()->forget('username');
        }
    }

    public function authentication(Request $request)
    {
        $username = $request['username'];
        $password = $request['password'];
        $admin_password = $request['admin_password'];
        $all_users = Admin_users::where('username' , '=' , $username)->first();
        if($all_users)
        {
            $all_users = Admin_users::where('username' , '=' , $username)->get();
            foreach($all_users as $users)
            {
                $password = md5($password);
                $admin_password = md5($admin_password);
                $table_password = $users->password;
                echo $table_password;
                if($table_password == $password)
                {
                    $table_admin_password = $users->admin_password;
                    if($table_admin_password == $admin_password)
                    {
                        $request->session()->put('username' , $username);
                        if ($request->session()->has('username'))
                        {
                            return redirect('/home');
                        }
                    }
                    else
                    { 
                        session()->flash('status','* Invalid Login Details *');
                        return redirect('/');
                    }
                }
                else
                {
                    session()->flash('status','* Invalid Login Details *');
                    return redirect('/');
                }
            }
        }
        else
        {
            session()->flash('status','* Invalid Login Details *');
            return redirect()->back();
        }

    }
}
