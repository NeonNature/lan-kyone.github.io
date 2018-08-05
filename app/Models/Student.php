<?php

namespace App\Models;

use DB;

class Student
{
	static function insert($input)
	{
		$data=array($input['id'],$input['university'],
					$input['major'],$input['address']);

		$result=DB::insert("INSERT INTO student (id,University,Major,Address)
							VALUES (?,?,?,?)",$data);

		return $result;
	}
	static function select($input)
	{
		$result=DB::table('student')->where('id',$input)->first();
		return $result;
	}
}
