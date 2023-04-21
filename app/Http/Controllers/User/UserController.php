<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()

    {

    //     $this->middleware('permission:view userslist|delete-user|edit-user|view-user', ['only' => ['index','show',]]);
    //      $this->middleware('permission:create-user', ['only' => ['create','store']]);
    //    $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
    //     $this->middleware('permission:delete-user', ['only' => ['destroy']]);

    }
    public function index($id=NULL)
    {
        $users=$id?User::find($id):User::where('flug',1)->get();
        $departments=Department::where('flug',1)->get();
        $roles=Role::where('flug',1)->get();
      
        $userRole = DB::table('model_has_roles')
        ->where('model_has_roles.model_id', $id)
        ->pluck('model_has_roles.role_id','model_has_roles.role_id')
        ->all();
        return view('auth.user.index',compact('users','roles','departments','userRole'));
    }


    public function store( Request $request) 
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'lname' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|confirmed',
         
        // ]);
        
    
      $users=new User();
      $users->name=$request->name;
      $users->email=$request->email;
      $users->username=$request->username;
      $users->password=bcrypt($request->password);
      $users->phone=$request->phone;
      $users->depart_id=$request->depart_id;
      $users->save();
        return redirect()->back()
            ->with('status',"User created successfully.");
    }

    public function update()
    {
        $users->User::find($id);
        $users->name=$request->name;
        $users->email=$request->email;
        $users->username=$request->username;
        $users->password=bcrypt($request->password);
        $users->phone=$request->phone;
        $users->depart_id=$request->depart_id;
        $users->update();
        return redirect()->back()
            ->with('status',"User Updated successfully.");
    }
    public function view($id)
    {
        $users=User::find($id);
        $roles = Role::join('model_has_roles','model_has_roles.role_id' , '=', 'roles.id')
        ->where('model_has_roles.model_id',$id)
        ->get(['roles.name',]);
        return view('auth.users.assign',compact('roles','users'));
    }

  
    public function assignView($id)
    {
       $users = User::find($id);
       $roles = Role::get();
        $userRole = DB::table('model_has_roles')
        ->where('model_has_roles.model_id', $id)
        ->pluck('model_has_roles.role_id','model_has_roles.role_id')
        ->all();
        return view('auth.user.assign',compact('users','roles','userRole'));
        // return   $userRole;
    }


     public function assignRole(Request $request,$id)
    {
            $user=User::find($id);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->username=$request->username;
            $user->phone=$request->phone;
            $user->depart_id=$request->depart_id;
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->role);
            return redirect('/user-list')->with('status', 'Role assigned.');   
    }

  

    public function destroy($id)
    {
        $user=User::find($id);
        if ($user->hasRole('Admin')) {
            return back()->with('status', 'you are superAdmin.');
        }
        $user->flug=0;
        $user->update();
        return back()->with('status', 'User deleted.');
    }  


    public function changePassword()
{
   return view('auth.passwords.change');
}

public function updatePassword(Request $request)
{
   
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

       
        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("status", "Old Password Doesn't match!");
        }

        #Update the new Password
      User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with("status", "Password changed successfully!");
}

public function activate($id)
{
    $user=User::find($id);
    if($user->status==0)
    {
        $user->status=1;
        $user->save();
        return redirect()->back()->with('status','User is Activated');  
    }elseif($user->status==1)
    {
        $user->status=0;
        $user->save();
        return redirect()->back()->with('status','User is inactive');
    }
}
}
