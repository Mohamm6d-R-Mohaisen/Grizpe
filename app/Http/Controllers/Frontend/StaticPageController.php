<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Add;
use App\Models\Galary;
use App\Models\Plane;
use App\Models\Question;
use App\Models\Review;
use App\Models\Service;
use App\Models\Slider;
use App\Models\StaticPage;

class StaticPageController extends Controller
{
    public function show($slug)
    {
        $page = StaticPage::where('slug', $slug)->firstOrFail();
        return view('frontend.static_pages.show', compact('page'));
    }
    public function about(){
        $data['galary_main']=Galary::where('type','=','about')->where('sub_type','=','main')->first();
        $data['galary_footer']=Galary::where('type','=','about')->where('sub_type','=','footer')->first();
        $data['galary_aside']=Galary::where('type','=','about')->where('sub_type','=','aside')->first();


        $data['slider_about']=Slider::withTranslation()
            ->whereHas('translations', function ($query) {
                $query->where('type', 'about');
            })
            ->first();
        $data['galarys_about'] = Galary::where('type', 'about')
            ->where('sub_type', 'slider')->limit(2)
            ->get();
        $data['team']=Add::all();
        $data['revies']=Review::all();
        $data['questions']=Question::where('type','=','about')->get();
        return view('frontend.static_pages.about',$data);
    }
    public function contact(){
        $data['services']=Service::all();
        return view('frontend.static_pages.contact',$data);
    }
    public function faq()
    {
        $data['galary_main']=Galary::where('type','=','fag')->where('sub_type','=','main')->first();
        $data['galary_footer']=Galary::where('type','=','fag')->where('sub_type','=','footer')->first();
        $data['faqs']=Question::where('type','=','faq')->get();
        return view('frontend.static_pages.fag',$data);

    }
    public function pricing(){
        $data['galary_main']=Galary::where('type','=','pricing')->where('sub_type','=','main')->first();
        $data['galary_footer']=Galary::where('type','=','pricing')->where('sub_type','=','footer')->first();
        $data['plans']=Plane::with('features')->get();
      return view('frontend.static_pages.pricing',$data);
    }
}
