<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use \Response;
use \DB;
use Common\SessionUtil;
use \Exception;

class PostApiController extends Controller
{
  //constructor class
  public function __construct()
  {
      $this->middleware('api.auth'); #check user is authenticated/login
  }

  public function getPosts(Request $request)
  {
      try {
        $session_token = $request->get('session_token');
        $index = $request->get('index', 1);
  			$limit = 5;
  			$offset = $index - 1;
  			$posts = Post::take($limit)
      							 ->offset($offset * $limit)
      							 ->orderBy('created_at', 'DESC')
      							 ->get();
        $data = [];
        $customer = SessionUtil::getCustomer($session_token);
        foreach ($posts as $post) {
          $is_liked = DB::table('post_likes')
                        ->where('customer_id', $customer->id)
                        ->where('post_id', $post->id)
                        ->exists();
          $data[] = [
            'id' => $post->id,
            'description' => $post->description,
            'photo' => $post->photo,
            'like_count' => $post->likes->count(),
            'is_liked' => $is_liked
          ];
        }
        // sleep(2000);
  			return Response::json(['status' => 1, 'message' => 'Success', 'data' => $data]);
      } catch (Exception $e) {
        return Response::json(['status' => 0, 'message' => $e->getMessage()]);
      }

  }

  public function likePost(Request $request){
    try {
      $session_token = $request->get('session_token');
      $post_id = $request->get('post_id');
      $customer = SessionUtil::getCustomer($session_token);
      $post = Post::find($post_id);
      $is_liked = DB::table('post_likes')
                    ->where('customer_id', $customer->id)
                    ->where('post_id', $post->id)
                    ->exists();
      if (!$is_liked) {
        $post->likes()->save($customer);
      }
      return Response::json(['status' => 1, 'message' => 'Liked']);
    } catch (Exception $e) {
      return Response::json(['status' => 0, 'message' => $e->getMessage()]);
    }

  }

  public function unlikePost(Request $request){
    try {
      $session_token = $request->get('session_token');
      $post_id = $request->get('post_id');
      $customer = SessionUtil::getCustomer($session_token);
      $post = Post::find($post_id);
      $post->likes()->detach($customer);
      return Response::json(['status' => 1, 'message' => 'Unliked']);
    } catch (Exception $e) {
      return Response::json(['status' => 0, 'message' => $e->getMessage()]);
    }

  }
}
