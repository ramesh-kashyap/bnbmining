<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Investment;
use App\Models\Withdraw;
use App\Models\Income;
use Carbon\Carbon;
use Helper;


class Dashboard extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $user=Auth::user();

    //   add_level_boots($user->id,5);
    //   $mywithdrawal = Withdraw::where('user_id',$user->id)->where('status','Approved')->pluck("txn_id");
    //   $totalwithdrwal=\DB::table('withdrawals')->where('Address',$user->walletAddress)->whereNotIn('WithdrawalID',$mywithdrawal)->sum('Amount');
    //   $totalincomes= Auth::user()->users_incomes->sum('comm');
    //   $maxWithdrawal=$totalwithdrwal+Auth::user()->withdraw();
    //   echo 'balance'.$totalincomes-$maxWithdrawal;    
          
    
      $user_direct=User::where('sponsor',$user->id)->where('active_status','Active')->count();
      $personal_deposit=Investment::where('user_id',$user->id)->where('status','Active')->sum('amount');

      $tolteam=$this->my_level_team_count($user->id);
      if(!empty($tolteam))
      {
         $total_team_active = User::select('id')->whereIn('id',$tolteam)->where('active_status','Active')->get()->toArray();  
         $total_ids=array_column($total_team_active,'id');
         
        $teamBusiness= Investment::whereIn('user_id',$total_ids)->where('status','Active')->sum('amount');
         
      }
      else
      {
       $teamBusiness=0;   
      }


       $this->data['team_business'] =$teamBusiness;
      $totalBusiness=$this->my_direct_business_count($user->id);
   //   print_r($tolteam);die;
    //   $total_team=(!empty($tolteam)?count($tolteam):0);
       $total_team=User::whereIn('id',(!empty($tolteam)?$tolteam:array()))->where('active_status','Active')->count();
      $deposit_report = Investment::where('user_id',$user->id)->orderBy('id','desc')->get();
      $weekly_profit = Income::where('user_id',$user->id)
      ->whereBetween('ttime', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('comm');

        $transaction_data = Income::where('user_id',$user->id)->orderBy('id', 'desc')->take(10)->get();
        $clubA = \DB::table('club4')->count();
        $this->data['weekly_profit'] =$weekly_profit;
        $this->data['clubA'] =$clubA;
        $this->data['transaction_data'] =$transaction_data;
        $this->data['deposit_report'] =$deposit_report;
        $this->data['user_direct'] =$user_direct;
        $this->data['personal_deposit'] =$personal_deposit;
      $this->data['total_team'] =$total_team;

      $this->data['directBusiness'] =$totalBusiness;


      $this->data['page'] = 'user.dashboard';
      return $this->dashboard_layout();


    }



    public function my_level_team_count($userid,$level=10){
        $arrin=array($userid);
        $ret=array();

        $i=1;
        while(!empty($arrin)){
            $alldown=User::select('id')->whereIn('sponsor',$arrin)->get()->toArray();
            if(!empty($alldown)){
                $arrin = array_column($alldown,'id');
                $ret[$i]=$arrin;
                $i++;

            }else{
                $arrin = array();
            }
        }

        $final = array();
        if(!empty($ret)){
            array_walk_recursive($ret, function($item, $key) use (&$final){
                $final[] = $item;
            });
        }


        return $final;

    }

    public function my_direct_business_count($userid){

        $totalBusiness=0;
        $alldown=User::select('id')->where('sponsor',$userid)->get()->toArray();
        if(!empty($alldown)){
            $arrin = array_column($alldown,'id');

         $totalBusiness=Investment::whereIn('user_id',$arrin)->where('status','Active')->sum("amount");
        }
    return $totalBusiness;

    }


}
