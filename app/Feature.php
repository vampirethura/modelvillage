<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Feature extends Model
{
    protected $table = 'features'; //manual assign the table this model is associated with.
    protected $module = 'feature';
    use SoftDeletes; //enabled the softdelete, meaning record wont be deleted instead 'delete_at' timestamp will be set.
    protected $dates = ['deleted_at'];
    protected $guarded = ['id']; //this is another way of protecting mass assignment, other than column u specify here, all will be able to mass assigned
    #protected $fillable = []; // u can mass assign columns that is specified here.



    # Relationship -------------------------------------------------------------------------------------------------->
    # ---------------
    # One-to-One # hasOne(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)
    # User have staff info (model, foreign_key, local_key)


    # ---------------
    # One-to-Many # hasMany(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)
    # Features has many Permissions
    public function permissions()
    {
      return $this->hasMany('App\Permission', 'feature_id', 'id');
    }

    # ---------------
    # Many-to-Many #belongsToMany(Model, pivot_table, associated_key1, associated_key2)
    # One Feature can be in many roles, One roles can have many features.
    public function roles()
    {
      return $this->belongsToMany('App\Role', 'feature_role', 'feature_id', 'role_id');
    }



    # Functions ----------------------------------------------------------------------------------------------------->

    // this function is abit special as it make use of the transaction to complete few chain database insertion.
    // Logic: When a new feature is created, RestFUL permission that belongs to that feature will be create if CRUD is checked.
    public function createNew()
    {
      //create transaction method
      try
      {
        $new = DB::transaction(function()
        {

          //define rules for the features.
          $feature_rules = [
          'name'=>'required',
          'url'=>'required',
          'icon'=>'required',
          'module'=>'required|unique:features'
        ];

          //get the form inputs from the POST
          $inputs = Input::all();

          //create new feature object, compare input with rules and after that create new entry into db
          $feature = new Feature();
          $feature_result = $feature->doCreate($inputs, $feature_rules);
          if($feature_result['status'] != 1) throw new Exception($feature_result['message']);

          //if CRUD is selected.
          if($inputs['crud'] == '1')
          {
            //define rules for permission
          $permission_rules = ValidationRule::$permissionCreate;

          // create inputs field for permission that need to be created - RestFul
            $permission_inputs = array(
              [
                'feature_id'=>$feature_result['data']['id'],
                'name'=>'create',
                'descr'=>'Create Form',
                'module'=>$feature_result['data']['module'],
                'position'=>'panel-default',
                'url'=>'/crm/'.$feature_result['data']['module'].'/create',
                'icon'=>'fa-plus',
                'icon_bg'=>'btn-primary',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
              ],
              [
                'feature_id'=>$feature_result['data']['id'],
                'name'=>'store',
                'descr'=>'store record',
                'module'=>$feature_result['data']['module'],
                'position'=>'form',
                'url'=>'/crm/'.$feature_result['data']['module'],
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
              ],
              [
                'feature_id'=>$feature_result['data']['id'],
                'name'=>'show',
                'descr'=>'Show Details',
                'module'=>$feature_result['data']['module'],
                'position'=>'table',
                'url'=>'/crm/'.$feature_result['data']['module'].'/[ID]',
                'icon'=>'fa-file-text-o',
                'icon_bg'=>'btn-success',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
              ],
              [
                'feature_id'=>$feature_result['data']['id'],
                'name'=>'edit',
                'descr'=>'Edit Details',
                'module'=>$feature_result['data']['module'],
                'position'=>'table',
                'url'=>'/crm/'.$feature_result['data']['module'].'/[ID]/edit',
                'icon'=>'fa-edit',
                'icon_bg'=>'btn-warning',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
              ],
              [
                'feature_id'=>$feature_result['data']['id'],
                'name'=>'update',
                'descr'=>'Update Details',
                'module'=>$feature_result['data']['module'],
                'position'=>'form',
                'url'=>'/crm/'.$feature_result['data']['module'].'/[ID]',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
              ],
              [
                'feature_id'=>$feature_result['data']['id'],
                'name'=>'destroy',
                'descr'=>'Delete Record',
                'module'=>$feature_result['data']['module'],
                'position'=>'table',
                'url'=>'/crm/'.$feature_result['data']['module'].'/[ID]',
                'icon'=>'fa-times',
                'icon_bg'=>'btn-primary',
                'page'=>'index',
                'prompt_type'=>'confirm',
                'prompt_title'=>'Delete',
                'prompt_content'=>'Are you sure you wan to delete this record?'
              ],
              [
                'feature_id'=>$feature_result['data']['id'],
                'name'=>'multi_destroy',
                'descr'=>'Delete Multiple Record',
                'module'=>$feature_result['data']['module'],
                'position'=>'panel-alert',
                'url'=>'/crm/'.$feature_result['data']['module'].'/multi_destroy',
                'icon'=>'fa-times',
                'icon_bg'=>'btn-primary',
                'page'=>'index',
                'prompt_type'=>'confirm',
                'prompt_title'=>'Delete',
                'prompt_content'=>'Are you sure you wan to delete this record?'
              ]
            );

          // foreach of the permission, insert into the db.
          foreach($permission_inputs as $permission_input)
          {
              $permission = new Permission();
              $permission_create = $permission->doCreate($permission_input, $permission_rules);
              if($permission_create['status'] != 1) throw new Exception($permission_create['message']);
          }
          }#end if

          //if everything OK return success
        return Redirect::to('/crm/feature')
            ->withMessage(Generate::message('SUCCESS', 'Success Create'));

        }); #end transaction
    }
    catch(Exception $e)
      {
        return Redirect::to('/crm/feature')
            ->withMessage(Generate::message('FAIL', $e->getMessage()));
      }
    return $new;
    }


    public function updateRecord($id)
    {
      $inputs = Input::all();
      $rules = [
        'name'=>'required',
        'url'=>'required',
        'icon'=>'required',
        'module'=>'required'
      ];

      $record = $this->doUpdate($id, $inputs, $rules);

      if($record['status'] == 1) {
        return Redirect::to('/crm/feature/'.$id)
          ->withMessage(Generate::message('SUCCESS', $record['message']));
      }

      return Redirect::to('/crm/feature/'.$id)
        ->withMessage(Generate::message('FAILED', $record['message']));

    }

    public function deleteRecord($id)
    {
      $inputs = [
        'id'=>$id
      ];

      $rules = [
        'id'=>'required'
      ];

      $deleted = $this->doDelete($id, $inputs, $rules);

    if($deleted['status'] == 1) {
      return Redirect::to('/crm/feature/')
        ->withMessage(Generate::message('SUCCESS', $deleted['message']));
    }

    return Redirect::to('/crm/feature/')
      ->withMessage(Generate::message('FAILED', $deleted['message']));
    }

    public function makeManagePage()
    {
    $features = [];
    $features = Feature::all();
    $actions = Feature::actionSchema();
    //return  Feature::test();

    return View::make('backend.feature.index')
          ->with('actions', $actions)
          ->with('features', $features)
          ->with('module', $this->module);
    }

    public function makeCreateForm()
    {
    $curr_feature_groups = [];
    $icons = SysConfig::getSystemConfig('Icons');
    $curr_feature_groups = Feature::getCurrentFeatureGroups();

    return View::make('backend.feature.create')
          ->with('curr_feature_groups', $curr_feature_groups)
          ->with('icons', $icons)
          ->with('module', $this->module);
    }

    public function makeDetailPage($id)
    {
    $feature = Feature::find($id);
    if(!isset($feature)) return Redirect::to('/crm/feature')->withMessage(Generate::message('Invalid', 'Invalid Feature or Feature has been deleted'));

    $permissions = $feature->permissions;
    $actions = Feature::actionSchema();

    return View::make('backend.feature.show')
        ->with('feature', $feature)
        ->with('actions', $actions)
        ->with('permissions', $permissions)
        ->with('module', $this->module);
    }


    public function makeEditForm($id)
    {
    $icons = SysConfig::getSystemConfig('Icons');

    $feature = Feature::find($id);
    return View::make('backend.feature.edit')
        ->with('feature', $feature)
        ->with('icons', $icons)
        ->with('module', $this->module);
    }


    public function makeCreatePermissionForm($fid)
    {
      $feature = Feature::find($fid);
    if(!isset($feature)) return Redirect::to('/crm/feature')->withMessage(Generate::message('Invalid', 'Invalid Feature or Feature has been deleted'));

    $all_positions = Permission::getAllCurrentPosition();
    $icons = SysConfig::getSystemConfig('Icons');
    $icon_bgs = SysConfig::getSystemConfig('IconBG');
    $all_pages = Permission::getAllCurrentPages();
    $all_prompt_types = Permission::getAllCurrentPromptTypes();

    return View::make('backend.feature.create_permission')
        ->with('feature', $feature)
        ->with('icons', $icons)
        ->with('icon_bgs', $icon_bgs)
        ->with('all_prompt_types', $all_prompt_types)
        ->with('all_pages', $all_pages)
        ->with('all_positions', $all_positions)
        ->with('module', $this->module);
    }


  # Static Functions ---------------------------------------------------------------------------------------------->

    public static function getCurrentFeatureGroups()
    {
      $groups = [];

      $groups = Feature::whereNull('deleted_at')->select('group')->groupBy('group')->get();
      return $groups;
    }

    public static function getAllCurrentModules()
    {
      $modules = [];

      $modules = Feature::whereNull('deleted_at')->select('module', 'name')->groupBy('module')->get();
      return $modules;
    }

    //get the url field by their module
    public static function getUrlByModule($module)
    {
      //get the feature url
      return Feature::where('module', $module)->first()->url;
    }

    //get permission by their module and position
    public static function getPermissionsByModule($module, $position)
    {
      //get the permission by their module...
      return Feature::where('module', $module)
              ->first()
              ->permissions()
              ->where('position', $position)
              ->get();
    }

    # get feature permissions
    public static function getFeaturePermissions ($role_id)
    {
      //
      $result = [];

      $features = Role::find($role_id)->features()->wherePivot('deleted_at', null)->get();

      foreach ($features as $feature)
      {
        $permissions = [];
        //$permissions = Role::find($role_id)->permissions()->where('feature_id', $feature->id)->get();
        $feature_permissions = Permission::where('feature_id', $feature->id)->get();

        foreach($feature_permissions as $fp)
        {
          //get the role for this feature, check whether is ther any pivot exist.
          //$roles = $fp->roles()->where('role_id', $role_id)->get(); //not using the pivot...
          $pivot = PermissionRole::whereNull('deleted_at')->where('role_id', $role_id)->where('permission_id', $fp->id)->first();
          $checked = ( count( $pivot ) > 0 ) ? true : false;

          $permissions [] = [
            'id' =>$fp->id,
            'feature_id'=>$fp->feature_id,
            'name'=>$fp->name,
            'descr'=>$fp->descr,
            'module'=>$fp->module,
            'position'=>$fp->position,
            'url'=>$fp->url,
            'icon'=>$fp->icon,
            'icon_bg'=>$fp->icon_bg,
            'prompt_type'=>$fp->prompt_type,
            'prompt_title'=>$fp->prompt_title,
            'prompt_content'=>$fp->prompt_content,
            'checked'=>$checked
          ];
        }

        $result [] = [
          'feature'=>$feature->toArray(),
          'permissions'=>$permissions
        ];
      }
      // get result ...
      return $result;
    }
}
