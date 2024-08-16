<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Elliptic\EC;
use Illuminate\Support\Str;
use kornrunner\Keccak;

class Login extends Controller
{
    

    public function login(Request $request)
    {
      
            $validation =  Validator::make($request->all(), [
                'username' => 'required|unique:users',
                'password' => 'required|string',
            ]);
        
            // dd($request);
            $post_array  = $request->all();
            $credentials = $request->only('username', 'password');
                 
            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                if($user->active_status=="Block")
                {
                Auth::logout();
               return Redirect::back()->withErrors(array('You are Blocked by admin'));
                }



                return redirect()->route('user.dashboard');
            }
            else
            {
                // echo "credentials are invalid"; die;
                return Redirect::back()->withErrors(array('Invalid Username & Password !'));
            }
        
        }



    public function forgot_password()
    {
            
    return view('auth.passwords.forgot-password');
    
    }

    public function verify(Request $request)
    {
        // $message= [{"address":"JBDFUIEWBFIUDUGDGB"}];
        // dd($message);
        $myObj = new \stdClass();
        $myObj->address="OINDHUIWGIDFYIWDBUDHUDWIDUBDU";
        $myObj->message="Hey";
        $message[] = $myObj;
        $message=json_encode($message);

        $result = $this->verifySignature($message, $request->input('signature'), $request->input('address'));
      
        // If $result is true, perform additional logic like logging the user in, or by creating an account if one doesn't exist based on the Ethereum address
        $isValidated = ($result ? 'OK' : 'ERROR');
        if ($isValidated=="OK") 
        {

            if ($request->input('isLogin')==1) 
            {
          
            $userLogin= User::where('walletAddress',$request->input('address'))->first();
        
            if (!$userLogin) 
            {
                return response()->json(['error' => 'user not found.','status'=>400], 200);
            }
            if (Auth::check()) {
                return response()->json(['token' => Auth::user()->remember_token,'status'=>200], 200);
    
            }
            Auth::loginUsingId($userLogin->id);
            return response()->json(['token' => $userLogin->remember_token,'status'=>200], 200);
            }
            else
            {
            $user = User::where('walletAddress',$request->input('address'))->first();
            if($user)
            {
                return response()->json(['error' => 'Wallet Address already exist.','status'=>400], 200);
            }
            $user = User::where('username',$request->input('sponsorID'))->where('active_status','Active')->first();
            if(!$user)
            {
                return response()->json(['error' => 'Referral ID not found.','status'=>400], 200);
            }

            
            $totalID = User::count();
            $totalID++;
            $username =substr(time(),4).$totalID;
            $data['username'] = $username;
            $data['walletAddress'] =$request->input('address');
            $data['sponsor'] = $user->id;
            $data['package'] = 0;
            $data['jdate'] = date('Y-m-d');
            $data['created_at'] = Carbon::now();
            $data['remember_token'] = substr(rand(),-7).substr(time(),-5).substr(mt_rand(),-4);
            $sponsor_user =  User::orderBy('id','desc')->limit(1)->first();      
            $data['level'] = $user->level+1;
            $data['ParentId'] =  $sponsor_user->id;
            $user_data =  User::create($data);
            $registered_user_id = $user_data['id'];
            $user = User::find($registered_user_id);
            Auth::loginUsingId($registered_user_id);
            return response()->json(['token'=> $user_data['remember_token'],'status'=>200], 200);
         }

    }
    else
    {
        return response()->json(['error' => 'user not found.','status'=>400], 200);
    }
     
     

    }

    protected function verifySignature(string $message, string $signature, string $address): bool
    {
        $hash = Keccak::hash(sprintf("\x19Ethereum Signed Message:\n%s%s", strlen($message), $message), 256);
        $sign = [
            'r' => substr($signature, 2, 64),
            's' => substr($signature, 66, 64),
        ];
        $recid = ord(hex2bin(substr($signature, 130, 2))) - 27;

        if ($recid != ($recid & 1)) {
            return false;
        }

        $pubkey = (new EC('secp256k1'))->recoverPubKey($hash, $sign, $recid);
        $derived_address = '0x' . substr(Keccak::hash(substr(hex2bin($pubkey->encode('hex')), 1), 256), 24);

        return (Str::lower($address) === $derived_address);
    }



    public function message()
    {

        $nonce = Str::random();

        $myObj = new \stdClass();
        $myObj->address="OINDHUIWGIDFYIWDBUDHUDWIDUBDU";
        $myObj->message="Hey";
        $message[] = $myObj;
        $myObj = new \stdClass();
        $myObj->address="IOWDHHIODHIU";
        $myObj->message="Hey";
        $message3[] = $myObj;

    //    dd($message);
        // $message= ["address"=>"JBDFUIEWBFIUDUGDGB"];
        $message=json_encode($message);
        $message3=json_encode($message3);
        session()->put('sign_message', $message3);

        return $message;
    }


     public function Sign($message, $privateKey, $verbose = False) {
        // $secp256k1 = new Secp256k1();
        $ec = new EC('secp256k1');
        $secp256k1 = $ec->keyFromPrivate($privateKey, 'hex');
     
        if ($verbose) {
            echo "Sign(message):            $message\r\n";
        }
    
        // return signature contains r, s and recovery param (v).
        // message and privateKey are hex strings
        // dd($secp256k1,$message,$privateKey);
        $signature = $secp256k1->sign($message, $privateKey, [
            "canonical" => true,
            "n" => null,
        ]);
    
        $result = "0x" . $signature->toHex();
    
        // kornrunner library does not add the recovery param (recid) at the end, so we must do it ourselves
        // This hack with 0 is ok, as recovery param is always between 0 and 3
        $result = $result . "0" . dechex($signature->getRecoveryParam());
    
        return $result;
    }

    



    public function forgot_password_submit(Request $request)
    {
         $validation =  Validator::make($request->all(), [
                'username' => 'required|unique:users',

            ]);
            

        $credentials = User::where('username',$request->username)->first();
 
        if ($credentials)
        {
         
           $userIpInfo = getIpInfo();
           $userBrowserInfo =osBrowser();
           $code = verificationCode(6);
         
          PasswordReset::where('email', $credentials->email)->delete();
    
        $password = new PasswordReset();
        $password->email = $credentials->email;
        $password->token = $code;
        $password->created_at = \Carbon\Carbon::now();
        $password->save();
        
               sendEmail($credentials->email, 'Recovery Password', [
                'name' => $credentials->name,
                 'browser' => @$userBrowserInfo['browser'],
                 'ip' => @$userIpInfo['ip'],
                 'time' => @$userIpInfo['time'],
                'operating_system' => @$userBrowserInfo['os_platform'],
                'code' => $code,
                'viewpage' => 'forgot_sucess',
             
             ]);
            
              $page_title = 'Account Recovery';
             $userID = $credentials->id;
            session()->put('pass_res_mail',$userID);
            $notify[] = ['success', 'Password reset email sent successfully'];
            return redirect()->route('codeVerify')->withNotify($notify);
        }
        else{
            $notify[] = ['error', 'Invalid Username '];
            return redirect()->route('forgot-password')->withNotify($notify);
        }
        
      
        
    }

    public function codeVerify(){
        $page_title = 'Account Recovery';
        $userID = session()->get('pass_res_mail');
        
        $user_name = session()->get('username');

        if (!$userID) {
            $notify[] = ['error','Opps! session expired'];
            return redirect()->route('forgot-password')->withNotify($notify);
        }

        return view('auth.passwords.confirm',compact('page_title','userID','user_name'));
    }

    
    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required', 'userID' => 'required']);
        $code = $request->code;
        $userDetail=User::where('id',$request->userID)->first();

        if (PasswordReset::where('token', $code)->where('email', $userDetail->email)->count() != 1) {
            $notify[] = ['error', 'Invalid token'];
            return redirect()->route('forgot-password')->withNotify($notify);
        }
        $notify[] = ['success', 'You can change your password.'];
        session()->flash('fpass_email', $request->userID);
        session()->put('resetMail',$request->userID);
        return redirect()->route('resetPassword', $code)->withNotify($notify);
    }


    public function resetPassword()
    {
        $page_title = "Forgot Password";
    //   dd("hi");
        return view('auth.passwords.resetPassword', compact('page_title'));
    }
  


    public function submitResetPassword(Request $request)
    {
      
    $request->validate(['password' => 'required|confirmed|min:5']);

       $userID = session()->get('resetMail');

    //    dd($userID);
    //    die;

       $user_name = session()->get('username');

       $user = User::where('id',$userID)->orderBy('id', 'DESC')->first();
     

       if (!$user) {
        $notify[] = ['error','Opps! session expired'];
        return redirect()->route('forgot-password')->withNotify($notify);
       }
       $password = password_hash($request->password, PASSWORD_DEFAULT);
       
       $user->password=$password;
       $user->PSR=$request->password;
       $user->save();
       $notify[] = ['success', 'Your Password change Successfully.'];
       return redirect()->route('login')->withNotify($notify);
        
    }



}
