<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SysConfig;
use \Redirect;
use Common\Generate;
use Common\FileUpload;
use \Exception;


class SystemSettingController extends Controller
{
    protected $module = 'system_setting';

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
      $system_settings = SysConfig::where('type', 'SystemSettings')->get();
      $settings = [];
      foreach ($system_settings as $setting) {
        $settings[$setting->key] = $setting->value;
      }
      return view('backend.sysconfig.sys_setting_index')
              ->with('content_title', 'System Settings')
              ->with('settings', $settings)
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
          $crm_company_logo = $request->file('crm-company-logo');
          $crm_company_logo_sm = $request->file('crm-company-logo-sm');
          $crm_company_name = $request->get('crm-company-name');
          $crm_login_bg_image = $request->file('crm-login-bg-image');
          $crm_home_url = $request->get('crm-home-url');
          $crm_login_title = $request->get('crm-login-title');

          if ($crm_company_logo) {
            $uploaded_path = FileUpload::upload($crm_company_logo, '/assets/images/backend/');
            SysConfig::where('type', 'SystemSettings')
                      ->where('key', 'crm-company-logo')
                      ->update(['value' => $uploaded_path]);
          }

          if ($crm_company_logo_sm) {
            $uploaded_path = FileUpload::upload($crm_company_logo_sm, '/assets/images/backend/');
            SysConfig::where('type', 'SystemSettings')
                      ->where('key', 'crm-company-logo-sm')
                      ->update(['value' => $uploaded_path]);
          }

          if ($crm_login_bg_image) {
            $uploaded_path = FileUpload::upload($crm_login_bg_image, '/assets/images/login-bg/');
            SysConfig::where('type', 'SystemSettings')
                      ->where('key', 'crm-login-bg-image')
                      ->update(['value' => $uploaded_path]);
          }

          SysConfig::where('type', 'SystemSettings')
                    ->where('key', 'crm-company-name')
                    ->update(['value' => $crm_company_name]);
          SysConfig::where('type', 'SystemSettings')
                    ->where('key', 'crm-home-url')
                    ->update(['value' => $crm_home_url]);
          SysConfig::where('type', 'SystemSettings')
                    ->where('key', 'crm-login-title')
                    ->update(['value' => $crm_login_title]);

          return Redirect::to('/crm/system_setting')
                  ->withMessage(Generate::success_message('Success', 'Updated Successfully.') );
        } catch (Exception $e) {
          return Redirect::to('/crm/system_setting')
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
