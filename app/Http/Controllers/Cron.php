<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\Income;
use App\Models\User;
use Carbon\Carbon;
class Cron extends Controller
{


public function generate_roi($amt)
{  
    
date_default_timezone_set("Asia/Kolkata"); 
$allResult=\DB::table('club'.$amt)->where('status','Active')->get();
$todays=Date("Y-m-d");

if ($allResult) 
{
 foreach ($allResult as $key => $value) 
 {
  
  $singleLegId=$value->id;
  $userID=$value->user_id;
   $userName = $value->username;
 
  $userDetails=User::where('id',$userID)->where('active_status','Active')->first();
  $userDirect=User::where('sponsor',$userID)->where('package','>=',$amt)->where('active_status','Active')->count();
  $invest_check=Investment::where('user_id',$userID)->where('status','!=','Decline')->orderBy('id','desc')->limit(1)->first();
  $last_package=($invest_check)?$invest_check->amount:0;
  $today=date("Y-m-d");
  $plan = \DB::table('plan')->where('package',$amt)->first();

  if ($userDetails && $userDirect>=1 && !empty($plan)) 
  {
    // dd($userDetails->firstDirectActivation);
    $mylvlteam= \DB::table('club'.$amt)->where('id','>',$singleLegId)->where('created_at','>=',$userDetails->firstDirectActivation)->count();

    if ($mylvlteam>=25) 
    {
      $check_level20=Income::where('user_id',$userID)->where('remarks','Global Income')->where('amt',$amt)->where('level',1)->count("id");

      if ($check_level20<20 && !empty($userDetails->firstDirectActivation)) {
        $data['remarks'] = 'Global Income';
        $data['comm'] =$plan->level1;
        $data['amt'] =$amt;
        $data['level'] =1;
        $data['ttime'] = date("Y-m-d");
        $data['user_id_fk'] = $userDetails->username;
        $data['user_id']=$userDetails->id;
      $income = Income::firstOrCreate(['remarks' => 'Global Income','ttime'=>date("Y-m-d"),'user_id'=>$userID,'amt'=>$amt,'level'=>1],$data);
      }
    }

    $mylvlteam= \DB::table('club'.$amt)->where('id' , '>' , $singleLegId)->where('created_at','>',($userDetails->thirdDirectActivation)?$userDetails->thirdDirectActivation:0)->count();

    if ($mylvlteam>=75 && !empty($userDetails->thirdDirectActivation)) 
    {
      $check_level50=Income::where('user_id',$userID)->where('remarks','Global Income')->where('level',2)->where('amt',$amt)->count("id");

      if ($check_level50<20 && $check_level20>=20 && $userDirect>=3) {
        $data['remarks'] = 'Global Income';
        $data['comm'] =$plan->level2;
        $data['amt'] =$amt;
        $data['level'] =2;
        $data['ttime'] = date("Y-m-d");
        $data['user_id_fk'] = $userDetails->username;
        $data['user_id']=$userDetails->id;
      $income = Income::firstOrCreate(['remarks' => 'Global Income','ttime'=>date("Y-m-d"),'user_id'=>$userID,'amt'=>$amt,'level'=>2],$data);
      }
    }

    $mylvlteam= \DB::table('club'.$amt)->where('id','>',$singleLegId)->where('created_at','>=',($userDetails->sixDirectActivation)?$userDetails->sixDirectActivation:0)->count();

    if ($mylvlteam>=225 && !empty($userDetails->sixDirectActivation)) 
    {
      $check_level150=Income::where('user_id',$userID)->where('remarks','Global Income')->where('level',3)->where('amt',$amt)->count("id");

      if ($check_level150<20 && $check_level50>=20 && $userDirect>=6 && $last_package>=$plan->require_package) {
        $data['remarks'] = 'Global Income';
        $data['comm'] =$plan->level3;
        $data['amt'] =$amt;
        $data['level'] =3;
        $data['ttime'] = date("Y-m-d");
        $data['user_id_fk'] = $userDetails->username;
        $data['user_id']=$userDetails->id;
      $income = Income::firstOrCreate(['remarks' => 'Global Income','ttime'=>date("Y-m-d"),'user_id'=>$userID,'amt'=>$amt,'level'=>3],$data);
      }
    }


  }


 }
} 


}





public function reward_bonus()
    {  

    $allResult=Income::where('remarks','Global Team Boost Income')->get();
        
     if ($allResult) 
    {
     foreach ($allResult as $key => $value) 
     {
      
       $userID=$value->id;
       $userName = $value->user_id_fk;
      $invest_check=User::where('username',$userName)->first();
      if($invest_check)
      {
      Income::where('user_id_fk',$userName)->update(['user_id'=>$invest_check->id]);    
      }
     
      
     
     
     }
     
    }
     

    
    }







}
