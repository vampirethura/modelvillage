<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Notification;
use \Response;
use Common\SessionUtil;
use Common\TimeAgo;
use \Exception;

class NotificationApiController extends Controller
{
  //constructor class
  public function __construct()
  {
      $this->middleware('api.auth'); #check user is authenticated/login
  }

  public function getNotifications(Request $request)
  {
      try {
        $session_token = $request->get('session_token');
        $index = $request->get('index', 1);
        $limit = 10;
        $offset = $index - 1;
        $notifications = Notification::take($limit)
                      							 ->offset($offset * $limit)
                      							 ->orderBy('created_at', 'DESC')
                      							 ->get();
        $data = [];
        $timeAgo = new TimeAgo();
        foreach ($notifications as $notification) {
          $data[] = [
            'id' => $notification->id,
            'subject' => $notification->subject,
            'body' => $notification->body,
            'ago' => $timeAgo->inWords($notification->created_at)
          ];
        }
  			return Response::json(['status' => 1, 'message' => 'Success', 'data' => $data]);
      } catch (Exception $e) {
        return Response::json(['status' => 0, 'message' => $e->getMessage()]);
      }

  }
}
