<?php

namespace App\Models;

use DB;
use Auth;
use Storage;
use Carbon;

class Post
{
	static function insert($data,$name)
	{
		$result=DB::table('posts')->insert(['id'=>$data['id'],'Title'=>$data['title'],'Description'=>$data['content'],'TopicCategory'=>$data['category'],'StudentID'=>Auth::user()->id,'ImgLink'=>$name[0],'VideoLink'=>$name[1]]);
		return $result;
	}
	static function categoryselect($id)
	{
		$result=DB::table('posts')->join('users','users.id','=','posts.StudentID')->join('topiccategory','posts.TopicCategory','=','topiccategory.id')->select('posts.id','posts.Title','posts.Description','posts.StudentID','users.userName','topiccategory.TopicType')->where('TopicCategory',$id)->get();
		return $result;
	}
	static function postselect($id)
	{
		$result=DB::table('posts')->join('users','users.id','=','posts.StudentID')->join('topiccategory','posts.TopicCategory','=','topiccategory.id')->select('posts.id','posts.Title','posts.Description','posts.StudentID','users.userName','posts.ImgLink')->where('posts.id',$id)->get();
		return $result;
	}
	static function search($data)
	{
		$searchresult=DB::table('posts')->join('users','users.id','=','posts.StudentID')->join('topiccategory','posts.TopicCategory','=','topiccategory.id')->select('posts.id','posts.Title','posts.Description','posts.StudentID','users.userName','topiccategory.TopicType')->where('posts.Title','like','%'.$data.'%')->orwhere('posts.Description','like','%'.$data.'%')->get();
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