<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
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
            $success['api_token'] =  $user->createToken('MyApp')-> accessToken; 
            //return response()->json(['success' => $success], $this-> successStatus); 
            return response()->json(['code'=>200,'data'=>$success,'success'=>true,'message'=>'User login successfully'], $this-> successStatus); 
        } 
        else{ 
            //return response()->json(['error'=>'Unauthorised'], 401); 
             return response()->json(['code'=>401,'success'=>false,'message'=>'User Unauthorised'], $this-> successStatus); 

        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'email' => 'required|email',
            'phone' => 'required|min:10|numeric',
            'password' => 'required', 
            'c_password' => 'required|same:password',
            'address' => 'required', 
            'gender' => 'required|numeric', 
            'user_type' => 'required|numeric',
        ]);
if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
$input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
return response()->json(['success'=>$success], $this-> successStatus); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
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

        $request->image->storeAs('images',$imageName);

        $user->image = $imageName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');

    }
}