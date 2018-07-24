<?php

namespace App\Models;

use DB;
use Auth;
use Storage;
use Carbon;

class Schedule
{
	static function insert($data)
	{
		$result=DB::table('posts')->insert(['id'=>Carbon::now()->format('mdhisu'),'note'=>$data['note'],'startpoint'=>$data['to'],'endpoint'=>$data['from'],'expected'=>$data['efee'],'pay'=>$data['pfee'],'time'=>$data['time'],'userid'=>Auth::user()->id,'status'=>'Waiting']);
		return $result;
	}

	static function postselect()
	{
		$result=DB::table('posts')->join('users','users.id','=','posts.userid')->select('posts.id','posts.note','posts.startpoint','posts.endpoint','posts.expected','posts.pay','posts.time','users.phone')->where('posts.status','Waiting')->whereNotIn('posts.userid',[Auth::user()->id])->orderby('posts.id','desc')->get();
		return $result;
	}
	static function postselectall()
	{
		$result=DB::table('posts')->join('users','users.id','=','posts.userid')->select('posts.id','posts.note','posts.startpoint','posts.endpoint','posts.expected','posts.pay','posts.time','users.phone','posts.status')->orderby('posts.id','desc')->get();
		return $result;
	}
	static function search($data)
	{
		$searchresult=DB::table('posts')->join('users','users.id','=','posts.userid')->select('posts.id','posts.note','posts.startpoint','posts.endpoint','posts.expected','posts.pay','posts.time','users.name','users.phone')->where('posts.endpoint','like','%'.$data.'%')->orwhere('posts.startpoint','like','%'.$data.'%')->get();
		return $searchresult;
	}
	static function createcomment($pid,$data)
	{
		$result=DB::table('comments')->insert(['id'=>Carbon::now()->format('hdisu'),'description'=>$data['comment'],'userid'=>Auth::user()->id,'postid'=>$pid]);
		return $result;
	}
	static function commentselect($id)
	{
		$result=DB::table('comments')->join('users','users.id','=','comments.userid')->select('comments.description','comments.created_at','users.userName')->where('comments.postid',$id)->get();
		return $result;
	}

}