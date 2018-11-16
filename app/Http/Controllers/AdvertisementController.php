<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }
    // index
    public function index()
    {
        if(!Right::check('Advertisement', 'l'))
        {
            return view('permissions.no');
        }

        $data['advertisements'] = DB::table('advertisements')
            ->join('categories', 'advertisements.category_id', 'categories.id')
            ->where('advertisements.active',1)
            ->orderBy('advertisements.id', 'desc')
            ->select('advertisements.*','categories.name as category')
            ->paginate(18);
            
        return view('advertisements.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Advertisement', 'i'))
        {
            return view('permissions.no');
        }
        return view('advertisements.create');
    }
    // save new social
    public function save(Request $r)
    {

    	$file_name = '';
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/advertisements/';
            $file->move($destinationPath, $file_name);
        }
        $data = array(
            'url' => $r->url,
            'photo' => $file_name,
            'order_number' => $r->order_number,
            'position' => $r->position,
            'category_id' => $r->category
        );
        
       
        $sms = "The new advertisement has been created successfully.";
        $sms1 = "Fail to create the new advertisement, please check again!";
        $i = DB::table('advertisements')->insertGetId($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/advertisement/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/advertisement/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Advertisement', 'd'))
        {
            return view('permissions.no');
        }

        DB::table('advertisements')->where('id', $id)->update(['active'=>0]);
        return redirect('/admin/advertisement');
    }

    public function edit($id)
    {
        if(!Right::check('Advertisement', 'u'))
        {
            return view('permissions.no');
        }
        $data['advertisement'] = DB::table('advertisements')
            ->where('id',$id)->first();
        return view('advertisements.edit', $data);
    }
    
    public function update(Request $r)
    {
    	$data = array(
            'url' => $r->url,
            'position' => $r->position,
            'order_number' => $r->order_number,
            'category_id' => $r->category
        );

        $file_name = '';
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/advertisements/';
            $file->move($destinationPath, $file_name);
            $data = array(
	            'photo' => $file_name
	        ); 
        } 
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('advertisements')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/advertisement/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/advertisement/edit/'.$r->id);
        }
    }
}
