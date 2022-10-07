<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\customer;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class Customercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return customer::all();
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
        $validatedData = $request->validate([
            'name' => 'required|Alpha',
            'email' => 'required|email',
            'password' => 'required',
          ]);

       //return customer::create($request->all());
       $data= new customer;
       $data->name=$request->name;
       $data->email=$request->email;
       $data->password=Hash::make($request->password) ;
       return $data->save();
          
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
        //return customer::find($id);
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
    public function update(Request $request)
    {
    
        
        $user = customer::find($request->id);
        $user->name=$request->name;
        $user->email = $request->email;
        $user->password=Hash::make($request->password) ;
        $user->password = Hash::make($request->password);
        if($user->save())  {

            return ["response"=>"updated"];

        }else{
            
            return ["response"=>"not updated"];
        }

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
                $data=customer::find($id)->delete();

                if($data){

                    return ["Response"=>"deleted"];
                }else{
                    return ["Response"=>"Not delete"];
                }

                
    }


     /**
     * search the specified resource from storage.
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)   
    {
        //
               $data=customer::where('name',$name)->get();
               return $data;
               
               
    }
}
