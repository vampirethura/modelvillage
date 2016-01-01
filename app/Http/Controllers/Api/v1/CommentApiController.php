<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comment;
use App\Post;
use \Response;
use Common\SessionUtil;
use Common\TimeAgo;
use \Exception;

class CommentApiController extends Controller
{
  //constructor class
  public function __construct()
  {
      $this->middleware('api.auth'); #check user is authenticated/login
  }

  public function postComment(Request $request)
  {
      try {
        $session_token = $request->get('session_token');
        $post_id = $request->get('post_id');
        $comment_text = $request->get('comment_text');
        $customer = SessionUtil::getCustomer($session_token);
        $post = Post::find($post_id);

        $new_comment = new Comment();
        $new_comment->customer_id = $customer->id;
        $new_comment->comment_text = $comment_text;
        $new_comment->save();
        $post->comments()->save($new_comment);
        $timeAgo = new TimeAgo();
        $data = [
          'id' => $new_comment->id,
          'comment_text' => $new_comment->comment_text,
          'customer_name' => $new_comment->customer->display_name,
          'time_ago' => $timeAgo->inWords($new_comment->created_at)
        ];
  			return Response::json(['status' => 1, 'message' => 'Success', 'data' => $data ]);
      } catch (Exception $e) {
        return Response::json(['status' => 0, 'message' => $e->getMessage()]);
      }

  }

  public function getComments(Request $request)
  {
      try {
        $post_id = $request->get('post_id');
        $post = Post::find($post_id);
        $comments = [];
        $timeAgo = new TimeAgo();
        foreach ($post->comments as $comment) {
          $comments[] = [
            'id' => $comment->id,
            'comment_text' => $comment->comment_text,
            'customer_name' => $comment->customer->display_name,
            'time_ago' => $timeAgo->inWords($comment->created_at)
          ];
        }
        // sleep(5);
  			return Response::json(['status' => 1, 'message' => 'Success', 'data' => $comments]);
      } catch (Exception $e) {
        return Response::json(['status' => 0, 'message' => $e->getMessage()]);
      }

  }
}
