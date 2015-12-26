<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Customer;
use Common\ActionSchema;
use Common\Generate;
use Common\PnS;
use \Auth;
use \Exception;

class NotificationController extends Controller
{
    protected $module = 'notification';

    //constructor class
    public function __construct()
    {
        $this->middleware('auth'); #check user is authenticated/login
        $this->middleware('role'); #check user has the access to this function/module
        $this->middleware('permission'); #check permission access
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $notifications = Notification::all();
      $actions = ActionSchema::getActionSchema($this->module);
      return view('backend.notification.index')
                ->with('content_title', 'Notifications')
                ->with('notifications', $notifications)
                ->with('actions', $actions)
                ->with('module', $this->module);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.notification.create')
                ->with('content_title', 'New Notification')
                ->with('module', $this->module);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
          $inputs = $request->all();
          unset($inputs['_token']);
          $device_tokens = Customer::where('platform', 'A')->lists('device_token');
          $is_sent = PnS::sendPnsToAndroidDevices($device_tokens, $inputs['body']);
          if ($is_sent) {
            $inputs['user_id'] = Auth::id();
            Notification::create($inputs);
          }
          return redirect()->to('/crm/notification/')
                ->withMessage(Generate::success_message('Success', 'Sent Successfully'));
        } catch (Exception $e) {
          return redirect()->to('/crm/notification/')
                ->withMessage(Generate::error_message('Failed', $e->getMessage()));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
