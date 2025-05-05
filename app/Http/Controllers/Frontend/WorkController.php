<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Galary;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    //
    public function work()
    {
        $data['galary']=Galary::where('type','=','work')->first();
        $data['works'] = Work::with('service','images')->get();
        return view('frontend.work.work',$data);
    }
    public function work_detail(String $id){
        $data['galary']=Galary::where('type','=','work')->first();

        $data['work']=Work::findorfail($id);

        return view('frontend.work.work_details',$data);
    }
}
