<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Investment;
use App\Models\Bank;
use App\Models\Withdraw;
use App\Models\Payout;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Log;
use Redirect;
use Hash;
use Helper;

class WithdrawRequest extends Controller
{
    public function index(Request $request)
    {
      $user=Auth::user();


      $limit = $request->limit ? $request->limit : paginationLimit();
      $status = $request->status ? $request->status : null;
      $search = $request->search ? $request->search : null;
      $notes = Withdraw::where('user_id',$user->id);
     if($search <> null && $request->reset!="Reset"){
      $notes = $notes->where(function($q) use($search){
         $q->Where('wdate', 'LIKE', '%' . $search . '%')
           ->orWhere('amount', 'LIKE', '%' . $search . '%')
           ->orWhere('status', 'LIKE', '%' . $search . '%')
           ->orWhere('txn_id', 'LIKE', '%' . $search . '%');
      });

     }

      $notes = $notes->paginate($limit)->appends(['limit' => $limit ]);

    $this->data['search'] =$search;
    $this->data['withdraw_report'] =$notes;
        $this->data['page'] = 'user.withdraw.WithdrawRequest';
        return $this->dashboard_layout();
    }

    public function WithdrawRequest(Request $request)
    {

        try{

             $validation =  Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
             'trx_address' => 'required',    
            // 'transaction_password' => 'required',


        ]);

        if($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
        }

        $user=Auth::user();
        $password= $request->transaction_password;
        $balance=Auth::user()->available_balance();


        if($user->isbost!=1)
        {
         return Redirect::back()->withErrors(array('boost your account for withdrawal !'));    
        }
        
      if($user->needDirect==1)
        {
         return Redirect::back()->withErrors(array('you need to one more direct for withdrawal !'));    
        }
    
        if ($balance>=$request->amount)
        {
         $user_detail=Withdraw::where('user_id',$user->id)->where('status','Pending')->first();

         if(!empty($user_detail))
         {
           return Redirect::back()->withErrors(array('Withdraw Request Already Exist !'));
         }
         else
         {
     
          if(!empty($user->walletAddress))
              {
                  
         
        //      $mywithdrawal = Withdraw::where('user_id',$user->id)->where('status','Approved')->pluck("txn_id");
        //   $totalwithdrwal=\DB::table('withdrawals')->where('Address',$user->walletAddress)->whereNotIn('WithdrawalID',$mywithdrawal)->sum('Amount');
        //   $totalincomes= Auth::user()->users_incomes->sum('comm');
        //   $maxWithdrawal=$totalwithdrwal+Auth::user()->withdraw();
            // if($maxWithdrawal<=$totalincomes)  
            // {
                  
            if ($balance>=$request->amount)
           {
            
                   $data = [
                        'txn_id' =>md5(time() . rand()),     
                        'user_id' => $user->id,
                        'user_id_fk' => $user->username,
                        'amount' => $request->amount,
                        'account' => $user->walletAddress,
                        'isnew' => 1,
                        'payment_mode' => 'BUSD',
                        'status' => 'Pending',
                        'wdate' => Date("Y-m-d"),
                    
                        
                    ];
                  $payment =  Withdraw::Create($data)->id;
                  $lastId = $payment;
                   
                //   dd($lastId);
                 
                   $mywithdrawal = Withdraw::where('user_id',$user->id)->where('status','!=','Failed')->where('isnew',1)->count();
                   
                   $leftover = $mywithdrawal / 5;
                   $leftover = $leftover - floor($leftover);
                   
                //   echo $leftover." ".$mywithdrawal;die;
                   if($leftover==0 && $mywithdrawal>0)
                   {
                   User::where('id',$user->id)->update(['needDirect'=>1]);
                   }
            
               
       
            $notify[] = ['success','Withdraw Request Submited successfully'];
    
            return redirect()->back()->withNotify($notify);

          
            }
            else
            {
            return Redirect::back()->withErrors(array('Insufficient balance in Your account'));
            }        
             
            // }
            // else
            // {
                
            //     $balance = abs($totalincomes-$totalwithdrwal);
            //     $amt = $request->amount;
            //     if($amt>$balance)
            //     {
            //      $amt=$balance;
            //     }
          
          
            //   $data = [
            //             'txn_id' =>md5(time() . rand()),     
            //             'user_id' => $user->id,
            //             'user_id_fk' => $user->username,
            //             'amount' => $amt,
            //             'account' => $user->walletAddress,
            //             'payment_mode' => 'BUSD',
            //             'status' => 'Approved',
            //             'wdate' => Date("Y-m-d"),
            //             'response' => 1,
                    
            //         ];
            //       $payment =  Withdraw::Create($data)->id;
                
            //       $notify[] = ['success','Withdraw Request Submited successfully'];
    
            // return redirect()->back()->withNotify($notify);

                
            // }
                
              }
              else
                {
                return Redirect::back()->withErrors(array('Please Update Your USDT Payment Address'));
                }  


         }

        }
        else
        {
     return Redirect::back()->withErrors(array('Insufficient balance in Your account'));
        }

    }
    catch(\Exception $e){
     Log::info('error here');
     Log::info($e->getMessage());
     print_r($e->getMessage());
     die("hi");
     return  redirect()->route('user.WithdrawRequest')->withErrors('error', $e->getMessage())->withInput();
       }




    }

    public function WithdrawHistory(Request $request){

        $user=Auth::user();
        $limit = $request->limit ? $request->limit : paginationLimit();
         $status = $request->status ? $request->status : null;
         $search = $request->search ? $request->search : null;
         $notes = Withdraw::where('user_id',$user->id);
        if($search <> null && $request->reset!="Reset"){
         $notes = $notes->where(function($q) use($search){
            $q->Where('wdate', 'LIKE', '%' . $search . '%')
              ->orWhere('amount', 'LIKE', '%' . $search . '%')
              ->orWhere('status', 'LIKE', '%' . $search . '%')
              ->orWhere('txn_id', 'LIKE', '%' . $search . '%');
         });

        }

         $notes = $notes->paginate($limit)->appends(['limit' => $limit ]);

       $this->data['search'] =$search;
       $this->data['withdraw_report'] =$notes;
       $this->data['page'] = 'user.withdraw.WithdrawHistory';
       return $this->dashboard_layout();
    }
}
