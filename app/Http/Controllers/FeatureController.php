<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateFeatureFromRequest;
use App\Http\Requests\CreatePermissionFromRequest;
use App\Http\Requests\UpdateFeatureFromRequest;
use App\Http\Controllers\Controller;
use App\Feature;
use App\SysConfig;
use App\Permission;
use App\Setting;
use \DB;
use \Redirect;
use \Input;
use Common\ActionSchema;
use Common\Generate;
class FeatureController extends Controller
{
    protected $module = 'feature';

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
      $features = Feature::all();
      $actions = ActionSchema::getActionSchema($this->module);
      return view('backend.feature.index')
              ->with('content_title', 'Features Management')
              ->with('features', $features)
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
      $icons = SysConfig::getSystemConfig('Icons');
      return view('backend.feature.create')
              ->with('content_title', 'Create New Feature')
              ->with('icons', $icons)
              ->with('module', $this->module);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFeatureFromRequest $request)
    {
        $inputs = $request->all();
        $transaction = DB::transaction(function() use ($inputs) {
            $new_feature = Feature::create($inputs);
            if ($inputs['crud'] == '1') {
              // $permission_req = new CreatePermissionFromRequest();
              // $permission_rules = $permission_req->rules();
              // create inputs field for permission that need to be created - RestFul
  		    		$permission_inputs = array(
  			    		[
  			    			'feature_id'=>$new_feature->id,
  			    			'name'=>'create',
  			    			'descr'=>'Create Form',
  			    			'module'=>$new_feature->module,
  			    			'position'=>'panel-default',
  			    			'url'=>'/crm/'. $new_feature->module . '/create',
  			    			'icon'=>'fa-plus',
  			    			'icon_bg'=>'btn-primary',
  			    			'page'=>'index',
  			    			'prompt_type'=>'none',
  			    			'prompt_title'=>null,
  			    			'prompt_content'=>null
  			    		],
  			    		[
  			    			'feature_id'=>$new_feature->id,
  			    			'name'=>'store',
  			    			'descr'=>'store record',
  			    			'module'=>$new_feature->module,
  			    			'position'=>'form',
  			    			'url'=>'/crm/'.$new_feature->module,
  			    			'icon'=>null,
  			    			'icon_bg'=>null,
  			    			'page'=>'index',
  			    			'prompt_type'=>'none',
  			    			'prompt_title'=>null,
  			    			'prompt_content'=>null
  			    		],
  			    		[
  			    			'feature_id'=>$new_feature->id,
  			    			'name'=>'show',
  			    			'descr'=>'Show Details',
  			    			'module'=>$new_feature->module,
  			    			'position'=>'table',
  			    			'url'=>'/crm/'.$new_feature->module.'/[ID]',
  			    			'icon'=>'fa-file-text-o',
  			    			'icon_bg'=>'btn-success',
  			    			'page'=>'index',
  			    			'prompt_type'=>'none',
  			    			'prompt_title'=>null,
  			    			'prompt_content'=>null
  			    		],
  			    		[
  			    			'feature_id'=>$new_feature->id,
  			    			'name'=>'edit',
  			    			'descr'=>'Edit Details',
  			    			'module'=>$new_feature->module,
  			    			'position'=>'table',
  			    			'url'=>'/crm/'.$new_feature->module.'/[ID]/edit',
  			    			'icon'=>'fa-edit',
  			    			'icon_bg'=>'btn-warning',
  			    			'page'=>'index',
  			    			'prompt_type'=>'none',
  			    			'prompt_title'=>null,
  			    			'prompt_content'=>null
  			    		],
  			    		[
  			    			'feature_id'=>$new_feature->id,
  			    			'name'=>'update',
  			    			'descr'=>'Update Details',
  			    			'module'=>$new_feature->module,
  			    			'position'=>'form',
  			    			'url'=>'/crm/'.$new_feature->module.'/[ID]',
  			    			'icon'=>null,
  			    			'icon_bg'=>null,
  			    			'page'=>'index',
  			    			'prompt_type'=>'none',
  			    			'prompt_title'=>null,
  			    			'prompt_content'=>null
  			    		],
  			    		[
  			    			'feature_id'=>$new_feature->id,
  			    			'name'=>'destroy',
  			    			'descr'=>'Delete Record',
  			    			'module'=>$new_feature->module,
  			    			'position'=>'table',
  			    			'url'=>'/crm/'.$new_feature->module.'/[ID]',
  			    			'icon'=>'fa-times',
  			    			'icon_bg'=>'btn-primary',
  			    			'page'=>'index',
  			    			'prompt_type'=>'confirm',
  			    			'prompt_title'=>'Delete',
  			    			'prompt_content'=>'Are you sure you want to delete this record?'
  			    		],
  			    		[
  			    			'feature_id'=>$new_feature->id,
  			    			'name'=>'multi_destroy',
  			    			'descr'=>'Delete Multiple Record',
  			    			'module'=>$new_feature->module,
  			    			'position'=>'panel-alert',
  			    			'url'=>'/crm/'.$new_feature->module.'/multi_destroy',
  			    			'icon'=>'fa-times',
  			    			'icon_bg'=>'btn-primary',
  			    			'page'=>'index',
  			    			'prompt_type'=>'confirm',
  			    			'prompt_title'=>'Delete',
  			    			'prompt_content'=>'Are you sure you want to delete this record?'
  			    		]
  		    		);

              foreach ($permission_inputs as $permission) {
                  Permission::create($permission);
              }
            }
        });
        return Redirect::to('/crm/feature/')
              ->withMessage(Generate::success_message('Success', 'Created Successfully'));
        // $transaction
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $feature = Feature::find($id);
      if(!isset($feature)) return Redirect::to('/crm/feature')->withMessage(Generate::message('Invalid', 'Invalid Feature or Feature has been deleted'));

      $permissions = $feature->permissions;
      $actions = ActionSchema::getActionSchema($this->module);
      return view('backend.feature.show')
              ->with('content_title', 'Feature and Permissions')
              ->with('feature', $feature)
              ->with('actions', $actions)
              ->with('permissions', $permissions)
              ->with('module', $this->module);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $icons = SysConfig::getSystemConfig('Icons');
      $feature = Feature::find($id);
      return view('backend.feature.edit')
              ->with('content_title', 'Edit Feature')
              ->with('feature', $feature)
              ->with('icons', $icons)
              ->with('module', $this->module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeatureFromRequest $request, $id)
    {
        try {
          $inputs = $request->all();
          $feature = Feature::find($id);
          if ($feature->module != $inputs['module']) {
            $module_exists = Feature::where('module', $inputs['module'])->exists();
            if ($module_exists) {
              return Redirect::to('/crm/feature/')
                  ->withMessage(Generate::error_message('Fail', 'Module name already exists.'));
            }
          }
          $feature->update($inputs);
          return Redirect::to('/crm/feature/' . $id)
                ->withMessage(Generate::success_message('Success', 'Updated Successfully'));
        } catch (Exception $e) {
          //redirect to the url you wan along with the message
          return Redirect::to('/crm/feature/')
              ->withMessage(Generate::error_message('Fail', 'Failed to update.'));
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
        try {
          Feature::find($id)->delete();
          //redirect to the url you want along with the message
          return Redirect::to('/crm/feature/')
              ->withMessage(Generate::success_message('Success', 'Deleted Successfully.'));
        } catch (Exception $e) {
          //redirect to the url you wan along with the message
          return Redirect::to('/crm/feature/')
              ->withMessage(Generate::error_message('Fail', 'Failed to delete.'));
        }

    }

    public function editPermission($fid, $pid){

      $feature = Feature::find($fid);
      if(!isset($feature)) return Redirect::to('/crm/feature')->withMessage(Generate::message('Invalid', 'Invalid Feature or Feature has been deleted'));

      $permission = Permission::find($pid);
      if(!isset($feature)) return Redirect::to('/crm/feature/'.$fid)->withMessage(Generate::message('Invalid', 'Invalid Permission or Permission has been deleted'));

      $all_positions = Permission::getAllCurrentPosition();
      $icons = SysConfig::getSystemConfig('Icons');
      $icon_bgs = SysConfig::getSystemConfig('IconBG');
      $all_pages = Permission::getAllCurrentPages();
      $all_prompt_types = Permission::getAllCurrentPromptTypes();
      return view('backend.feature.edit_permission')
          ->with('content_title', 'Edit Feature Permission')
          ->with('feature', $feature)
          ->with('permission', $permission)
          ->with('icons', $icons)
          ->with('icon_bgs', $icon_bgs)
          ->with('all_prompt_types', $all_prompt_types)
          ->with('all_pages', $all_pages)
          ->with('all_positions', $all_positions)
          ->with('module', $this->module);
    }

    public function updatePermission($fid, $pid, CreatePermissionFromRequest $request){
      try {
          $inputs = Input::all();
          unset($inputs['_method']);
          unset($inputs['_token']);
          Permission::find($pid)->update($inputs);
          //redirect to the url you want along with the message
          return Redirect::to('/crm/feature/'.$fid)
              ->withMessage(Generate::success_message('Success', 'Updated Successfully.'));
      } catch (Exception $e) {
          //redirect to the url you wan along with the message
          return Redirect::to('/crm/feature/'.$fid)
              ->withMessage(Generate::error_message('Fail', 'Failed to update.'));
      }
    }

    public function deletePermission($fid, $pid){
      try {
        Permission::find($pid)->delete();
        //redirect to the url you want along with the message
        return Redirect::to('/crm/feature/'.$fid)
            ->withMessage(Generate::success_message('Success', 'Deleted Successfully.'));
      } catch (Exception $e) {
        //redirect to the url you wan along with the message
        return Redirect::to('/crm/feature/'.$fid)
            ->withMessage(Generate::error_message('Fail', 'Failed to update.'));
      }
    }

    public function createPermission($fid){
      $feature = Feature::find($fid);
  		if(!isset($feature)) return Redirect::to('/crm/feature')->withMessage(Generate::message('Invalid', 'Invalid Feature or Feature has been deleted'));

  		$all_positions = Permission::getAllCurrentPosition();
  		$icons = SysConfig::getSystemConfig('Icons');
  		$icon_bgs = SysConfig::getSystemConfig('IconBG');
  		$all_pages = Permission::getAllCurrentPages();
  		$all_prompt_types = Permission::getAllCurrentPromptTypes();

  		return view('backend.feature.create_permission')
          ->with('content_title', 'Create New Permission')
  				->with('feature', $feature)
  				->with('icons', $icons)
  				->with('icon_bgs', $icon_bgs)
  				->with('all_prompt_types', $all_prompt_types)
  				->with('all_pages', $all_pages)
  				->with('all_positions', $all_positions)
  				->with('module', $this->module);
    }

    public function storePermission($fid, CreatePermissionFromRequest $request){
      try {
          $inputs = Input::all();
          unset($inputs['_method']);
          unset($inputs['_token']);
          Permission::create($inputs);
          //redirect to the url you want along with the message
          return Redirect::to('/crm/feature/'.$fid)
              ->withMessage(Generate::success_message('Success', 'Created Successfully.'));
      } catch (Exception $e) {
          //redirect to the url you wan along with the message
          return Redirect::to('/crm/feature/'.$fid)
              ->withMessage(Generate::error_message('Fail', 'Failed to create.'));
      }
    }
}
