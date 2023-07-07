<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;


class EmployeeData extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            dd($credentials);
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:employees',
            'password' => 'required|min:6',
            'phone'    => 'required|unique:employees',
            'image'    => 'required|mimes:jpeg,png,jpg,gif,svg',
            'role'     => 'required'
        ]);
        //  dd($request);  
        $fileName = time() . '.' . $request->image->extension();
        
        //$request->image->storeAs('/public/images', $fileName);
        $request->image->move(public_path('images'), $fileName);

        
        $data = new Employees;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->image = $fileName;
        $data->phone = $request->phone;
        $data->role  =$request->role ;
        $data->save();
        // $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return Employees::create([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'password' => Hash::make($data['password']),
        'role'     => $data['role'],
        'phone'    => $data['phone'],
        'image'    => $data['image']
      ]);
    }    
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('auth.dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}

