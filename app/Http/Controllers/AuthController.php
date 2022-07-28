<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // register a user
    public function register(Request $req) {

        // get the user role
        $user_role = Role::find($req->role);

        // create a user according to the role
        $new_user = $user_role->users()->create([
            'username' => $req->uname,
            'name' => $req->name,
            'email' => $req->email,
            'description' => $req->description,
            'password' => Hash::make($req->pass),  
        ]);

        // add the profile image path inside the db and 
        // real files into the storage of the new created user
        $profile = $req->file('user_img');
        $profile_name = $new_user->id . '_' . Str::camel($req->name) . '_' . time() .'.'.$profile->getClientOriginalExtension();
        
        // set paths according to the user role
        if($new_user->role_id == 1) {

            $profile_img_path = 'public/images/profiles/admins';

        } else if ($new_user->role_id == 2) {
            
            $profile_img_path = 'public/images/profiles/students';

        } else {
            
            $profile_img_path = 'public/images/profiles/teachers';

        }
        
        // save image into the storage 
        $path = $profile->storeAs($profile_img_path, $profile_name);

        // save the path into the database
        User::find($new_user->id)->update([
            "profile_img_path" => $path
        ]);

        return back();

    }

    // user login
    public function login(Request $req) {


        // dd(Carbon::now());
        // login with username and password
        if(!auth()->attempt(['username' => $req->username , 'password' => $req->password], $req->remember)){
            return back()->with('login_error', 'Invalid credentials');
        }
        return redirect()->route('dashboard');
    }

    // user logout
    public function logout() {

        // logout the user
        auth()->logout();
        
        return redirect()->route('login');
    }
}
