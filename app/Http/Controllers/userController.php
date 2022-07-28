<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['role'])->get();
        
        return view('user.admin.user.browse_all_user', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.user.add-new-user', [
            'roles' => Role::all(),
            'mode' => 'entry'
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        // get the user role
        $user_role = Role::find($req->role);

        // create a user according to the role
        $new_user = $user_role->users()->create([
            'username' => $req->uname,
            'name' => $req->name,
            'email' => $req->email,
            'address' => $req->city_town,
            'description' => $req->description,
            'password' => Hash::make($req->pass),  
        ]);

        // add the profile image path inside the db and 
        // real files into the storage of the new created user
        $profile = $req->file('user_img');
        $profile_size = $profile->getSize();
        $profile_name = $new_user->id . '_' . Str::camel($req->name) . '_' . time() .'.'.$profile->getClientOriginalExtension();
        
        // set paths according to the user role
        if($new_user->role_id == 1) {

            $profile_img_path = 'public/images/profiles/admins';

        } else if ($new_user->role_id == 2) {
            
            $profile_img_path = 'public/images/profiles/teachers';

        } else {
            
            $profile_img_path = 'public/images/profiles/students';

        }
        
        // save image into the storage 
        $path = $profile->storeAs($profile_img_path, $profile_name);

        // save the path into the profile picture database
        $new_user->profile_picture()->create([
            'file_name' => $profile_name,
            'path' => $path,
            'size' => $profile_size
        ]);

        // add the new user's zoom info into the zoom user info database
        $new_user->zoom_user_info()->create($req->only('zoom_username', 'zoom_email', 'api_key', 'api_secret'));

        return redirect()->route('showAllUser')->with('status', $new_user->name . " is created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // dd($user->zoom_user_info);
        return view('user.admin.user.add-new-user', [
            'user' => $user,
            'zoom' => $user->zoom_user_info,
            'roles' => Role::all(),
            'mode' => 'detail'
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.admin.user.add-new-user', [
            'user' => $user,
            'zoom' => $user->zoom_user_info,
            'roles' => Role::all(),
            'mode' => 'edit'
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req,User $user)
    {

        $updated_user = $user->update([
            'username' => $req->uname,
            'name' => $req->name,
            'email' => $req->email,
            'address' => $req->city_town,
            'description' => $req->description,
            'role_id' => $req->role
        ]);

        // if user update the profile image
        if (array_key_exists('user_img', $req->all())) {
            $profile = $req->file('user_img');
            $profile_size = $profile->getSize();
            $profile_name = $user->id . '_' . Str::camel($req->name) . '_' . time() .'.'.$profile->getClientOriginalExtension();
            
            // set paths according to the user role
            if($req->role == 1) {

                $profile_img_path = 'public/images/profiles/admins';

            } else if ($req->role == 2) {
                
                $profile_img_path = 'public/images/profiles/teachers';

            } else {
                
                $profile_img_path = 'public/images/profiles/students';

            }
            
            // if the user have the previous profile picture 
            if($user->profile_picture) {
                // delete the previous file
                Storage::delete($user->profile_picture->path);
                // save the new image into the storage 
                $path = $profile->storeAs($profile_img_path, $profile_name);
                // update the new profile picture
                $user->profile_picture()->update([
                    'file_name' => $profile_name,
                    'path' => $path,
                    'size' => $profile_size
                ]);
            } else {
                // if the picture is the new one
                // save image into the storage 
                $path = $profile->storeAs($profile_img_path, $profile_name);
                // save the path into the profile picture database
                $user->profile_picture()->create([
                    'file_name' => $profile_name,
                    'path' => $path,
                    'size' => $profile_size
                ]);
            }
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user) {
            // delete the user profile picture file
            Storage::delete($user->profile_picture->path);
            // delete user from database
            $user->delete();
            return back()->with('status', 'Successfully Deleted.');
        }

    }
}
