<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
  protected $table = 'customers'; //manual assign the table this model is associated with. usually no need if the model name is the singular of the table name.
  use SoftDeletes; //enabled the softdelete, meaning record wont be deleted instead 'delete_at' timestamp will be set.
  protected $dates = ['deleted_at'];
  protected $guarded = ['id']; //this is another way of protecting mass assignment, other than column u specify here, all will be able to mass assigned
  // protected $fillable = []; // u can mass assign columns that is specified here.
}
