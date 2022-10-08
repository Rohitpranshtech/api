<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|Alpha',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = new user;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();

        $token = $data->createToken($request->name)->plainTextToken;

        return response([

            'data' => $data,
            'token' => $token,
            'status'=>'success',
            'message'=>'Insert recors'

        ], 201);

    }

//login user and genrate token

    // public function login(Request $request)
    // {

    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',

    //     ]);

    //     $user=user::where('email',$request->email)->first();

    //     if($user && Hash::check($request->password,$user->password))
    //     {
    //         $token = $user->createToken($request->email)->plainTextToken;

    //         return response([
    //                 'token'=>$token,
    //                 'message'=>"login",
    //                 'status'=>'success'

    //         ],201);

    //     }
    // }


       
//logout user and delete token

    public function logout()
    {

        auth()->user()->tokens()->delete();

        return response([

                'message' =>'Successfully Logout !!',
                'status' => 'success'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

  ///login user

    public function login(Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            
        ]);
 
        $user= request(['email', 'password']);
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message'=> 'Invalid email or password'
            ], 401);
        }
           
 
        $user = $request->user();
        $token = $user->createToken('AccessToken')->plainTextToken;

        User::where('email',$request->email)->update([

            'remember_token' => $token,

         ]); 
 
         
        $user->access_token = $token;
       
        return response()->json([
            "user"=>$user,
            "login"=>'Login success'
        ], 200);

        
        

    }
}
