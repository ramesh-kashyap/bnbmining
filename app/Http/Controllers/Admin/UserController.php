<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use App\Models\Income;
use App\Models\Investment;
use App\Models\Bank;
use App\Models\Withdraw;
use App\Models\BuyFund;
use Auth;
use DB;
use Log;
use Validator;
use Redirect;
use Helper;
use Storage;
use Carbon\Carbon;

class UserController extends Controller
{

    public function alluserlist(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = User::orderBy('id', 'ASC');

        if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('username', 'LIKE', '%' . $search . '%')->orWhere('walletAddress', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%')
              ->orWhere('phone', 'LIKE', '%' . $search . '%')
              ->orWhere('jdate', 'LIKE', '%' . $search . '%')
              ->orWhere('active_status', 'LIKE', '%' . $search . '%');
            });

          }
                $notes = $notes->orderBy('id', 'ASC')->paginate($limit)
                    ->appends([
                        'limit' => $limit
                    ]);

                    $this->data['alluserlist'] =  $notes;
                    $this->data['search'] = $search;
                    $this->data['page'] = 'admin.users.alluserlist';
                    return $this->admin_dashboard();


    }


    public function active_users(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = User::where('active_status','Active')->orderBy('id', 'ASC');

       if($search <> null && $request->reset!="Reset"){
        $notes = $notes->where(function($q) use($search){
          $q->Where('name', 'LIKE', '%' . $search . '%')
          ->orWhere('username', 'LIKE', '%' . $search . '%')->orWhere('walletAddress', 'LIKE', '%' . $search . '%')
          ->orWhere('email', 'LIKE', '%' . $search . '%')
          ->orWhere('phone', 'LIKE', '%' . $search . '%')
          ->orWhere('jdate', 'LIKE', '%' . $search . '%')
          ->orWhere('active_status', 'LIKE', '%' . $search . '%');
        });

      }
            $notes = $notes->paginate($limit)
                ->appends([
                    'limit' => $limit
                ]);

     $this->data['active_user'] =  $notes;
     $this->data['search'] = $search;
     $this->data['page'] = 'admin.users.active-user';
     return $this->admin_dashboard();

    }



        public function pending_users(Request $request)
        {
            $limit = $request->limit ? $request->limit : paginationLimit();
            $status = $request->status ? $request->status : null;
            $search = $request->search ? $request->search : null;
            $notes = User::where('active_status','Pending')->orderBy('id', 'ASC');

          if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('username', 'LIKE', '%' . $search . '%')->orWhere('walletAddress', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%')
              ->orWhere('phone', 'LIKE', '%' . $search . '%')
              ->orWhere('jdate', 'LIKE', '%' . $search . '%')
              ->orWhere('active_status', 'LIKE', '%' . $search . '%');
            });

          }
                $notes = $notes->paginate($limit)
                    ->appends([
                        'limit' => $limit
                    ]);

        $this->data['active_user'] =  $notes;
        $this->data['search'] = $search;
        $this->data['page'] = 'admin.users.pending-user';
        return $this->admin_dashboard();

        }

    public function edit_users(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = User::orderBy('id', 'ASC');

        if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('username', 'LIKE', '%' . $search . '%')->orWhere('walletAddress', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%')
              ->orWhere('phone', 'LIKE', '%' . $search . '%')
              ->orWhere('jdate', 'LIKE', '%' . $search . '%')
              ->orWhere('active_status', 'LIKE', '%' . $search . '%');
            });

          }
    $notes = $notes->paginate($limit)
        ->appends([
            'limit' => $limit
        ]);

        $this->data['edit_users'] =  $notes;
        $this->data['search'] = $search;
        $this->data['page'] = 'admin.users.edit-users';
        return $this->admin_dashboard();


    }

    public function user_activation()
    {
     
     $this->data['page'] = 'admin.users.user_activate';
     return $this->admin_dashboard();

    }

    public function activate_admin_post(Request $request)
    {


      try{
            $validation =  Validator::make($request->all(), [
                'memberID' => 'required|exists:users,username',
                'amount' => 'required|in:4,10,25,80,200,400,700,1000',            
            ]);

            if($validation->fails()) {
                Log::info($validation->getMessageBag()->first());

                return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
            }
            
              

                $user=User::where('username',$request->memberID)->orderBy('id','desc')->first();
                   date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
                  $invoice = substr(str_shuffle("0123456789"), 0, 7);

                  $invest_check=Investment::where('user_id',$user->id)->where('status','!=','Decline')->orderBy('id','desc')->limit(1)->first();
                  $invoice = substr(str_shuffle("0123456789"), 0, 7);
                  $last_package=($invest_check)?$invest_check->amount:0;

                     $candition=true;
              

              if ($request->amount>$last_package)
               {
              
              	   $data = [
                        'plan' => $invoice,
                        'transaction_id' => md5(uniqid(rand(), true)),
                        'user_id' => $user->id,
                        'user_id_fk' => $user->username,
                        'amount' => $request->amount,
                        'payment_mode' => 'BUSD',
                        'status' => 'Active',
                        'sdate' => Date("Y-m-d"),
                        'active_from' => $user->username,
                        
                    ];
                    $payment =  Investment::insert($data);
                   $users = User::where('id',$user->id)->first();
                  if ($users->active_status=="Pending")
                   {
                    $user_update=array('active_status'=>'Active','adate'=>Date("Y-m-d H:i:s"),'package'=>$request->amount);
                  User::where('id',$user->id)->update($user_update);

                  $sponsorID= $users->sponsor;
                    User::where('id',$sponsorID)->where('needDirect',1)->update(['needDirect'=>0]);
                  $sponsorDetail= User::where('id',$sponsorID)->where('active_status','Active')->first();
                  if ($sponsorDetail) 
                  {
                  $direct= User::where('sponsor',$sponsorID)->where('active_status','Active')->count();
                  if ($direct==1) 
                  {
                    User::where('id',$sponsorID)->whereNull('firstDirectActivation')->update(['firstDirectActivation'=>Date("Y-m-d H:i:s")]);
                  }
                  if ($direct==6) 
                  {
                    User::where('id',$sponsorID)->whereNull('sixDirectActivation')->update(['sixDirectActivation'=>Date("Y-m-d H:i:s")]);
                  }
                  if ($direct==3) 
                  {
                    User::where('id',$sponsorID)->whereNull('thirdDirectActivation')->update(['thirdDirectActivation'=>Date("Y-m-d H:i:s")]);
                  }
                  
                  }
              

                  }
                   else
                 {
                
                    $user_update=array('package'=>$request->amount,'active_status'=>'Active',);
                  User::where('id',$user->id)->update($user_update); 
                 }
                 add_level_income($users->id,$request->amount);
                 $userID= $users->id;
                 $userName=  $users->username;
                 $check_user=\DB::table('club'.$request->amount)->where('user_id',$userID)->count();           
                 if($check_user<=0)
                 {          
                   $Report=\DB::table('club'.$request->amount)->orderBy('id','DESC')->limit(1)->first();
                   $sponsor= (!empty($Report))?$Report->username:0;
                   $userLevel = \DB::table('club'.$request->amount)->where('username',$sponsor)->first();               
                   $mxLevel= (!empty($userLevel)?$userLevel->level+1:0);          
                   $data = [
                         'ParentId' =>$sponsor,
                         'level' => $mxLevel,
                         'user_id' => $userID,
                         'username' => $userName,
                        //  'name' => $users->name,
                         'position' =>0,
                         
                     ];
                     \DB::table('club'.$request->amount)->insert($data);
                 } 
  
        
              $notify[] = ['success', 'User Activation successfully'];
            return redirect()->back()->withNotify($notify);
              }
              else
              {
                   return Redirect::back()->withErrors(array('User ALready Active '));
              }
                 

          }
           catch(\Exception $e){
            Log::info('error here');
            Log::info($e->getMessage());
            print_r($e->getMessage());
            die("hi");
            return  redirect()->route('user-activation')->withErrors('error', $e->getMessage())->withInput();
              }
        

    }
    


    public function edit_users_view($id)
    {

    try {
        $id = Crypt::decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return back()->withErrors(array('Invalid User!'));
    }

    $profile = User::where('id',$id)->first();
     $bank = Bank::where('user_id',$id)->first();
    $this->data['bank'] =  $bank;
    $this->data['profile'] =  $profile;
    $this->data['page'] = 'admin.users.users_profile_view';
    return $this->admin_dashboard();

   }

   public function users_profile_update(Request $request)

   {
       try{
           $validation =  Validator::make($request->all(), [
               'email' => 'required',
               'name' => 'required',
               'phone' => 'required|numeric'

           ]);

           if($validation->fails()) {
               Log::info($validation->getMessageBag()->first());

               return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
           }


           //check if email exist
         $post_array  = $request->all();
           $id=$post_array['id'];
         $update_data['name']=$post_array['name'];
         $update_data['phone']=$post_array['phone'];
         if(!empty($post_array['password']))
         {
           $update_data['password']= \Hash::make($post_array['password']);
         }
       //   $update_data['trx_addres']=$post_array['trx_addres'];
         $update_data['email']=$post_array['email'];
        //   $bank_array['account_holder']=$post_array['account_holder'];
        //   $bank_array['bank_name']=$post_array['bank_name'];
        //   $bank_array['branch_name']=$post_array['branch_name'];
        //   $bank_array['account_no']=$post_array['account_no'];
        //   $bank_array['user_id']=$id;
        //   $bank_array['ifsc_code']=$post_array['ifsc_code'];

         $user =  user::where('id',$id)->update($update_data);
        //  if(!empty($bank_array['account_holder']) && !empty($bank_array['account_no']))
        //  {
        //       Bank::updateOrCreate(['user_id'=>$id],$bank_array);
        //  }
       $notify[] = ['success', 'Updated successfully'];
       return redirect()->back()->withNotify($notify);

         }
          catch(\Exception $e){
           Log::info('error here');
           Log::info($e->getMessage());
           print_r($e->getMessage());
           die("hi");
           return back()->withErrors('error', $e->getMessage())->withInput();
           //return response(array('success'=>0,'statuscode'=>500,'msg'=>$e->getMessage()),500);
       }
   }



   public function block_users(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = User::wherein('active_status',array('Active','Block','Inactive'))->orderBy('id', 'DESC');;

        if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('username', 'LIKE', '%' . $search . '%')->orWhere('walletAddress', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%')
              ->orWhere('phone', 'LIKE', '%' . $search . '%')
              ->orWhere('jdate', 'LIKE', '%' . $search . '%')
              ->orWhere('active_status', 'LIKE', '%' . $search . '%');
            });

          }
                $notes = $notes->paginate($limit)
                    ->appends([
                        'limit' => $limit
                    ]);

                    $this->data['active_user'] =  $notes;
                    $this->data['search'] = $search;
                    $this->data['page'] = 'admin.users.block-users';
                    return $this->admin_dashboard();


        }
        public function block_submit(Request $request)
        {

          $id= $request->id; // or any params
          $update_data['active_status']= $request->status;
          $user =  user::where('id',$id)->update($update_data);

        $notify[] = ['success', 'User '.$request->status.' successfully'];
        return redirect()->back()->withNotify($notify);
      }

    public function boostactivation(Request $request)
        {

          $id= $request->id; // or any params
         
          $user_detail=User::where('id',$id)->orderBy('id','desc')->limit(1)->first();
          if($user_detail)
          {
        
           $data = [
                'plan' =>1,
                'transaction_id' =>md5(time() . rand()),
                'user_id' => $user_detail->id,
                'user_id_fk' => $user_detail->username,
                'amount' => 10,
                'payment_mode' => 'BUSD',
                'status' => 'Active',
                'sdate' => Date("Y-m-d"),
                'active_from' => $user_detail->username,
                'walletType' =>1,

            ];
            $payment =  \DB::table('boost_investments')->insert($data);
       
            User::where('id',$user_detail->id)->update(['isbost'=>1]);
            \DB::table('club4')->where('user_id',$user_detail->id)->update(['isbost'=>1]);
          
          }
         

        $notify[] = ['success', 'User '.$request->status.' successfully'];
        return redirect()->back()->withNotify($notify);
      }




}
