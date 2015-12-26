<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Permission extends Model
{
  protected $table = 'permissions'; //manual assign the table this model is associated with. usually no need if the model name is the singular of the table name.
  use SoftDeletes; //enabled the softdelete, meaning record wont be deleted instead 'delete_at' timestamp will be set.
  protected $dates = ['deleted_at'];
  //protected $fillable = [];
  protected $guarded = ['id']; //this is another way of protecting mass assignment, other than column u specify here, all will be able to mass assigned

  # Action Params


  # Relationship -------------------------------------------------------------------------------------------------->
  # ---------------
  # One-to-One # hasOne(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)



    # ---------------
    # One-to-Many # hasMany(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)
    # One permission is belong to one feature.
    public function feature()
    {
      return $this->belongsTo('Feature', 'feature_id', 'id');
    }


    # ---------------
    # Many-to-Many #belongsToMany(Model, pivot_table, associated_key1, associated_key2)
    # one permission can belong to many role, one role can have many permissions
    public function roles()
    {
      //if the pivot table of permission and role is name as alphabetical order e.q permission_role, the pivot table and associated key will be auto mapped.
      return $this->belongsToMany('Role');
    }


    # Functions ----------------------------------------------------------------------------------------------------->

    #create record entry
    public function createEntry()
    {
        $inputs = Input::all();
        $rules = [];

        $new = $this->doCreate($inputs, $rules);

        //if create function return 1 - Success, !1 - Not Success
        if($new['status'] == 1) {
            //redirect to the url you wan along with the message
            return Redirect::to('/crm/feature/'.$inputs['feature_id'])
                ->withMessage(Generate::message('SUCCESS', $new['message']));
        }

        //redirect to the proper handling url along with the message
        return Redirect::to('/crm/feature/'.$inputs['feature_id'])
            ->withMessage(Generate::message('FAILED', $new['message']));
    }

    public function updateEntry($fid,$pid)
    {
        $inputs = Input::all();
        $rules = [
            'feature_id'=>'required',
            'name'=>'required',
            'module'=>'required',
            'position'=>'required',
            'url'=>'required',
            'page'=>'required',
            'prompt_type'=>'required'
        ];

        $updated = $this->doUpdate($pid, $inputs, $rules);

        //if create function return 1 - Success, !1 - Not Success
        if($updated['status'] == 1) {
            //redirect to the url you wan along with the message
            return Redirect::to('/crm/feature/'.$fid)
                ->withMessage(Generate::message('SUCCESS', $updated['message']));
        }

        //redirect to the proper handling url along with the message
        return Redirect::to('/crm/feature/'.$fid)
            ->withMessage(Generate::message('FAILED', $updated['message']));
    }

    public function deleteEntry($fid ,$pid)
    {
        $rules = ['id'=>'required|integer'];
        $inputs = ['id'=>$pid];

        $deleted = $this->doDelete($pid, $inputs, $rules);

        if($deleted['status'] == 1) {
            return Redirect::to('/crm/feature/'.$fid)
                ->withMessage(Generate::message('SUCCESS', $deleted['message']));
        }

        return Redirect::to('/crm/feature/'.$fid)
            ->withMessage(Generate::message('FAILED', $deleted['message']));

    }




    # Static Functions ---------------------------------------------------------------------------------------------->

    public static  function actionSchema()
    {
        $permissions = [];
        $action_schemas = [];
        $permissions = Feature::getPermissionsByModule('role', 'table');
        $panel_permissions = Feature::getPermissionsByModule('role', 'panel');
        $user_table_permissions = Feature::getPermissionsByModule('role', 'user_table');

        foreach ($permissions as $permission)
        {
            $action_schemas ['table'][] = ActionSchema::action($permission);
        }
        foreach ($panel_permissions as $panel_permission)
        {
            $action_schemas ['panel'][] = ActionSchema::action($panel_permission);
        }
        foreach ($user_table_permissions as $user_table_permission)
        {
            $action_schemas ['user_table'][] = ActionSchema::action($user_table_permission);
        }

        return $action_schemas;
    }


    # get current all the variation in the position column
    public static function getAllCurrentPosition()
    {
        $positions = [];

        $positions = Permission::whereNull('deleted_at')->select('position')->groupBy('position')->get();
        return $positions;
    }

    # get current all the variation in the page column
    public static function getAllCurrentPages()
    {
        $pages = [];
        $pages = Permission::whereNull('deleted_at')->select('page')->groupBy('page')->get();
        return $pages;
    }

    # get current all the variation in the prompt type column
    public static function getAllCurrentPromptTypes()
    {
        $types = [];
        $types = Permission::whereNull('deleted_at')->select('prompt_type')->groupBy('prompt_type')->get();
        return $types;
    }
}
