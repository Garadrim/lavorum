<?php

	namespace App\Http\Controllers;

	//use DB;
	use Redirect;
	use App\Posts;
	use App\User;
	use App\Http\Controllers\Controller;
	use App\Http\Requests\PostFormRequest;
	use Illuminate\Http\Request;

	class PostController extends Controller
	{
		
		// Get the 5 latest posts that are active
		public function index() {
			$posts = Posts::where('active', 1)->orderBy('created_at', 'desc')->paginate(5);
			// Page heading
			return view('lavorum.index')->withPosts($posts);
		}


		// Go to new post form
		public function create(Request $request) {
			// If user role is admin or author
			if ($request->user()->can_post()) {
				return view('lavorum/post.create');
			}
			else {
				return redirect('/lavorum.index')->withErrors('You are not allowed to create a post');
			}
		}


		// Store the new post
		public function store(PostFormRequest $request) {
			$post = new Posts();
			$post->title = $request->get('title');
			$post->content = $request->get('content');
			$post->slug = str_slug($post->title);
			$post->user_id = $request->user()->id;
			if($request->has('save')) {
				$post->active = 0;
				$message = 'Post saved successfully';
			}
			else {
				$post->active = 1;
				$message = 'Post published successfully';
			}

			$post->save();
			return redirect('/lavorum/post/edit/'.$post->slug)->withMessage($message);
		}


		// Show post
		public function show($slug) {
			$post = Posts::where('slug', $slug)->first();
			if (!$post) {
				return redirect('/lavorum')->withErrors('Requested page not found');
			}
			$comments = $post->comments;
			return view('lavorum/post.show')->withPost($post)->withComments($comments);
		}


		// Edit the post
		public function edit(Request $request, $slug) {
			$post = Posts::where('slug', $slug)->first();
			if ($post && ($request->user()->id == $post->user_id || $request->user()->is_admin())) {
				return view('lavorum/post.edit')->with('post', $post);
			}
			return redirect('/lavorum')->withErrors('You are not allowed to do that');
		}


		// Update the post
		public function update(Request $request) {
			$post_id = $request->input('post_id');
			$post = Posts::find($post_id);
			if ($post && ($post->user_id == $request->user()->id || $request->user()->is_admin())) {
				$title = $request->input('title');
				$slug = str_slug($title);
				$duplicate = Posts::where('slug', $slug)->first();
				if($duplicate) {
					if($duplicate->id != $post_id) {
						return redirect('/lavorum/post/edit/'.$post->slug)->withErrors('Title already exists')->withInput();
					}
					else {
						$post->slug = $slug;
					}
				}
				
				$post->title = $title;
				$post->content = $request->input('content');
				
				if($request->has('save')){
					$post->active = 0;
					$message = 'Post saved successfully';
					$landing = '/lavorum/post/edit/'.$post->slug;
				}
				else {
					$post->active = 1;
					$message = 'Post updated successfully';
					$landing = '/lavorum/view/'.$post->slug;
				}
				$post->save();
				return redirect($landing)->withMessage($message);
			}
			else {
				return redirect('/lavorum')->withErrors('You are not allowed to do that');
			}
		}


		// Delete the post
		public function delete_this(Request $request, $id) {
			$post = Posts::find($id);
			if ($post && ($post->user_id == $request->user()->id || $request->user()->is_admin())) {
				$post->delete();
				$data['message'] = 'Post deleted successfully';
			}
			else {
				$data['errors'] = 'You are not allowed to do that';
			}
			return redirect('/lavorum')->with($data);
		}


	}
