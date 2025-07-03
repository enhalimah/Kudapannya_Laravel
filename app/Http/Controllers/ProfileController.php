<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        return view("pages/profile");
    }

    function signin(Request $request){
            Session::flash('email', $request->email);
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Success
                $user = Auth::user();
                $request->session()->put('username', $user->name);
                return redirect('homepage')->with('message', $user->name);
            }
        
            // Jika otentikasi menggunakan email gagal, coba otentikasi menggunakan name
            if (Auth::attempt(['name' => $request->email, 'password' => $request->password])) {
                // Success
                $user = Auth::user();
                $request->session()->put('username', $user->name);
                return redirect('homepage')->with('message', $user->name);
            } else{
                //failed
                return redirect('/profile')->with('incorrect', 'Email or password is incorrect');
            }
        }
    
    public function signup(Request $request) {
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'password' => Hash::make($request->input('password'))
        ]);

        if ($user) {
            //success
            return redirect('/profile')->with('alert-success', 'Account created successfully!');
            } else {
                //failed
                return redirect('/profile');
            }
        }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/profile');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
