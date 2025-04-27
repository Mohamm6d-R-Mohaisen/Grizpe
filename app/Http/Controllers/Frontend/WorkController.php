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
        $data['galary_main']=Galary::where('type','=','work')->where('sub_type','=','main')->first();
        $data['galary_footer']=Galary::where('type','=','work')->where('sub_type','=','footer')->first();
        $data['works'] = Work::with('service')->get();
        return view('frontend.work.work',$data);
    }
    public function work_detail(String $id){
        $data['galary_main']=Galary::where('type','=','work')->where('sub_type','=','main')->first();
        $data['galary_footer']=Galary::where('type','=','work')->where('sub_type','=','footer')->first();
        $data['galary_slider']=Galary::where('type','=','work')->where('sub_type','=','slider')->limit(2)->get();

        $data['work']=Work::findorfail($id);

        return view('frontend.work.work_details',$data);
    }
}
