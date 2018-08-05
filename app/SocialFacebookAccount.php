<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class SocialFacebookAccount extends Model
{
	use Authenticatable;
    protected $fillable = ['user_id', 'provider_id', 'provider'];

  	public function user()
  	{
      	return $this->belongsTo(User::class);
  	}
}
