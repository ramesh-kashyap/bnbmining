<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Investment;
use App\Models\Boost_investment;
use App\Models\Income;
use App\Models\Club_a;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Log;
use Redirect;
use Hash;

class Invest extends Controller
{

 
    public function index()
    {
        $user=Auth::user();
        $invest_check=Investment::where('user_id',$user->id)->where('status','!=','Decline')->orderBy('id','desc')->limit(1)->first();

        $this->data['last_package'] = ($invest_check)?$invest_check->amount:0;
        $this->data['page'] = 'user.invest.Deposit';
        return $this->dashboard_layout();
    }

    public function fundActivation(Request $request)
    {

  try{
      $validation =  Validator::make($request->all(), [
          'amount' => 'required|numeric|in:4,10,25,80,200,400,700,1000',
          'txHash' => 'required|unique:investments,transaction_id',

      ]);


    if($validation->fails()) {
        Log::info($validation->getMessageBag()->first());

        return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
    }

       $user=Auth::user();

     

       $user_detail=User::where('username',$user->username)->orderBy('id','desc')->limit(1)->first();

 
        $invest_check=Investment::where('user_id',$user_detail->id)->where('status','!=','Decline')->orderBy('id','desc')->limit(1)->first();

            $invoice = substr(str_shuffle("0123456789"), 0, 7);
            $last_package=($invest_check)?$invest_check->amount:0;
            $message ="";
       
              // dd($balance); die;
              if ($request->amount>$last_package)          
              {   

            $data = [
                'plan' =>$request->plan,
                'transaction_id' =>$request->txHash,
                'user_id' => $user_detail->id,
                'user_id_fk' => $user_detail->username,
                'amount' => $request->amount,
                'payment_mode' => 'BUSD',
                'status' => 'Active',
                'sdate' => Date("Y-m-d"),
                'active_from' => $user->username,
                'walletType' =>1,

            ];
            $payment =  Investment::insert($data);
         
            if ($user_detail->active_status=="Pending")
            {
           
             $user_update=array('active_status'=>'Active','adate'=>Date("Y-m-d H:i:s"),'package'=>$request->amount);
              User::where('id',$user_detail->id)->update($user_update);

              $sponsorID= $user_detail->sponsor;
              
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
              $user_update=array('active_status'=>'Active','package'=>$request->amount);
              User::where('id',$user_detail->id)->update($user_update);
            }
            $amount = $request->amount;
            add_level_income($user_detail->id,$amount);
            $userID= $user_detail->id;
            $userName=  $user_detail->username;
            $check_user=\DB::table('club'.$amount)->where('user_id',$userID)->count();           
            if($check_user<=0)
            {          
                
                // dd($check_user);
              $Report=\DB::table('club'.$amount)->orderBy('id','DESC')->limit(1)->first();
              $sponsor= (!empty($Report))?$Report->username:0;
              $userLevel = \DB::table('club'.$amount)->where('username',$sponsor)->first();               
              $mxLevel= (!empty($userLevel)?$userLevel->level+1:0);      
        
              $data = [
                    'ParentId' =>$sponsor,
                    'level' => $mxLevel,
                    'user_id' => $userID,
                    'username' => $userName,
                    // 'name' => $user_detail->name,
                    'position' =>0,
                    
                ];
                \DB::table('club'.$amount)->insert($data);
            } 
          return true;

       
           }
          else
          {
            return Redirect::back()->withErrors(array('please choose '.$message.' Package '));
          }



  }
   catch(\Exception $e){
    Log::info('error here');
    Log::info($e->getMessage());
    print_r($e->getMessage());
    die("hi");
    return  redirect()->route('user.invest')->withErrors('error', $e->getMessage())->withInput();
      }



        }


  public function bostActivation(Request $request)
    {

  try{
      $validation =  Validator::make($request->all(), [
          'amount' => 'required|numeric|in:10',
          'txHash' => 'required|unique:boost_investments,transaction_id',

      ]);


    if($validation->fails()) {
        Log::info($validation->getMessageBag()->first());

        return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
    }

       $user=Auth::user();
       $user_detail=User::where('username',$user->username)->orderBy('id','desc')->limit(1)->first();
            $invoice = substr(str_shuffle("0123456789"), 0, 7);
         
            $message ="";
        

            $data = [
                'plan' =>$request->plan,
                'transaction_id' =>$request->txHash,
                'user_id' => $user_detail->id,
                'user_id_fk' => $user_detail->username,
                'amount' => $request->amount,
                'payment_mode' => 'BUSD',
                'status' => 'Active',
                'sdate' => Date("Y-m-d"),
                'active_from' => $user->username,
                'walletType' =>1,

            ];
            
            if($user->isbost==0)
            {
               $payment =  \DB::table('boost_investments')->insert($data);   
            }
          
       
            User::where('id',$user_detail->id)->update(['isbost'=>1]);
            \DB::table('club4')->where('user_id',$user_detail->id)->update(['isbost'=>1]);
       
          return true;

       
       


  }
   catch(\Exception $e){
    Log::info('error here');
    Log::info($e->getMessage());
    print_r($e->getMessage());
    die("hi");
    // return  redirect()->route('user.invest')->withErrors('error', $e->getMessage())->withInput();
      }



        }



  public function ditributor_gap_margin($userid,$gapMarginBonus,$amt,$userPercent,$user_detail,$level=20){
        $arrin=$userid;
        $userPercent=$userPercent;
        // dd($userPercent);
        $gapMarginBonus=$gapMarginBonus;
        $ret=array();
        $i=1;
        while(!empty($arrin) && $gapMarginBonus>0){
            $alldown=User::where('id',$arrin)->get()->first();
            if($alldown){
                $arrin = $alldown->sponsor;
                $i++;
                
            
            $Sposnor_cnt = User::where('sponsor',$alldown->id)->where('active_status','Active')->count("id");  
            $percent=0;
            if($Sposnor_cnt>=4)
            {
              $percent = 20; 
              
             if($Sposnor_cnt>=6)
              {
                $percent = 30; 
              }
              if($Sposnor_cnt>=8)
              {
                $percent = 40; 
              }
              if($Sposnor_cnt>=10)
              {
                $percent = 50; 
              }  
            
             $sponsor_profit= $percent-$userPercent; 
             
           
             
             $preSponsor= $userPercent;
             if($sponsor_profit>$gapMarginBonus)
             {
                $sponsor_profit= $gapMarginBonus;
             }
           
              $gapMarginBonus=$gapMarginBonus-$sponsor_profit;
              
         
         
        //   echo "ID :".$alldown->id."<br>";
        //   echo "Per :".$percent."<br>";
        //   echo "User :".$userPercent."<br>";
        //   echo "SP :".$sponsor_profit."<br>";
              
              if($sponsor_profit>0 && $percent>$userPercent)
              {
                $sp_pp =  $amt* $sponsor_profit;
                
                  $data = [
              'user_id' => $alldown->id,
              'user_id_fk' =>$alldown->username,
              'amt' => $amt,
              'comm' => $sp_pp,
              'remarks' => 'Gap Margin Bonus',
              'level' => $i,
              'rname' => $user_detail->username,
              'fullname' => $user_detail->name,
              'ttime' => Date("Y-m-d"),
              ];
             Income::create($data);   
              }
              
              
            $userPercent= $percent;   
            }
            else
            {
             $userPercent=$userPercent;
              $gapMarginBonus=$gapMarginBonus;
            }
         
            if($i>$level || $alldown->id==1)
            {
                break;
            }
     

            }else{
                $arrin ='';
            }
        }
        
        // dd("hi");

       


        return true;

    }
    
      public  function find_9directSponsor($snode)
      {
          $q=User::where('id',$snode)->first();
          $sponsor=User::where('sponsor',$snode)->where('active_status','Active')->count();
          if ($sponsor>=10 || $q->id==1)
          {
            $this->downline = $snode; 
          }
          else
          {
            $user = $q->id;
            $this->find_9directSponsor($user);   
          }
      }

        public function invest_list(Request $request){

    $user=Auth::user();
      $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = Investment::where('user_id',$user->id);
      if($search <> null && $request->reset!="Reset"){
        $notes = $notes->where(function($q) use($search){
          $q->Where('user_id_fk', 'LIKE', '%' . $search . '%')
          ->orWhere('txn_no', 'LIKE', '%' . $search . '%')
          ->orWhere('status', 'LIKE', '%' . $search . '%')
          ->orWhere('type', 'LIKE', '%' . $search . '%')
          ->orWhere('amount', 'LIKE', '%' . $search . '%');
        });

      }

        $notes = $notes->paginate($limit)->appends(['limit' => $limit ]);

      $this->data['search'] =$search;
      $this->data['deposit_list'] =$notes;
      $this->data['page'] = 'user.invest.DepositHistory';
      return $this->dashboard_layout();


        }

}
