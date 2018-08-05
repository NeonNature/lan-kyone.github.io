<?php

namespace App\Models;

use DB;

class TopicCategory
{
	static function select()
	{
		$result=DB::table('topiccategory')->get();
		return $result;
	}
}