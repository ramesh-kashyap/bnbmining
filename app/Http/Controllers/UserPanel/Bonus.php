<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Income;
use App\Models\Reward;
use App\Models\Boost_direct;
use Illuminate\Support\Facades\DB;
use Auth;
use Log;
use Redirect;
use Hash;
use Validator;

class Bonus extends Controller
{
    public function index(Request $request)
    {
       $user=Auth::user();

          $limit = $request->limit ? $request->limit : paginationLimit();
            $status = $request->status ? $request->status : null;
            $search = $request->search ? $request->search : null;
            $notes = Income::where('user_id',$user->id)->where('remarks','Global Income')->orderBy('id', 'DESC');
           if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('rname', 'LIKE', '%' . $search . '%')
              ->orWhere('ttime', 'LIKE', '%' . $search . '%')
              ->orWhere('level', 'LIKE', '%' . $search . '%')
              ->orWhere('amt', 'LIKE', '%' . $search . '%')
              ->orWhere('comm', 'LIKE', '%' . $search . '%');
            });

      }
            $notes = $notes->paginate($limit)
                ->appends([
                    'limit' => $limit
                ]);
        $this->data['level_income'] =$notes;
        $this->data['search'] =$search;
        $this->data['page'] = 'user.bonus.level-income';
        return $this->dashboard_layout();


    }
 public function globalBoots(Request $request)
    {
       $user=Auth::user();

          $limit = $request->limit ? $request->limit : paginationLimit();
            $status = $request->status ? $request->status : null;
            $search = $request->search ? $request->search : null;
            $notes = Income::where('user_id',$user->id)->where('remarks','Global Team Boost Income')->orderBy('id', 'DESC');
           if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('rname', 'LIKE', '%' . $search . '%')
              ->orWhere('ttime', 'LIKE', '%' . $search . '%')
              ->orWhere('level', 'LIKE', '%' . $search . '%')
              ->orWhere('amt', 'LIKE', '%' . $search . '%')
              ->orWhere('comm', 'LIKE', '%' . $search . '%');
            });

      }
            $notes = $notes->paginate($limit)
                ->appends([
                    'limit' => $limit
                ]);
        $this->data['level_income'] =$notes;
        $this->data['search'] =$search;
        $this->data['page'] = 'user.bonus.globalBoots';
        return $this->dashboard_layout();


    }

    public function direct_income(Request $request)
    {
       $user=Auth::user();

          $limit = $request->limit ? $request->limit : paginationLimit();
            $status = $request->status ? $request->status : null;
            $search = $request->search ? $request->search : null;
            $notes = Income::where('user_id',$user->id)->where('remarks','Team Build Income')->orwhere('remarks','Pool Bonus')->orwhere('remarks','Global Income')->orderBy('id', 'DESC');
           if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('rname', 'LIKE', '%' . $search . '%')
              ->orWhere('ttime', 'LIKE', '%' . $search . '%')
              ->orWhere('level', 'LIKE', '%' . $search . '%')
              ->orWhere('amt', 'LIKE', '%' . $search . '%')
              ->orWhere('comm', 'LIKE', '%' . $search . '%');
            });

      }
            $notes = $notes->paginate($limit)
                ->appends([
                    'limit' => $limit
                ]);
        $this->data['level_income'] =$notes;
        $this->data['search'] =$search;
        $this->data['page'] = 'user.bonus.direct-income';
        return $this->dashboard_layout();


    }


    public function cashback_bonus(Request $request)
    {
       $user=Auth::user();

          $limit = $request->limit ? $request->limit : paginationLimit();
            $status = $request->status ? $request->status : null;
            $search = $request->search ? $request->search : null;
            $notes = Income::where('user_id',$user->id)->where('remarks','Rank Bonus')->orderBy('id', 'DESC');
           if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('rname', 'LIKE', '%' . $search . '%')
              ->orWhere('ttime', 'LIKE', '%' . $search . '%')
              ->orWhere('level', 'LIKE', '%' . $search . '%')
              ->orWhere('amt', 'LIKE', '%' . $search . '%')
              ->orWhere('comm', 'LIKE', '%' . $search . '%');
            });

      }
            $notes = $notes->paginate($limit)
                ->appends([
                    'limit' => $limit
                ]);
        $this->data['level_income'] =$notes;
        $this->data['search'] =$search;
        $this->data['page'] = 'user.bonus.cashback-bonus';
        return $this->dashboard_layout();


    }

    public function reward_income(Request $request)
    {
    $user=Auth::user();

    $this->data['first_lvl'] = Reward::where('user_id',$user->id)->where('level',1)->count('id');
    $this->data['second_lvl'] = Reward::where('user_id',$user->id)->where('level',2)->count('id');
    $this->data['third_lvl'] = Reward::where('user_id',$user->id)->where('level',3)->count('id');
    $this->data['four_lvl'] = Reward::where('user_id',$user->id)->where('level',4)->count('id');
    $this->data['five_lvl'] = Reward::where('user_id',$user->id)->where('level',5)->count('id');
    $this->data['six_lvl'] = Reward::where('user_id',$user->id)->where('level',6)->count('id');
    $this->data['seven_lvl'] = Reward::where('user_id',$user->id)->where('level',7)->count('id');
    $this->data['eight_lvl'] = Reward::where('user_id',$user->id)->where('level',8)->count('id');
    $this->data['nine_lvl'] = Reward::where('user_id',$user->id)->where('level',9)->count('id');
    $this->data['ten_lvl'] = Reward::where('user_id',$user->id)->where('level',10)->count('id');
    $this->data['eleven_lvl'] = Reward::where('user_id',$user->id)->where('level',11)->count('id');
    $this->data['page'] = 'user.bonus.reward-bonus';
    return $this->dashboard_layout();

    }

 

    public function roi_income(Request $request)
    {
           $user=Auth::user();


          $limit = $request->limit ? $request->limit :  paginationLimit();
            $status = $request->status ? $request->status : null;
            $search = $request->search ? $request->search : null;
            $notes = Income::where('user_id',$user->id)->where('remarks','Pool Bonus')->orderBy('id', 'DESC');

           if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('ttime', 'LIKE', '%' . $search . '%')
              ->orWhere('amt', 'LIKE', '%' . $search . '%')
              ->orWhere('rname', 'LIKE', '%' . $search . '%')
              ->orWhere('comm', 'LIKE', '%' . $search . '%');
            });

      }

            $notes = $notes->paginate($limit)
                ->appends([
                    'limit' => $limit
                ]);

    $this->data['level_income'] =$notes;
    $this->data['search'] =$search;
    $this->data['page'] = 'user.bonus.roi-bonus';
    return $this->dashboard_layout();

    }


}
