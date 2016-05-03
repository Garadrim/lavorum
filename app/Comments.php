<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Comments extends Model
	{
		// Restrict from being modified
		protected $guarded = [];

		// User who has commented
		public function author() {
			return $this->belongsTo('App\User', 'user_id');
		}
		
		// Return comments of post
		public function post() {
			return $this->belongsTo('App\Posts', 'post_id');
		}

	}

