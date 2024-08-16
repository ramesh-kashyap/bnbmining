<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reentry;
use Illuminate\Support\Facades\DB;
use Auth;
use Log;
use Redirect;
use Hash;
use Validator;

class Team extends Controller
{
    public function index(Request $request)
    {
      $user=Auth::user();
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = User::where('sponsor',$user->id)->orderBy('id', 'DESC');
       if($search <> null && $request->reset!="Reset"){
        $notes = $notes->where(function($q) use($search){
          $q->Where('name', 'LIKE', '%' . $search . '%')
          ->orWhere('username', 'LIKE', '%' . $search . '%')
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

    $this->data['direct_team'] =$notes;
    $this->data['search'] =$search;
    $this->data['page'] = 'user.team.direct-team';
    return $this->dashboard_layout();

    }

    public function LevelTeam(Request $request)
    {
      $user=Auth::user();
      // print_r($user->username);die();
      $ids=$this->my_level_team_count($user->id);


      // print_r($ids);die;
        $limit = $request->limit ? $request->limit : paginationLimit();
            $status = $request->status ? $request->status : null;
            $search = $request->search ? $request->search : null;
            // $notes = User::where('sponsor',$user->username);
          $notes = User::where(function($query) use($ids)
{
  if(!empty($ids)){
    foreach ($ids as $key => $value) {
    //   $f = explode(",", $value);
    //   print_r($f)."<br>";
      $query->orWhere('id', $value);
    }
  }else{$query->where('id',null);}
})->orderBy('id', 'DESC');
       if($search <> null && $request->reset!="Reset"){
        $notes = $notes->where(function($q) use($search){
          $q->orWhere('name', 'LIKE', '%' . $search . '%')
          ->orWhere('username', 'LIKE', '%' . $search . '%')
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

        $this->data['direct_team'] =$notes;
        $this->data['search'] =$search;
        $this->data['page'] = 'user.team.level-team';
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


}
