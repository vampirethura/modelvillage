<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SysConfig;
use Common\Generate;
use \Redirect;
use \Exception;

class PermPosTypeSettingController extends Controller
{
    protected $module = 'permission_pos_type';
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
      $per_pos_settings = SysConfig::where('type', 'SystemPermissionPositionType')->get();
      return view('backend.sysconfig.perm_pos_type_setting_index')
              ->with('content_title', 'Permission Position Type Settings')
              ->with('per_pos_settings', $per_pos_settings)
              ->with('module', $this->module);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
      try {
        $inputs = $request->all();
        unset($inputs['_method']);
        unset($inputs['_token']);
        foreach ($inputs as $key => $value) {
          SysConfig::where('type', 'SystemPermissionPositionType')
                    ->where('key', $key)
                    ->update(['value' => $value]);
        }
        return Redirect::to('/crm/permission_pos_type')
                ->withMessage(Generate::success_message('Success', 'Updated Successfully.') );
      } catch (Exception $e) {
        return Redirect::to('/crm/permission_pos_type')
                ->withMessage(Generate::error_message('Fail', 'Failed to update.') );
      }
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
