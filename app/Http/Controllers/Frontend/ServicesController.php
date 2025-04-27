<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Galary;
use App\Models\Plane;
use App\Models\Question;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //
    public function services(){
        $data['galary_main']=Galary::where('type','=','service')->where('sub_type','=','main')->first();
        $data['galary_footer']=Galary::where('type','=','service')->where('sub_type','=','footer')->first();
        $data['plans']=Plane::with('features')->get();
        $data['services']=Service::all();
return view('frontend.service.service',$data);
    }
    public function services_detail(String $id){
        $data['galary_main']=Galary::where('type','=','service')->where('sub_type','=','main')->first();
        $data['galary_slider']=Galary::where('type','=','service')->where('sub_type','=','slider')->limit(2)->get();

        $data['galary_footer']=Galary::where('type','=','service')->where('sub_type','=','footer')->first();
        $data['service']=Service::findorfail($id);
        $data['questions']=Question::where('type','=','service')->get();

        $data['services']=Service::where('id','!=',$id)->get();
        return view('frontend.service.service_detail',$data);
    }
}
