<?php

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required|string|confirmed',
        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);
        $user->assignRole($request->input('roles'));
        $user->save();

        return response()->json([
            "success"=>true,
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Request $request){

      $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
         $credentials = request(['username', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Username or password is incorrect!',
                'status' => 302,
                'success' => false
            ], 401);
     $user = $request->user();
       $tokenResult = $user->createToken('Personal Access Token');
         $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'success'=>true,
            'status'=>300,
            'message'=>'Your logged in!!',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user'=>['name'=>$user->name,'username'=>$user->username,'phone'=>$user->phone,
            'last_login'=>$user->last_sign_in_at->toDateTimeString(),]
        ]);
    }

    
        public function logout()
        {
            $access_token = auth()->user()->token();
            // logout from only current device
            $tokenRepository = app(TokenRepository::class);
            $tokenRepository->revokeAccessToken($access_token->id);
    
        
    
            return response()->json([
                'success' => true,
                'message' => 'User logout successfully.'
            ], 200);
        }

    public function user(Request $request){
        return response()->json(['success'=>true,'data'=>$request->user()]);
    }
}
