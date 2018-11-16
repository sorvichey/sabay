<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Video', 'l'))
        {
            return view('permissions.no');
        }
        $data['query']= "";
        if(isset($_GET['q']))
        {
            $data['query'] = $_GET['q'];
            $data['videos'] = DB::table('videos')
                ->where('videos.active',1)
                ->orderBy('videos.id', 'desc')
                ->where(function($fn){
                    $fn->where('videos.title', 'like', "%{$_GET['q']}%");
                })
                ->paginate(200);
               
        }
        else{
            $data['videos'] = DB::table('videos')
                ->where('videos.active',1)
                ->orderBy('videos.id', 'desc')
                ->paginate(18);
        }
        return view('videos.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Video', 'i'))
        {
            return view('permissions.no');
        }
        return view('videos.create');
    }
    // save new social
    public function save(Request $r)
    {
        if(!Right::check('Video', 'i'))
        {
            return view('permissions.no');
        }
        $data = array(
            'url' => $r->url,
            'title' => $r->title,
            'short_description' => $r->short_description,
            'description' => $r->description
        );
        $i = DB::table('videos')->insertGetId($data);

        if($r->hasFile('image')) {
            $file = $r->file('image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'video' .$i . $ss;
            
            $destinationPath = 'uploads/videos/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $destinationPath2 = 'uploads/videos/';
            $new_img2 = Image::make($file->getRealPath())->resize(750, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img2->save($destinationPath2 . $file_name, 80);
            $new_img->save($destinationPath . $file_name, 80);
            $data['poster_image'] = $file_name;
            $i = DB::table('videos')->where('id', $i)->update($data);
        }
        if ($i) {
            $r->session()->flash("sms", "New video has been created successfully!");
            return redirect("/admin/video/create");
        } else {
            $r->session()->flash("sms1", "Fail to create new video!");
            return redirect("/admin/video/create")->withInput();
        }   
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Video', 'd'))
        {
            return view('permissions.no');
        }

        DB::table('videos')->where('id', $id)->update(['active'=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/video?page='.$page);
        }
        return redirect('/admin/video');
    }

    public function edit($id)
    {
        if(!Right::check('Video', 'u'))
        {
            return view('permissions.no');
        }
        $data['video'] = DB::table('videos')
            ->where('id',$id)->first();
        return view('videos.edit', $data);
    }
    
    public function detail($id)
    {
        if(!Right::check('Video', 'u'))
        {
            return view('permissions.no');
        }
        $data['video'] = DB::table('videos')
            ->where('id',$id)->first();
        return view('videos.detail', $data);
    }

    public function update(Request $r)
    {
        if(!Right::check('Video', 'u'))
        {
            return view('permissions.no');
        }
    	$data = array(
            'url' => $r->url,
            'title' => $r->title,
            'short_description' => $r->short_description,
            'description' => $r->description
        );
        if ($r->image) {
            $file = $r->file('image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'video' .$r->id . $ss;

            $destinationPath = 'uploads/videos/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $destinationPath2 = 'uploads/videos/';
            $new_img2 = Image::make($file->getRealPath())->resize(750, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img2->save($destinationPath2 . $file_name, 80);
            $new_img->save($destinationPath . $file_name, 80);
            $data['poster_image'] = $file_name;
            // dd($new_img2->save($destinationPath2 . $file_name, 80));
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('videos')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/video/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/video/edit/'.$r->id);
        }
    }
}
