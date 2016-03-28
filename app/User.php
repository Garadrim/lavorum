<?php

	namespace App;

	use Illuminate\Auth\Authenticatable;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Auth\Passwords\CanResetPassword;
	use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
	use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

	class User extends Model implements AuthenticatableContract, CanResetPasswordContract {
		use Authenticatable, CanResetPassword;

		/**
		* The database table used by the model.
		* @var string
		*/
		protected $table = 'users';

		/**
		* The attributes that are mass assignable.
		* @var array
		*/
		protected $fillable = ['username', 'email', 'password'];

		/**
		* The attributes excluded from the model's JSON form.
		* @var array
		*/
		protected $hidden = ['password', 'remember_token'];

		// Posts from author
		public function posts() {
			return $this->hasMany('App\Posts','user_id')->orderBy('created_at', 'desc');
		}

		// Comments from users
		public function comments() {
			return $this->hasMany('App\Comments','user_id')->orderBy('created_at', 'desc');
		}

		// Check role of user
		public function can_post() {
			$role = $this->role;
			// If author or admin
			if ($role == 'author' || $role == 'admin') {
				return true;
			}
			return false;
		}

		// Check if user is admin
		public function is_admin() {
			$role = $this->role;
			if ($role == 'admin') {
				return true;
			}
			return false;
		}

	}
