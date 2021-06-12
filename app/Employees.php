<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
  public $incrementing = false;
  protected $table = 'employees';

  public function companies(){
    //foreign key in employees table are name as company -
    //which get from companies
    return $this->belongsTo(Companies::class,'company');
  }
}
