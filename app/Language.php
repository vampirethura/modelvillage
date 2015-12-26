<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Language extends Model
{
    protected $table = 'languages'; //manual assign the table this model is associated with. usually no need if the model name is the singular of the table name.
    use SoftDeletes; //enabled the softdelete, meaning record wont be deleted instead 'delete_at' timestamp will be set.
    protected $dates = ['deleted_at'];
    #protected guarded = []; //this is another way of protecting mass assignment, other than column u specify here, all will be able to mass assigned
    protected $fillable = []; // u can mass assign columns that is specified here.


    # Relationship -------------------------------------------------------------------------------------------------->
    # ---------------
    # One-to-One # hasOne(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)


    # ---------------
    # One-to-Many # hasMany(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)


    # ---------------
    # Many-to-Many #belongsToMany(Model, pivot_table, associated_key1, associated_key2)




    # Functions ----------------------------------------------------------------------------------------------------->






    # Static Functions ---------------------------------------------------------------------------------------------->


}
