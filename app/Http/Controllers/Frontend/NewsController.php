<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bloge;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Galary;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function news(){
        $data['galary_main']=Galary::where('type','=','blog')->where('sub_type','=','main')->first();
        $data['galary_footer']=Galary::where('type','=','blog')->where('sub_type','=','footer')->first();
        $data['blogs']=Bloge::with('category')->get();
        $data['related']=Bloge::latest()
        ->limit(3)
        ->get();
        return view('frontend.news.new',$data);
    }

    public function news_detail(String $id){
        $data['galary_main']=Galary::where('type','=','blog')->where('sub_type','=','main')->first();
        $data['galary_footer']=Galary::where('type','=','blog')->where('sub_type','=','footer')->first();
        $data['galary_slider']=Galary::where('type','=','blog')->where('sub_type','=','slider')->limit(2)->get();
        $data['related']=Bloge::latest()
            ->limit(3)
            ->get();
//        $data['categories'] = Category::whereNotIn('id', function ($query) {
//            $query->select('category_id')->from('bloges');
//        })->get();
        $data['blog']=Bloge::with(['category'])->findOrFail($id);
        $data['categories'] = Category::where('id','!=',$data['blog']->category_id)->get();

        $data['comments']=Comment::where('blog_id','=',$id)->get();
        return view('frontend.news.news_details',$data);

    }
    public function store(Request $request)
    {
        $comment=Comment::class;
        $comment->create($request->all());

    }
}
