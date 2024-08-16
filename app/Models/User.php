<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password','phone','username','sponsor','ParentId','position','active_status','jdate','level','tpassword','adate','PSR','TPSR','walletAddress'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'sponsor');
    } 


    public function sponsor_detail()
    {
        return $this->belongsTo('App\Models\User', 'sponsor');
    } 


    public function FundBalance()
    {
    $balance = Auth::user()->buy_fundAmt->sum('amount')-(Auth::user()->buy_packageAmt());
    return $balance;
    } 

    public function buy_fundAmt(){
        return $this->hasMany('App\Models\BuyFund','user_id','id')->where('status','Approved');
    }

    public function buy_packageAmt(){
        $amt= Investment::where('active_from',Auth::user()->username)->where('walletType',1)->sum('amount');
        return $amt;
    }

    public function pool_bonus()
    {
        return $this->hasMany('App\Models\Income','user_id','id')->where('remarks','Global Income');
    } 

    public function sponsor_bonus()
    {
        return $this->hasMany('App\Models\Income','user_id','id')->where('remarks','Matching Bonus');
    } 
        
    public function level_bonus()
    {
        return $this->hasMany('App\Models\Income','user_id','id')->where('remarks','Team Build Income');
    } 

    public function payout()
    {
       return $this->hasMany('App\Models\Payout','user_id','id');
   } 
          
    public function rank_bonus()
    {
        return $this->hasMany('App\Models\Income','user_id','id')->where('remarks','Rank Bonus');
    } 

    public function leadership_bonus()
    {
        return $this->hasMany('App\Models\Income','user_id','id')->where('remarks','Leadership Bonus');
    } 
      public function boost_bonus()
    {
        return $this->hasMany('App\Models\Income','user_id','id')->where('remarks','Global Team Boost Income');
    } 
    
    
    
    public function available_balance()
    {
    $balance = Auth::user()->users_incomes->sum('comm')- (Auth::user()->withdraw());
    return $balance;
    } 

    public function users_incomes()
    {
        return $this->hasMany('App\Models\Income','user_id','id');
    } 
    

    public function withdraw()
    {
        return  Withdraw::where('user_id',Auth::user()->id)->where('status','!=','Failed')->sum('amount');
    } 


    public function investment(){
        return $this->hasMany('App\Models\Investment','user_id','id')->where('status','Active')->where('roiCandition',0);
    }

    
}
