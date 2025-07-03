<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('pagesadmin.user')->with('data', $data);
    }
    public function destroy(User $user){
        $user->delete();

        return redirect('/user')->with('successuser', 'User deleted successfully');
    }
}
