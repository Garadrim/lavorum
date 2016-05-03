<?php

	namespace App\Http\Controllers;

	use Redirect;
	use App\Posts;
	use App\Comments;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;

	class CommentController extends Controller
	{
		public function store(Request $request) {
			// Which user, post and comment
			$input['user_id'] = $request->user()->id;
			$input['post_id'] = $request->input('post_id');
			$input['comment'] = $request->input('comment');
			$slug = $request->input('slug');
			Comments::create($input);
			return redirect('/lavorum/show/'.$slug)->with('message', 'Comment published');
		}

		public function edit(Request $request, $id) {
			$comment = Comments::where('id', $id)->first();
			/*
			if ($comment && ($request->user()->id == $comment->user_id || $request->user()->is_admin())) {
				return view('lavorum/comment.edit')->with('comment', $comment);
			}
			return redirect('/lavorum')->withErrors('You are not allowed to do that');
			*/
		}

		public function update(Request $request, $id) {
			//
			$comment = Comments::find($id);
			$comment->comment = $request->input("new_comment_".$id);
			$posts_id = $comment->post_id;
			$post = Posts::find($posts_id);
			$landing = '/lavorum/show/'.$post->slug;

			if ($comment && ($comment->user_id == $request->user()->id || $request->user()->is_admin())) {
				$comment->save();
				$message = 'Comment updated successfully!';
			}
			else {
				$message = "You are not allowed to do that";
			}
			return redirect($landing)->withMessage($message);
		}

		// Delete the post
		public function delete_this(Request $request, $id) {
			$comment = Comments::find($id);
			$post_id = $comment->post_id;
			$post = Posts::find($post_id);
			$post->slug = str_slug($post->title);
			
			if ($comment && ($comment->user_id == $request->user()->id || $request->user()->is_admin())) {
				$comment->delete();
				$data['message'] = 'Comment deleted successfully';
			}
			else {
				$data['errors'] = 'You are not allowed to do that';
			}
			return redirect('/lavorum/show/'.$post->slug)->with($data);
		}

	}
