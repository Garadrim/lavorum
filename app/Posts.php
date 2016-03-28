<?php

	namespace App;
	
	use Illuminate\Database\Eloquent\Model;

	class Posts extends Model
	{
		// Restrict from being modified
		protected $guarded = [];
		
		// Return all comments on post
		public function comments() {
			return $this->hasMany('App\Comments', 'post_id')->orderBy('created_at', 'desc');
		}

		// Return user who is author of post
		public function author() {
			return $this->belongsTo('App\User', 'user_id');
		}
	}

