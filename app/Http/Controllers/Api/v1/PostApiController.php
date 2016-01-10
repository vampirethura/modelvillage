<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use \Response;
use \DB;
use Common\SessionUtil;
use Common\FileUpload;
use Common\TimeAgo;
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
        $timeAgo = new TimeAgo();
        foreach ($posts as $post) {
          $is_liked = DB::table('post_likes')
                        ->where('customer_id', $customer->id)
                        ->where('post_id', $post->id)
                        ->exists();
          $is_photo_post = $post->photo != null && $post->photo != "";
          $data[] = [
            'id' => $post->id,
            'description' => $post->description,
            'photo' => $post->photo,
            'like_count' => $post->likes->count(),
            'is_liked' => $is_liked,
            'is_photo_post' => $is_photo_post,
            'comment_count' => $post->comments->count(),
            'customer_name' => $post->customer->display_name,
            'ago' => $timeAgo->inWords($post->created_at)
          ];
        }
        // sleep(2000);
  			return Response::json(['status' => 1, 'message' => 'Success', 'data' => $data]);
      } catch (Exception $e) {
        return Response::json(['status' => 0, 'message' => $e->getMessage()]);
      }

  }

  public function getPost(Request $request)
  {
      try {
        $session_token = $request->get('session_token');
        $post_id = $request->get('post_id');

  			$post = Post::find($post_id);
        $data = [];
        $customer = SessionUtil::getCustomer($session_token);
        $is_liked = DB::table('post_likes')
                      ->where('customer_id', $customer->id)
                      ->where('post_id', $post->id)
                      ->exists();
        $is_photo_post = $post->photo != null && $post->photo != "";
        $timeAgo = new TimeAgo();
        $data = [
          'id' => $post->id,
          'description' => $post->description,
          'photo' => $post->photo,
          'like_count' => $post->likes->count(),
          'is_liked' => $is_liked,
          'is_photo_post' => $is_photo_post,
          'comment_count' => $post->comments->count(),
          'customer_name' => $post->customer->display_name,
          'ago' => $timeAgo->inWords($post->created_at)
        ];
        // sleep(5);
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

  public function newPost(Request $request){
    try {
      $session_token = $request->get('session_token');
      $customer = SessionUtil::getCustomer($session_token);
      $description = $request->get('description');
      $photo = $request->file('photo');
      $inputs = [];
      if ($photo) {
          //Upload Image
          $uploaded_path = FileUpload::upload($photo);
          $inputs['photo'] = $uploaded_path;
      }
      $inputs['description'] = $description;
      $inputs['customer_id'] = $customer->id;
      Post::create($inputs);
      return Response::json(['status' => 1, 'message' => 'Success']);
    } catch (Exception $e) {
      return Response::json(['status' => 0, 'message' => $e->getMessage()]);
    }

  }
}
