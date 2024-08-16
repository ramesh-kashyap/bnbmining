<?php
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\Income;
use App\Models\Investment;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sendmail;

$downline="";

function siteName()
{
    $general = GeneralSetting::first();
    return $general->sitename;
}



function currency()
{
    $general = GeneralSetting::first();
    return $general->cur_sym;
}

function generalDetail()
{
    $general = GeneralSetting::first();
    return $general;
}

function paginationLimit()
{
    $general = GeneralSetting::first();
    return $general->PaginationLimit;
}


function sendEmail($user, $type = null, $shortCodes = [])
{

  $mail_data=array('subject'=>$type,'MailDetail'=>$shortCodes);
  \Mail::to($user)->send(new Sendmail($mail_data));  
}



//moveable
function getIpInfo()
{
    $ip = null;
    $deep_detect = TRUE;

    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }


    $xml = @simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);


    $country = @$xml->geoplugin_countryName;
    $city = @$xml->geoplugin_city;
    $area = @$xml->geoplugin_areaCode;
    $code = @$xml->geoplugin_countryCode;
    $long = @$xml->geoplugin_longitude;
    $lat = @$xml->geoplugin_latitude;

    $data['country'] = $country;
    $data['city'] = $city;
    $data['area'] = $area;
    $data['code'] = $code;
    $data['long'] = $long;
    $data['lat'] = $lat;
    $data['ip'] = request()->ip();
    $data['time'] = date('d-m-Y h:i:s A');


    return $data;
}

function osBrowser(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }
    $browser = "Unknown Browser";
    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    $data['os_platform'] = $os_platform;
    $data['browser'] = $browser;

    return $data;
}


function verificationCode($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }
    return random_int($min, $max);
}



 function add_level_income($id,$amt)
        {

          //$user_id =$this->session->userdata('user_id_session')
      $data = User::where('id',$id)->orderBy('id','desc')->first();
      
        $user_id = $data->username;
        $fullname=$data->name;
       
        $rname = $data->username;
        $user_mid = $data->id;
          
     
              $cnt = 1;

              $amount = $amt/2;
                
        
                while ($user_mid!="" && $user_mid!="1"){
  
                      $Sposnor_id = User::where('id',$user_mid)->orderBy('id','desc')->first();
                      $sponsor=$Sposnor_id->sponsor;
                      if (!empty($sponsor))
                       {
                        $Sposnor_status = User::where('id',$sponsor)->orderBy('id','desc')->first();
                        $sp_status = ($Sposnor_status)?$Sposnor_status->active_status:0;
                        $checkAmt = Investment::where('user_id',$sponsor)->where('status','Active')->orderBy('id','DESC')->limit(1)->first();
                        $lastPackage=(!empty($checkAmt))?$checkAmt->amount:0;
                      }
                      else
                      {
                        $Sposnor_status =array();
                        $sp_status="Pending";
                        $lastPackage=0;
                      }
                     
                      $pp=0;
                       if($sp_status=="Active" && $lastPackage>=$amt)
                       {  
                         if($cnt==1 )
                          {
                            $pp= ($amount/100)*50;

                          } if($cnt==2)
                          {
                            $pp= ($amount/100)*25;
                
                          } if($cnt==3)
                          {
                            $pp= ($amount/100)*50;
                
                          } 

                        }
                          
                      
                      $user_mid = @$Sposnor_status->id;

                      $spid = @$Sposnor_status->id;

                    //   echo $user_mid."<br>";
                    //   echo $spid."<br>";
                    //   echo $cnt."<br>";
                    //   echo $pp."<br>";
                    //   echo $sp_status."<br>";
                    //  die;
                      $idate = date("Y-m-d");
                
                                  
                     
                      $user_id_fk=$sponsor;
                      if($spid>0 && $cnt<=3){
                        if($pp>0){
                         
                         $data = [
                        'user_id' => $user_mid,
                        'user_id_fk' =>$Sposnor_status->username,
                        'amt' => $amt,
                        'comm' => $pp,
                        'remarks' =>'Team Build Income',
                        'level' => $cnt,
                        'rname' => $rname,
                        'fullname' => $fullname,
                        'ttime' => Date("Y-m-d"),
                        
                    ];
                     $user_data =  Income::create($data);
                   
                    
                }
               }
               
                $cnt++;
     }

     return true;
  }




 function add_level_boots($id,$amt)
        {

          //$user_id =$this->session->userdata('user_id_session')
      $data = User::where('id',$id)->orderBy('id','desc')->first();
      
        $user_id = $data->username;
        $fullname=$data->name;
       
        $rname = $data->username;
        $user_mid = $data->username;
          
     
              $cnt = 1;

              $amount = $amt;
                
        
                while ($user_mid!="" && $user_mid!="1"){
  
                      $Sposnor_id = \DB::table('club4')->where('username',$user_mid)->orderBy('id','desc')->first();
                    //   echo $user_mid."<br>";
                    
                      if ($Sposnor_id)
                       {
                             $sponsor=$Sposnor_id->ParentId;
                        $Sposnor_status = User::where('username',$sponsor)->orderBy('id','desc')->first();
                        $sp_status = ($Sposnor_status)?$Sposnor_status->active_status:0;
                        $isbost = ($Sposnor_status)?$Sposnor_status->isbost:0;
                       
                      }
                      else
                      {
                        $Sposnor_status =array();
                        $sp_status="Pending";
                        $isbost=0;
                        
                      }
                     
                      $pp=0;
                       if($sp_status=="Active" && $isbost>=1)
                       {  
                           
                         if($cnt>=1 && $cnt<=25)
                          {
                            $pp= ($amount/100)*1;

                          }  

                        }
                          
                      
                      $user_mid = @$Sposnor_status->username;

                      $spid = @$Sposnor_status->id;

                    //   echo $user_mid."<br>";
                    //   echo $spid."<br>";
                    //   echo $cnt."<br>";
                    //   echo $pp."<br>";
                    //   echo $sp_status."<br>";
                    //  die;
                      $idate = date("Y-m-d");
                
                                  
                     
                   
                      if($spid>0 && $cnt<=25){
                        if($pp>0){
                               $user_id_fk=$sponsor;
                         
                         $data = [
                        'user_id' => $spid,
                        'user_id_fk' =>$Sposnor_status->username,
                        'amt' => $amt,
                        'comm' => $pp,
                        'remarks' =>'Global Team Boost Income',
                        'level' => $cnt,
                        'rname' => $rname,
                        'fullname' => $fullname,
                        'ttime' => Date("Y-m-d"),
                        
                    ];
                     $user_data =  Income::create($data);
                   
                    
                }
               }
               
               if($cnt>25)
               {
                   break;
               }
                $cnt++;
     }

    // dd("hi");
     return true;
  }





  function add_autopool_income($id,$amt,$round)
  {

    //$user_id =$this->session->userdata('user_id_session')
$data = User::where('id',$id)->orderBy('id','desc')->first();

  $user_id = $data->username;
  $fullname=$data->name;
 
  $rname = $data->username;
  $user_mid = $data->id;
    

        $cnt = 1;

        $amount = $amt/100;
          
  
          while ($user_mid!="" && $user_mid!="1"){

                $Sposnor_id = \DB::table($round)->where('user_id',$user_mid)->first();   
                if ($Sposnor_id)
                 {
                  $sponsor=$Sposnor_id->ParentId;
                  $Sposnor_status = User::where('username',$sponsor)->orderBy('id','desc')->first();
                  $rank = ($Sposnor_status)?$Sposnor_status->rank:0;
                  $sp_status = ($Sposnor_status)?$Sposnor_status->active_status:0;
                  $Sposnor_cnt = User::where('sponsor',$sponsor)->where('active_status','Active')->count("id");
                }
                else
                {
                  $Sposnor_status =array();
                  $sp_status="Pending";
                  $rank=0;
                  $Sposnor_cnt =0;
                }
               
                $pp=0;
                if (!empty($Sposnor_status) && $sp_status=="Active")
                 {
                  if($cnt>=1 &&  $cnt<=12)
                  {
                    $pp= 1;  
                  }

                    if ($cnt==13 && $rank==1)
                    {
                      $pp= 1;  
                    }

                    if ($cnt==14 && $rank==1)
                    {
                      $pp= 1;  
                    }
                    if ($cnt==15 && $rank==2)
                    {
                      $pp= 1;  
                    }
                    if ($cnt==16 && $rank==5)
                    {
                      $pp= 1;  
                    }



                }
                     
                $user_mid = @$Sposnor_status->id;
                //echo $user_id;
               //die;
                $idate = date("Y-m-d");
                
                $spid = @$Sposnor_status->id;
                $release = 1; 
            
               
                $user_id_fk=$sponsor;
                if($spid>0 && $cnt<=16){
                  if($pp>0)
                  {
                   $data = [
                  'user_id' => $Sposnor_status->id,
                  'user_id_fk' =>$Sposnor_status->username,
                  'amt' => $amt,
                  'comm' => $pp,
                  'remarks' =>'Pool Bonus',
                  'level' => $cnt,
                  'rname' => $rname,
                  'fullname' => $fullname,
                  'ttime' => Date("Y-m-d"),
                  
              ];
               $user_data =  Income::create($data);
               $sponsorID =($Sposnor_status->sponsor_detail)?$Sposnor_status->sponsor_detail->id:0;
             
               $sponsorDetail = User::where('id',$sponsorID)->where('active_status','Active')->first();
               if ($sponsorDetail)
                {   
                  // dd($sponsorDetail);
                   $sponsor_data = [
                  'user_id' => $sponsorDetail->id,
                  'user_id_fk' =>$sponsorDetail->username,
                  'amt' => $amt,
                  'comm' => $pp/2,
                  'remarks' =>'Matching Bonus',
                  'level' => 1,
                  'rname' => $Sposnor_status->username,
                  'fullname' => $Sposnor_status->name,
                  'ttime' => Date("Y-m-d"),
                  
                  ];
                Income::create($sponsor_data);
                }
              
          }
         }
         
          $cnt++;
}

return true;
}



  function getTreeChildId($table)
  {
     $parentid = DB::table($table)->where('paid_left',0)->orWhere('paid_right',0)->orderBy('id','ASC')->limit(1)->first();
     if (!$parentid) 
     {
      $res['parentId'] =0;
      $res['position'] =1;
     }
     else
     {
      $res['parentId'] =$parentid->user_id_fk;
      if ($parentid->paid_left==0) 
      {
        $res['position'] =1;
      }
      else
      {
        $res['position'] =2;
      }
     }
     return $res;
    
  }
  


  function add_leadership_income($id,$amt)
  {

    //$user_id =$this->session->userdata('user_id_session')
$data = User::where('id',$id)->orderBy('id','desc')->first();

  $user_id = $data->username;
  $fullname=$data->name;
 
  $rname = $data->username;
  $user_mid = $data->id;
    

        $cnt = 1;

        $amount = $amt/100;
          
  
          while ($user_mid!="" && $user_mid!="1"){
                $Sposnor_id = User::where('id',$user_mid)->orderBy('id','desc')->first();
                $sponsor=$Sposnor_id->ParentId;
                if (!empty($sponsor))
                 {
                  $Sposnor_status = User::where('id',$sponsor)->orderBy('id','desc')->first();
                  $Sposnor_cnt = User::where('ParentId',$sponsor)->where('active_status','Active')->count("id");
                $sp_status=$Sposnor_status->active_status;
                }
                else
                {
                  $Sposnor_status =array();
                  $sp_status="Pending";
                  $Sposnor_cnt=0;
                }
               
                $pp=0;
                 if($sp_status=="Active")
                 {  
                   if($cnt===1 )
                    {
                      $pp= $amount*5;
          
                    } if($cnt==2)
                    {
                      $pp= $amount*2;
          
                    } if($cnt==3)
                    {
                      $pp= $amount*1;
          
                    }
                  }
                  
                    
               
                
                $user_mid = @$Sposnor_status->id;

                $spid = @$Sposnor_status->id;

              //   echo $user_mid."<br>";
              //   echo $spid."<br>";
              //   echo $cnt."<br>";
              //   echo $pp."<br>";
              //   echo $sp_status."<br>";
              //  die;
                $idate = date("Y-m-d");
          
               
              
             
               
                $user_id_fk=$sponsor;
                if($spid>0 && $cnt<=3){
                  if($pp>0){
                   
                   $data = [
                  'user_id' => $user_mid,
                  'user_id_fk' =>$Sposnor_status->username,
                  'amt' => $amt,
                  'comm' => $pp,
                  'remarks' =>'Leadership Bonus',
                  'level' => $cnt,
                  'rname' => $rname,
                  'fullname' => $fullname,
                  'ttime' => Date("Y-m-d"),
                  
              ];
               $user_data =  Income::create($data);
             
              
          }
         }
         
          $cnt++;
}

return true;
}



function add_direct_income($id,$amt)
{

  //$user_id =$this->session->userdata('user_id_session')
$data = User::where('id',$id)->orderBy('id','desc')->first();

$user_id = $data->username;
$fullname=$data->name;

$rname = $data->username;
$user_mid = $data->id;
  

      $cnt = 1;

        $amount = $amt/100;

              $Sposnor_id = User::where('id',$user_mid)->orderBy('id','desc')->first();
              $sponsor=$Sposnor_id->sponsor;
              if (!empty($sponsor))
               {
                $Sposnor_status = User::where('id',$sponsor)->orderBy('id','desc')->first();
              $sp_status=$Sposnor_status->active_status;
              $Sposnor_cnt = User::where('sponsor',$sponsor)->where('active_status','Active')->count("id");
              }
              else
              {
                $Sposnor_status =array();
                $sp_status="Pending";
                $Sposnor_cnt =0;
              }
             $percent = 10;
              if($Sposnor_cnt>=4)
              {
                $percent = 20; 
              }
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
            //   if ($percent<50) 
            //   {      
            //     $checkExist=User::where('id',$whogetBonusid)->first();
            //     if ($checkExist) 
            //     {
            //       $spPercent= 50-$percent;
            //       $sp_pp = $amount*$spPercent;
            //       $checksp=User::where('sponsor',$checkExist->id)->where('active_status','Active')->count();
            //       if ($checksp>=10) 
            //       {
            //         $data = [
            //           'user_id' => $checkExist->id,
            //           'user_id_fk' =>$checkExist->username,
            //           'amt' => $amt,
            //           'comm' => $sp_pp,
            //           'remarks' => 'Gap Margin Bonus',
            //           'level' => $cnt,
            //           'rname' => $rname,
            //           'fullname' => $fullname,
            //           'ttime' => Date("Y-m-d"),
                      
            //       ];
            //       $user_data =  Income::create($data);

            //       }
            //     }

            //   }
                     
             if($sp_status=="Active")
               {  
            
                $pp = $amount*$percent;
              
              
              }else
              {
                $pp=0;
              }               
             
              
              $user_mid = @$Sposnor_status->id;
              //echo $user_id;
             //die;
              $idate = date("Y-m-d");
        
             
              $spid = @$Sposnor_status->id;
           
             
              $user_id_fk=$sponsor;
              //print_r($user_id_fk);die;
             // echo $cnt." ".$spid." ".$pp."<br>";
              if($spid>0 && $pp>0){               
                 $data = [
                'user_id' => $user_mid,
                'user_id_fk' =>$Sposnor_status->username,
                'amt' => $amt,
                'comm' => $pp,
                'remarks' => 'Sponsor Bonus',
                'level' => $cnt,
                'rname' => $rname,
                'fullname' => $fullname,
                'ttime' => Date("Y-m-d"),
                
            ];
            $user_data =  Income::Create($data);
           
      
       }


return true;
}





?>
