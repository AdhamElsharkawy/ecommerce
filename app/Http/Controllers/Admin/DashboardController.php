<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
// use Intervention\Image\Image;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;


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
        if (Auth::guard('admin')->check()) {
            return redirect('admin/dashboard');
        }
        return view('admin.login');
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            
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
                    if($data['current_password'] == $data['new_password']){
                        return redirect('admin/update-password')->with('error', 'New Password cannot be same as your current password');
                    }
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

    public function updateAdminDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'email' => 'required|email|max:255',
            ];

            $customMessages = [
                'name.required' => 'Name is required',
                'name.regex' => 'Valid Name is required',
                'image.image' => 'Valid Image is required',
                'image.mimes' => 'Valid Image type is required',
                'image.max' => 'Image size must be less than 2 MB',
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
            ];


            $this->validate($request, $rules, $customMessages);
            $admin =  Admin::where('email', Auth::guard('admin')->user()->email);
          
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                if ($image->isValid()) {
                    $imageName = time().'.'.$image->getClientOriginalExtension();                    $imagePath = 'uploads/admin/' . $imageName;
                    //save image in folder path 
                    $image->move(public_path('uploads/admin/'), $imageName);
                    // dd($imagePath);

                } else {
                    return redirect('admin/update-admin-details')->with('error', 'Invalid Image');
                }
            } else {
                //old image
                $imageName = $admin->first()->image;    
            }

            $admin->update(['name' => $data['name'], 'image' => $imageName , 'email' => $data['email']]);
            return redirect('admin/update-admin-details')->with('message_success', 'Admin Details updated successfully');
        }
        return view('admin.update_admin_details');
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
