<?php

namespace App\Models;

use DB;
use Hash;


class Users
{
	static function sinsert($input)
	{
		$data=array($input['id'],$input['studentname'],$input['semail'],
					Hash::make($input['spwd1']),$input['_token'],$input['phone']);

		$result=DB::insert("INSERT INTO users (id,userName,email,password,remember_token,phone)
							VALUES (?,?,?,?,?,?)",$data);

		return $result;
	}
	static function select($input)
	{
		$result=DB::table('users')->where('id',$input)->first();
		return $result;
	}
}