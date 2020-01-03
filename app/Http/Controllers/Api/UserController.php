<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 

            return response()->json(['code'=>200,'data'=>$success,'success'=>true,'message'=>'User login successfully'], $this-> successStatus); 
           // return response()->json(['code'=>$this->successStatus,'message'=>'User login successfully','error' => false,'data'=>$success]);
        } 
        else{ 
           // return response()->json(['error'=>'Unauthorised'], 401); 
          // return response()->json(['code'=>401,'message'=>'User Unauthorised','error' => true]);
            return response()->json(['code'=>201,'success'=>false,'message'=>'User Unauthorised'], $this-> successStatus); 

        } 

    }
/** s
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10|numeric|unique:users',
            'phone_verified' => 'required|same:phone',
            'password' => 'required', 
            'c_password' => 'required|same:password', 
            'gender' => 'required|numeric',
            'address' => 'required|max:255',
            'user_type' => 'required|numeric',
            
            
        ]);
if ($validator->fails()) { 
    return response()->json(['code'=>201,'success'=>false,'message'=>$validator->errors()]);        
        }
$input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
       // $input['image'] = $this->getProfileImage($input['image']);
        $input['api_token'] = Str::random(80);
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->first_name.' '.$user->last_name;
return response()->json(['code'=>200,'data'=>$success,'success'=>true,'message'=>'user registered successfully'], $this-> successStatus); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 


 /*   protected function getProfileImage($img) {
        //$img->getClientOriginalExtension();
       $imageName = time() . '.' . $img->getClientOriginalExtension();
       $img->move(base_path() . '/public/images', $imageName);
            return $imageName;
} */

// user details api

    public function details() 
    { 
        $user = Auth::user(); 

        return  response()->json(['code'=>200,'message'=>'success','data' => $user],$this->successStatus);
    }



// all user details api

    public function getallusers()
    {
        $users=User::all();
        return  response()->json(['code'=>200,'message'=>'success','data' => $users],$this->successStatus); 
        
    }


//update user details api


    public function update(Request $request)
         {
             
        $user = Auth::user(); 
        $user->update($request->all());
        return  response()->json(['code'=>200,'message'=>'success','data' => $user],$this->successStatus); 

    }


// single user details api
    public function edit(Request $request)
        {       
        $user = Auth::user(); 
        //$user->update($request->all());
        return  response()->json(['code'=>200,'message'=>'success','data' => $user],$this->successStatus); 

    }



    //delete single user from list

    public function delete(Request $request) 
{
    $validator = Validator::make($request->all(), [ 
            'user_id' => 'required'
            ]);
if ($validator->fails()) { 
            //return response()->json(['error'=>$validator->errors()], 401);
            return response()->json(['code'=>201,'message'=>$validator->errors(),'success' => false]);            
        }
    $input=$request->all();
     try {
    User::findorfail($input['user_id'])->delete();
}
    catch (ModelNotFoundException $exception) {
        return response()->json(['code'=>201,'message'=>'No user found with id '.$input['user_id'].'','success' => false]);
        //return back()->withError($exception->getMessage())->withInput();
    }
    return  response()->json(['code'=>200,'message'=>'user successfully removed ','success' => true],$this->successStatus); 
   // return $user->delete();
}

 public function profile()
    {
        $user = Auth::user();
        return view('profile',compact('user',$user));
    }
    
public function update_image(Request $request){

        $request->validate([
             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $imageName = $user->id.'_image'.time().'.'.request()->image->getClientOriginalExtension();

        $request->image->storeAs('image',$imageName);

        $user->image = $imageName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');

    }
    }
