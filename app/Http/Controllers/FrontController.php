<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function index()
    {
        return view('main.home');
    }


    public function Statistics()
    {
        return view('main.about');
    }

    public function Bounty()
    {
        return view('main.home2');
    }
    public function faq()
    {
        return view('main.faq');
    }
    public function rule()
    {
        return view('main.rule');
    }


    public function contact()
    {
        return view('main.contact');
    }
    
    

    public function getFlagwithcountry(Request $request)
    {
     
        $country =\DB::table('country')->where('name',$request->country)->first();
        if (!$country) {
            return false;
            # code...
        }
        else{
            echo json_encode($country);
        }
    }


}
