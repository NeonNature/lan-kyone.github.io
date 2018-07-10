<?php

namespace App\Models;

use DB;

class getID
{
	static function get()
	{
		$data=[];
		$data=DB::select("SELECT userID FROM users ORDER BY userID DESC");
		return $data[0];
	}
}