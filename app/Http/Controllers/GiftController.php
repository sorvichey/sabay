<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class GiftController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Gift', 'l')){
            return view('permissions.no');
        }
        $data['gifts'] = DB::table('gifts')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(18);
        return view('gifts.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Gift', 'i')){
            return view('permissions.no');
        }
        return view('gifts.create');
    }
    // save new category
    public function save(Request $r)
    {
        if(!Right::check('Gift', 'i')){
            return view('permissions.no');
        }
        $data = array(
            'code' => $r->code,
            'top_up_number' => $r->top_up_number,
            'amount' => $r->amount,
            'type' => $r->type,
            'dateline' => $r->dateline
        );
        $sms = "The new gift has been created successfully.";
        $sms1 = "Fail to create the new gift, please check again!";
        $i = DB::table('gifts')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/gift/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/gift/create')->withInput();
        }
    }

    public function delete($id)
    {
        if(!Right::check('Gift', 'd')){
            return view('permissions.no');
        }
        DB::table('gifts')->where('id', $id)->update(['active'=>0]);
        return redirect('/admin/gift');
    }

    public function edit($id)
    {
        if(!Right::check('Gift', 'u')){
            return view('permissions.no');
        }
        $data['gift'] = DB::table('gifts')
            ->where('id', $id)
            ->first();
        return view('gifts.edit', $data);
    }
    
    public function update(Request $r)
    {
        if(!Right::check('Gift', 'u')){
            return view('permissions.no');
        }
        $data = array(
            'code' => $r->code,
            'top_up_number' => $r->top_up_number,
            'amount' => $r->amount,
            'type' => $r->type,
            'dateline' => $r->dateline
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('gifts')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/gift/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/gift/edit/'.$r->id);
        }
    }
}
