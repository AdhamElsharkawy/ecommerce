<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|min:6|max:255',
            ];

            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required',
                'password.min' => 'Password must be at least 6 characters',
            ];

            $this->validate($request, $rules, $customMessages);




            $data = $request->all();
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                // dd('Success');
                return redirect('admin/dashboard');
            } else {
                return redirect('admin/login')->with('message_error', 'Invalid Username or Password');
            }
        }
        return view('admin.login');
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            // dd('asd');
            $data = $request->all();
            $rules = [
                'current_password' => 'required|min:6|max:255',
                'new_password' => 'required|min:6|max:255',
                'confirm_password' => 'required|same:new_password',
            ];

            $customMessages = [
                'current_password.required' => 'Current Password is required',
                'current_password.min' => 'Current Password must be at least 6 characters',
                'new_password.required' => 'New Password is required',
                'new_password.min' => 'New Password must be at least 6 characters',
                'confirm_password.required' => 'Confirm Password is required',
                'confirm_password.same' => 'New Password and Confirm Password must be same',
            ];

            $this->validate($request, $rules, $customMessages);
            // dd($data);
            $current_password = Auth::guard('admin')->user()->password;

            if (Hash::check($data['current_password'], $current_password)) {
                $new_pwd = bcrypt($data['new_password']);
                if ($data['new_password'] == $data['confirm_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => $new_pwd]);
                    return redirect('admin/update-password')->with('message_success', 'Password updated successfully');
                } else {
                    return redirect('admin/update-password')->with('error', 'New Password and Confirm Password must be same');
                }
            } else {
                return redirect('admin/update-password')->with('error', 'Current Password is Incorrect');
            }
        }
        return view('admin.update_password');
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        $current_password = $data['current_password'];
        $current_password_db = Auth::guard('admin')->user()->password;
        if (Hash::check($current_password, $current_password_db)) {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
