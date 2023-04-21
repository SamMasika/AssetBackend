<?php

namespace App\Http\Controllers\Api\User;

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
    
    public function index()
    {
        $users=User::with('department')->with('office')->where('flug',1)->get();
        $count=User::where('flug',1)->count();
        return response()->json(['success'=>true,'status'=>300, 'data'=> $users ,'count'=>$count],200);
    }


    public function store( Request $request) 
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'username' => 'required',
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
      $users->office_id=$request->office_id;
      $users->save();
      return response()->json([
        'success'=>true,
        'status'=>300,
        'message'=>'User created successfully!',
    ]);
    }

    public function update(Request $request,$id)
    {
        $users=User::find($id);
        $users->name=$request->name;
        $users->email=$request->email;
        $users->username=$request->username;
        $users->password=bcrypt($request->password);
        $users->phone=$request->phone;
        $users->depart_id=$request->depart_id;
        $users->office_id=$request->office_id;
        $users->flug=$request->flug;
        $users->update();
        return response()->json([
            'success'=>true,
            'status'=>300,
            'message'=>'User Updated successfully!',
        ]);
    }
    public function show($id)
    {
        $users=User::find($id);
        $roles = Role::join('model_has_roles','model_has_roles.role_id' , '=', 'roles.id')
        ->where('model_has_roles.model_id',$id)
        ->get(['roles.name',]);
        return response()->json(['success'=>true,'status'=>300, 'data'=> $users ,'roles'=>$roles],200);
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
        $user->flug=0;
        $user->update();
        return response()->json([
            'success'=>true,
            'status'=>300,
            'message'=>'User Deleted successfully!',
        ]);
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
            return response()->json([
                'success'=>true,
                'status'=>300,
                'message'=>"Old Password Doesn't match!",
            ]);
        }

        #Update the new Password
      User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return response()->json([
            'success'=>true,
            'status'=>300,
            'message'=>'Password Changed successfully!',
        ]);
}

public function activate($id)
{
    $user=User::find($id);
    if($user->status==0)
    {
        $user->status=1;
        $user->save();
        return response()->json([
            'success'=>true,
            'status'=>300,
            'message'=>'User is Activated Successfully!',
        ]);  
    }elseif($user->status==1)
    {
        $user->status=0;
        $user->save();
        return response()->json([
            'success'=>true,
            'status'=>300,
            'message'=>'User is Deactivaed Successfully!',
        ]);
    }
}
}
