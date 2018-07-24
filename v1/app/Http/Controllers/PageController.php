<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use Auth;
use File;
use Carbon;
use DB;
use Hash;

use App\User;
use App\Models\Schedule;

use App\Http\Requests;
use App\Http\Controllers\Controller;



class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        $input=Request::all();

        if(Auth::attempt(['phone'=>$input['phone'],'password'=>$input['password']]))
        {
            $role=Auth::user()->role;
            if($role=="Passenger")
            {
                return redirect('schedule');
            }
            else
            {
                return redirect('driverschedule');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function schedule()
    {
        $data=Schedule::postselect();
        $mode="all";
        return view('schedule',compact('data','mode'));
    }

    public function register()
    {
        return view('register');
    }

    public function registerp()
    {
        $input=Request::all();
        $phone=$input['phone'];
        DB::table('users')->insert(
        ['id' => Carbon::now()->format('mdhisu'),
        'name'=>$input['name'],
        'nrc'=>$input['nrc'],
        'university'=>$input['org'],
        'phone'=>$input['phone'],
        'password'=>Hash::make($input['pwd1']),
        'remember_token'=>$input['_token'],
        'role'=>'Passenger'
        ]);

        Auth::attempt(['phone'=>$input['phone'],'password'=>$input['pwd1']]);
        return redirect('schedule');
    }

    public function addpost()
    {
        $input=Request::all();
        Schedule::insert($input);

        return redirect('schedule');
    }

    public function search()
    {
        $input=Request::all();
        $mode="search";
        $data=Schedule::search($input['search']);

        return view('schedule',compact('data','mode'));
    } 

    public function notifications()
    {
        $uid=Auth::user()->id;
        $data=DB::table('request')->join('users','users.id','=','request.userid')->join('posts','posts.id','=','request.postid')->select('users.name','users.university','users.phone','users.rating','posts.startpoint','posts.endpoint','request.startpoint1','request.endpoint1','request.id','request.postid')->where('posts.userid',$uid)->where('request.status','Pending')->get();
        return view('noti',compact('data'));
    }

    public function confirm()
    {
        $data=Request::all();
        if($data['status']=='true')
        {
            DB::table('request')->where('id', $data['rid'])->update(['status' => 'Confirmed']);
            DB::table('posts')->where('id', $data['pid'])->update(['status' => 'Finished']);
            DB::table('users')->increment('rating',10);   
        }
        else
        {
            DB::table('request')->where('id', $data['rid'])->delete();
        }
        return redirect('notifications');
    }

    public function request()
    {
        $input=Request::all();
        DB::table('request')->insert(
        ['id' => Carbon::now()->format('mdhisu'),
        'startpoint1'=>$input['to2'],
        'endpoint1'=>$input['from2'],
        'postid'=>$input['postid'],
        'userid'=>Auth::user()->id,
        'created_at'=>Carbon::now(),
        'status'=>'Pending'
        ]);
        return redirect('schedule');
    }

    public function profile()
    {
        return view('profile');
    }

    public function driverschedule()
    {
        $data=Schedule::postselectall();
        return view('driver',compact('data'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }  
}
