<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
class FrontController extends Controller
{
   
    // index
    public function index()
    {
        $data['post'] = null;
        $data['video'] = null;
        $data['videos'] = DB::table('videos')->where('active', 1)->orderBy('id', 'desc')->paginate(20);
        $data['categories'] = DB::table('categories')
            ->where('active',1)
            ->orderBy('order', 'asc ')
            ->get(); 
        $data['advertisement'] = DB::table('advertisements')
            ->where('category_id', 5)
            ->where('position','Top')
            ->where('active', 1)
            ->orderBy('order_number', 'asc')
            ->first();
        return view('fronts.index', $data);
   }
   public function post($id)
   {
        $data['video'] = null;
        
       $data['post'] = DB::table('posts')
            ->join('categories', 'posts.category_id', 'categories.id')
            ->where('posts.id', $id)
            ->select('posts.*', 'categories.name')
            ->first();
        return view('fronts.detail', $data);
       
   }

   public function gift(Request $r)
   {
        $data['post'] = null;
        $data['video'] = null;
        $data['advertisement'] = DB::table('advertisements')
            ->where('category_id', 5)
            ->where('position','Top')
            ->orderBy('order_number','asc')
            ->where('active', 1)
            ->first();
        $data['gift'] = null;
        if($r->smart !== null){
            $data['gift'] = DB::table('gifts')
                ->where('code', $r->smart)
                ->where('type', 'smart')
                ->where('active', 1)
                ->first();
            DB::table('gifts')->where('code', $r->smart)->update(['active'=>0]);
        }
        if($r->cellcard !== null){
            $data['gift'] = DB::table('gifts')
                ->where('code', $r->cellcard)
                ->where('active', 1)
                ->first();
            DB::table('gifts')->where('code', $r->cellcard)->update(['active'=>0]);
        }
        if($r->metfone !== null){
            $data['gift'] = DB::table('gifts')
                ->where('code', $r->metfone)
                ->where('active', 1)
                ->first();
            DB::table('gifts')->where('code', $r->metfone)->update(['active'=>0]);
        }


        return view('fronts.gift', $data);
   }
    // view post detail
    public function video_detail($id)
    {
        $data['post'] = null;
        $data['video'] = DB::table('videos')
             ->where('id', $id)
             ->first();
        $data['advertisement'] = DB::table('advertisements')
             ->where('category_id', 6)
             ->where('position','Top')
             ->orderBy('order_number','asc')
             ->where('active', 1)
             ->first();
        $data['advertisement_right'] = DB::table('advertisements')
             ->where('category_id', 6)
             ->where('position','Right')
             ->orderBy('order_number','asc')
             ->where('active', 1)
             ->get();
         $data['advertisement_right_bottom'] = DB::table('advertisements')
             ->where('category_id', 6)
             ->where('position','Bottom')
             ->orderBy('order_number','asc')
             ->where('active', 1)
             ->get();

         return view('fronts.video-detail', $data);
        
    }
    // view post detail
    public function detail($id)
    {
        $data['video'] = null;

        $data['post'] = DB::table('posts')
             ->where('id', $id)
             ->first();
        $data['advertisement'] = DB::table('advertisements')
             ->where('category_id', $data['post']->category_id)
             ->where('position','Top')
             ->orderBy('order_number','asc')
             ->where('active', 1)
             ->first();
        $data['advertisement_right'] = DB::table('advertisements')
             ->where('category_id', $data['post']->category_id)
             ->where('position','Right')
             ->orderBy('order_number','asc')
             ->where('active', 1)
             ->get();
         $data['advertisement_right_bottom'] = DB::table('advertisements')
             ->where('category_id', $data['post']->category_id)
             ->where('position','Bottom')
             ->orderBy('order_number','asc')
             ->where('active', 1)
             ->get();
         return view('fronts.detail', $data);
        
    }
    // view post video
    public function video()
    {   $data['post'] = null;
        $data['video'] = null;
        $data['advertisement'] = DB::table('advertisements')
            ->where('category_id', 6)
            ->orderBy('id','desc')
            ->first();
        $data['last_videos'] = DB::table('videos')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->limit(2)
            ->get();
        foreach($data['last_videos'] as $p) {
            $data['videos'] = DB::table('videos')
                ->where('active',1)
                ->orderBy('id', 'desc')
                ->where('id', '<', $p->id)
                ->paginate(10); 
        }
        $data['advertisement'] = DB::table('advertisements')
            ->where('category_id', 6)
            ->where('position','Top')
            ->orderBy('order_number','asc')
            ->where('active', 1)
            ->first();
        $data['advertisement_right'] = DB::table('advertisements')
             ->where('category_id', 6)
             ->where('position','Right')
             ->orderBy('order_number','asc')
             ->where('active', 1)
             ->get();
         $data['advertisement_right_bottom'] = DB::table('advertisements')
             ->where('category_id', 6)
             ->where('position','Bottom')
             ->orderBy('order_number','asc')
             ->where('active', 1)
             ->get();

         return view('fronts.video', $data);
        
    }
   // read post in sub category
   public function category($id)
   {
    $data['post'] = null;
        $data['video'] = null;
        $data['last_posts'] = DB::table('posts')
            ->where('category_id', $id)
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->limit(2)
            ->get();
        foreach($data['last_posts'] as $p) {
            $data['posts'] = DB::table('posts')
                ->where('category_id', $id)
                ->where('active',1)
                ->orderBy('id', 'desc')
                ->where('id', '<', $p->id)
                ->paginate(10); 
        }
        $data['category'] = DB::table('categories')
            ->where('id', $id )
            ->first(); 
        $data['advertisement'] = DB::table('advertisements')
            ->where('category_id',$id)
            ->where('position','Top')
            ->orderBy('order_number','asc')
            ->first();
        $data['advertisement_right'] = DB::table('advertisements')
            ->where('category_id', $id)
            ->where('position','Right')
            ->orderBy('order_number','asc')
            ->get();
        $data['advertisement_right_bottom'] = DB::table('advertisements')
            ->where('category_id', $id)
            ->where('position','Bottom')
            ->orderBy('order_number','asc')
            ->get();
        return view('fronts.category', $data);
   }
  
}
