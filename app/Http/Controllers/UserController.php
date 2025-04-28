<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\SystemUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash; 
use Exception; 

class UserController extends Controller
{

    public function show_users()
    {
        $users = SystemUser::all(); 
        return view('admin_dashboard.users', compact('users'));
    }


    public function getUserDetails($id)
    {
        $user = SystemUser::findOrFail($id); 
        return response()->json($user); 
    }
    
    

    
    public function store(Request $request)
    {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',  
                'email' => 'required|email|unique:system_users,email',
                'contact' => 'required|string|max:20',
                'role' => 'required|in:admin,customer',
                'password' => 'required|string|min:8|confirmed', 
                'userImage' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            
            if ($request->hasFile('userImage')) {
                $file = $request->file('userImage');
                $fileName = $file->getClientOriginalName();
                $file->storeAs('public/user_images', $fileName); 
                $validatedData['image_path'] = $fileName;
            } else {
                $validatedData['image_path'] = 'default-user.png'; 
            }
    
            $validatedData['password'] = Hash::make($request->password);
    
            $validatedData['status'] = $request->has('status');
    
            $user = SystemUser::create($validatedData);
    
            return redirect()->back()->with('status', 'User added successfully.');
    }
    


    
    public function editUserPage($id)
    {
        $user = SystemUser::findOrFail($id);
        return view('admin_dashboard.edit_users', compact('user'));
    }
    


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'nullable|string|max:15',
            'role' => 'required|in:admin,user',
            'userImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);
    
        $user = SystemUser::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->contact = $request->input('contact');
        $user->role = $request->input('role');
        $user->status = $request->input('status') ? 1 : 0;
    
        if ($request->hasFile('userImage')) {
            $fileName = $request->file('userImage')->getClientOriginalName(); 
            $request->file('userImage')->storeAs('user_images', $fileName, 'public');

            $user->image_path = $fileName;
        }
        
        $user->save();
    
        return redirect()->route('show_users')->with('status', 'User updated successfully.');
    }
    


    
    public function destroy($id)
    {
        $user = SystemUser::findOrFail($id);
        $user->delete();
        return redirect()->route('show_users')->with('status', 'User deleted successfully.');
    }
    

}
    


