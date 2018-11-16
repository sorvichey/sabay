<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Post', 'l'))
        {
            return view('permissions.no');
        }
        $data['query']= "";
        if(isset($_GET['q']))
        {
            $data['query'] = $_GET['q'];
            $data['posts'] = DB::table('posts')
                ->join('categories', 'posts.category_id', 'categories.id')
                ->where('posts.active', 1)
                ->orderBy('posts.id', 'desc')
                ->where(function($fn){
                    $fn->where('posts.title', 'like', "%{$_GET['q']}%");
                })
                ->paginate(200);
        }
        else{
            $data['posts'] = DB::table('posts')
                ->join('categories', 'posts.category_id', 'categories.id')
                ->where('posts.active', 1)
                ->orderBy('posts.id', 'desc')
                ->select('posts.*', 'categories.name')
                ->paginate(18);
        }
        
        return view('posts.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Post', 'i'))
        {
            return view('permissions.no');
        }
        $data['categories'] = DB::table('categories')
            ->where('id', '!=', 5)
            ->where('id', '!=', 6)
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('posts.create' , $data);
    }
    // save new page
    public function save(Request $r)
    {
        if(!Right::check('Post', 'i'))
        {
            return view('permissions.no');
        }
        $data = array(
            'title' => $r->title,
            'short_description' => $r->short_description,
            'description' => $r->description,
            'category_id' => $r->category
        );
        $i = DB::table('posts')->insertGetId($data);
        if($i)
        {
            if($r->feature_image) {

                $file = $r->file('feature_image');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = 'post' .$i . $ss;
                
                $destinationPath = 'uploads/posts/small/';
                $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                    $con->aspectRatio();
                });
                $destinationPath2 = 'uploads/posts/';
                $new_img2 = Image::make($file->getRealPath())->resize(750, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img2->save($destinationPath2 . $file_name, 80);
                $new_img->save($destinationPath . $file_name, 80);
                
                DB::table('posts')->where('id', $i)->update(['featured_image'=>$file_name]);
            }
            $r->session()->flash('sms', 'New post has been created successfully!');
            return redirect('/admin/post/create');
        }
        else{
            $r->session()->flash('sms1', 'Fail to create new post. Please check your input again!');
            return redirect('/admin/post/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Post', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('posts')->where('id', $id)->update(['active'=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/post?page='.$page);
        }
        return redirect('/admin/post');
    }

    public function edit($id)
    {
        if(!Right::check('Post', 'u'))
        {
            return view('permissions.no');
        }
        $data['post'] = DB::table('posts')
            ->where('id',$id)->first();
        $data['categories'] = DB::table('categories')
            ->where('id', '!=', 5)
            ->where('id', '!=', 6)
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('posts.edit', $data);
    }

    public function update(Request $r)
    {
        if(!Right::check('Post', 'u'))
        {
            return view('permissions.no');
        }
        $data = array(
            'title' => $r->title,
            'short_description' => $r->short_description,
            'description' => $r->description,
            'category_id' => $r->category
        );
        if($r->feature_image) {
           
            $file = $r->file('feature_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'post' .$r->id . $ss;
            $destinationPath = 'uploads/posts/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $destinationPath2 = 'uploads/posts/';
            $new_img2 = Image::make($file->getRealPath())->resize(750, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img2->save($destinationPath2 . $file_name, 80);
            $new_img->save($destinationPath . $file_name, 80);
  
            $data['featured_image'] =  $file_name;
        }
        $i = DB::table('posts')->where('id', $r->id)->update($data);
        if ($i)
        {
            $sms = "All changes have been saved successfully.";
            $r->session()->flash('sms', $sms);
            return redirect('/admin/post/edit/'.$r->id);
        }
        else
        {   
            $sms1 = "Fail to to save changes, please check again!";
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/post/edit/'.$r->id);
        }
    }
    // view detail
    public function view($id) 
    {
        if(!Right::check('Post', 'l'))
        {
            return view('permissions.no');
        }
        $data['post'] = DB::table('posts')
            ->where('id',$id)->first();
        return view('posts.detail', $data);
    }
}

