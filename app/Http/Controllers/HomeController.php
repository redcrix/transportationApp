<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

public function showform()
{
    return view('register');
}


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




    public function showUserdata()
    {
       $users = DB::table('users')->where('user_type', 2)->get();

      return view('userdata',['users'=>$users]);
      
    }



    public function destroy($id)
    {
    DB::table('users')->where('id', $id)->delete();
      $users = DB::table('users')->where('user_type', 2)->get();
         return view('userdata',['users'=>$users]);
    }




  public function edit($id)
    {
        $users = DB::table('users')->where('id', $id)->get();
        return view('edituser',['users'=>$users]);
    }





  public function update(Request $request)
  {
$input=$request->all();
    $this->validate($request, [
        'id'=>'required',
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'email'         =>  'required',
            'address'       =>  'required',
            'phone'         =>  'required',
            'gender'         =>  'gender',
        ]);

     
      DB::table('users')->where('id', $input['id'])->update([
      'first_name' =>  $input['first_name'],
      'last_name' =>  $input['last_name'],
      'email' =>  $input['email'],
      'address' => $input['address'],
      'phone' => $input['phone'],
      'gender' => $input['gender']  
    ]);
    $users = DB::table('users')->where('user_type', 2)->get();
    return view('userdata',['users'=>$users]);
}

public function profile()
    {
        $users = DB::table('users')->where('user_type', 2)->get();
                return view('/profile',['users'=>$users]);
    }



public function show()
{
    return view('profileimage', ['user' => Auth::user()] );
}



 public function update_image(Request $request) {
    $this->validate($request, [
      'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ]);
 
    $filename = Auth::id().'_'.time().'.'.$request->image->getClientOriginalExtension();
    $request->image->move(public_path('/storage/images'), $filename);
 
    $user = Auth::user();
    $user->image = $filename;
    $user->save();
    return view('profileimage', ['user' => Auth::user()] );

    }

  }
