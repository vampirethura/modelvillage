<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SysConfig extends Model
{
    protected $table = 'sys_configs'; //manual assign the table this model is associated with. usually no need if the model name is the singular of the table name.
    use SoftDeletes; //enabled the softdelete, meaning record wont be deleted instead 'delete_at' timestamp will be set.
    protected $dates = ['deleted_at'];
    protected $module = 'sysconfig';
    protected $guarded = ['id']; //this is another way of protecting mass assignment, other than column u specify here, all will be able to mass assigned
    #protected $fillable = []; // u can mass assign columns that is specified here.


    # Relationship -------------------------------------------------------------------------------------------------->
    # ---------------
    # One-to-One # hasOne(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)


    # ---------------
    # One-to-Many # hasMany(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)


    # ---------------
    # Many-to-Many #belongsToMany(Model, pivot_table, associated_key1, associated_key2)





    # Functions ----------------------------------------------------------------------------------------------------->
    // get system config by its type v2
  	public static function getSystemConfig($type)
  	{
  		return SysConfig::whereNull('deleted_at')
  					->where('type', $type)
  					->get();
  	}
}
