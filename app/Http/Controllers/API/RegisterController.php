<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

use Jenssegers\Agent\Agent;
   
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
       // Fo Device
       $agent = new Agent();
       $platform = $agent->platform();
       //    dd($platform);

        // For Browser
        // $agent = new Agent();
        $browser = $agent->browser();
        Print_r($browser);
        // $agent->save();
        // For Ip Address
        // echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";s   

        $user_ip_address=$request->ip();    

        // For Image Submission
        $image = $request->file('profile');
        $profile = time().'.'.$image->getClientOriginalExtension();
        $destinationpath = public_path('/images');
        $image->move($destinationpath,$profile);

        //statue by default inactive (0)
        $status ="0";



        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
         
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['is_admin'] = "0";
        $input['phone'] = $request->phone;
        $input['ip'] = $user_ip_address;
        // $input=$user_ip_address->ip; 
        $input['browser'] = $browser;
        $input['country'] = $request->country;
        $input['device'] = $platform;
        $input['key'] = $request->key; 
        $input['token'] = $request->token;
        $input['countrycode'] = $request->countrycode;
        $input['address'] = $request->address;
        $input['profile'] = $profile ;
        $input['state'] = $request->state;
        $input['nationality'] = $request->nationality;
        $input['gender'] = $request->gender;
        $input['date_of_birth'] = $request->date_of_birth;
        $input['city'] = $request->city;
        $input['userrole'] = $request->userrole;
        $input['status'] = $status;





        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
   
            // return $this->sendResponse($success, 'User login successfully.');

            if(Auth()->user()->is_admin === 1)
            {
                // return response()->json([
                //       "message" => 'you are admin',
                // ]);
                return $this->sendResponse($success, 'Admin login successfully.');
            }
            else{
                // return response()->json([
                //    "message" => 'You are user',
                // ]);
                return $this->sendResponse($success, 'User login successfully.');
            }
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

     // Show all users data
     public function showusersdata(Request $request)
     {
         return User::all();
     }

     // Update user data
     public function User_id(Request $request, $id)
     {
         return User::find($id);
     }
     public function Updateuserdata(Request $request, $id)
     {
        $input = User::find($id);

         // Fo Device
       $agent = new Agent();
       $platform = $agent->platform();
    //    dd($platform);
        // For Browser
         $agent = new Agent();
        $browser = $agent->browser();
       
        // $agent->save();
        // For Ip Address
        // echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";s   

        $user_ip_address=$request->ip();  

        $image = $request->file('profile');
        $profile = time().'.'.$image->getClientOriginalExtension();
        $destinationpath = public_path('/images');
        $image->move($destinationpath,$profile);

        $input ->name=$request->name;
        $input ->lname=$request->lname;
        $input ->email =$request->email;
        $input ->phone =$request->phone;
        $input ->country =$request->country;
        $input ->countrycode =$request->countrycode;
        $input ->address =$request->address;
        $input ->profile = $profile;
        $input ->state =$request->state;
        $input ->nationality =$request->nationality;
        $input ->gender =$request->gender;
        $input ->date_of_birth =$request->date_of_birth;
        $input ->city =$request->city;
        $input ->pincode =$request->pincode;
        $input ->userrole =$request->userrole;    
        $input ->status = $request->status;
        $input ->ip = $user_ip_address;
        $input ->browser = $browser;
        $input ->device = $platform;
        $input->update();
        return "data submitted";
     }


     // Function to Add new user by Admin
     public function newuser(Request $request)
     {
        // Fo Device
       $agent = new Agent();
       $platform = $agent->platform();
       //    dd($platform);

        // For Browser
        // $agent = new Agent();
        $browser = $agent->browser();
        Print_r($browser);
        // $agent->save();
        // For Ip Address
        // echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";s   

        $user_ip_address=$request->ip();    

        // For Image Submission
        $image = $request->file('profile');
        $profile = time().'.'.$image->getClientOriginalExtension();
        $destinationpath = public_path('/images');
        $image->move($destinationpath,$profile);

        //Status By Default inactive(0)
        $status = "0";



        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
         
        $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        $input['is_admin'] = "0";
        $input['phone'] = $request->phone;
        $input['ip'] = $user_ip_address;
        // $input=$user_ip_address->ip; 
        $input['browser'] = $browser;
        $input['country'] = $request->country;
        $input['device'] = $platform;
        $input['key'] = $request->key; 
        $input['token'] = $request->token;
        $input['countrycode'] = $request->countrycode;
        $input['address'] = $request->address;
        $input['profile'] = $profile ;
        $input['state'] = $request->state;
        $input['nationality'] = $request->nationality;
        $input['gender'] = $request->gender;
        $input['date_of_birth'] = $request->date_of_birth;
        $input['city'] = $request->city;
        $input['userrole'] = $request->userrole;
        $input['status'] = $status;


        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'New User Added Successfully.');
     }



     // Function for Change Password
     public function changepassword(Request $request, $id)
     {
        $input = User::find($id);
        $req = bcrypt($input['newpassword']);
        $input->password =$req;
        $input->update();  
        return "Updated";
     }

     //Function for logout
    // public function logoutApi()
    // { 
    //     // if (Auth::check()) 
    //     // {
    //     //   Auth::user()->AauthAcessToken()->delete();
    //     //   return response()->json([
    //     //       'message' => 'Logout out',
    //     //   ]);
    //     // }
    //     if(Auth()->user() === true)
    //     {
    //       Auth::user()->AauthAcessToken()->delete();
    //       return response()->json([
    //          'Message' => 'Loged out',
    //       ]);
    //     }
    // }


    
    public function logout(Request $request)
    {
    
    //     if (Auth::user()) {
    //         $user = Auth::user()->token();
    //         $user->revoke();
    
    //         return response()->json([
    //           'success' => true,
    //           'message' => 'Logout successfully'
    //       ]);
    //       }else {
    //         return response()->json([
    //           'success' => false,
    //           'message' => 'Unable to Logout'
    //         ]); 
    //   }

    if (Auth::check()) {
        Auth::user()->AauthAcessToken()->delete();
        return response()->json([
           "message" => "you are logout"
        ]);
     }
     else{
         return response()->json([
              "message" => "Logout not working "
         ]);
     }
        
     }

}