<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use \Response;
use \Exception;

class PostApiController extends Controller
{
  public function getPosts(Request $request)
  {
      try {
        $index = $request->get('index', 1);
  			$limit = 5;
  			$offset = $index - 1;
  			$data = Post::whereNull('deleted_at')
          							 ->take($limit)
          							 ->offset($offset * $limit)
          							 ->orderBy('created_at', 'DESC')
          							 ->get(['id', 'description', 'photo']);
  			return Response::json(['status' => 1, 'message' => 'Success', 'data' => $data]);
      } catch (Exception $e) {
        return Response::json(['status' => 0, 'message' => $e->getMessage()]);
      }

  }
}
