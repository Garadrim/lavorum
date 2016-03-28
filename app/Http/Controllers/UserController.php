<?php

	namespace App\Http\Controllers;

	use App\User;
	use App\Posts;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;

	class UserController extends Controller
	{
		/**
		* Display active posts of a particular user
		* 
		* @param int $id
		* @return view
		*/
		public function posts($id) {
			//
			$posts = Posts::where('user_id', $id)->where('active', 1)->orderBy('created_at', 'desc')->paginate(5);
			$title = User::find($id)->username;
			return view('/lavorum.index')->withPosts($posts)->withTitle($title);
		}

		/**
		* Display all of the posts of a particular user
		* 
		* @param Request $request
		* @return view
		*/
		public function allposts(Request $request) {
			//
			$user = $request->user();
			$posts = Posts::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
			$title = $user->username;
			return view('/lavorum.index')->withPosts($posts)->withTitle($title);
		}

		/**
		* Display draft posts of a currently active user
		* 
		* @param Request $request
		* @return view
		*/
		public function drafts(Request $request) {
		//
			$user = $request->user();
			$posts = Posts::where('user_id', $user->id)->where('active', 0)->orderBy('created_at', 'desc')->paginate(5);
			$title = $user->username;
			return view('/lavorum.index')->withPosts($posts)->withTitle($title);
		}

		/**
		* Profile for user
		*/
		public function profile(Request $request, $id) {
			$data['user'] = User::find($id);
			if (!$data['user']) {
				return redirect('/lavorum');
			}
			else {
				if ($request->user() && $data['user']->id == $request->user()->id) {
					$data['author'] = true;
				}
				else {
					$data['author'] = null;
				}

				// Amount of comments made
				$data['comments_count'] = $data['user']->comments->count();
				// Amount of posts
				$data['posts_count'] = $data['user']->posts->count();
				// Amount of published posts
				$data['posts_active_count'] = $data['user']->posts->where('active', 1)->count();
				//Amount of drafts made
				$data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
				// Latest 5 posts made
				$data['latest_posts'] = $data['user']->posts->where('active', 1)->take(5);
				// Latest 5 comments made
				$data['latest_comments'] = $data['user']->comments->take(5);
				
				return view('/lavorum.profile', $data);
			}
		}
	}