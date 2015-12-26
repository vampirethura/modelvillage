<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureRole extends Model
{
  protected $table = 'feature_role'; //manual assign the table this model is associated with. usually no need if the model name is the singular of the table name.
  //protected $fillable = [];
  protected $guarded = ['id']; //this is another way of protecting mass assignment, other than column u specify here, all will be able to mass assigned
}
