<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
  protected $table = 'posts'; //manual assign the table this model is associated with. usually no need if the model name is the singular of the table name.
  use SoftDeletes; //enabled the softdelete, meaning record wont be deleted instead 'delete_at' timestamp will be set.
  protected $dates = ['deleted_at'];
  protected $guarded = ['id']; //this is another way of protecting mass assignment, other than column u specify here, all will be able to mass assigned
  // protected $fillable = []; // u can mass assign columns that is specified here.

  public function likes(){
    return $this->belongsToMany('App\Customer', 'post_likes', 'post_id', 'customer_id');
  }

  # ---------------
  # One-to-Many # hasMany(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)
  public function comments(){
    return $this->hasMany('App\Comment', 'post_id', 'id');
  }

  # Relationship -------------------------------------------------------------------------------------------------->
  # ---------------
  # One-to-One # hasOne(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)
  public function customer(){
    return $this->belongsTo('App\Customer', 'customer_id', 'id');
  }
}
