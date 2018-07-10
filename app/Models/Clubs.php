<?php

namespace App\Models;

use DB;

class Clubs
{
	static function insert($input)
	{
		$data=array($input['cuniversity'],
					$input['nom'],$input['desc']);

		$result=DB::insert("INSERT INTO club (University,NoofMember,Description)
							VALUES (?,?,?)",$data);

		return $result;
	}
}
