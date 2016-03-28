<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Requests;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Http\Request;

	class LavorumController extends Controller
	{
		public function index() {
			return redirect('/lavorum/home');
		}
	}

