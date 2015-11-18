<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserX extends Model {
	protected $table = 'user_xes';
	protected $fillable
		= [
			'unique_id',
			'name',
			'email',
			'pass',
		];
}
