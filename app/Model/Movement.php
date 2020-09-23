<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{

  protected $table = 'movement';

  protected $fillable = [
    'id',
    'amount',
    'current_account_id'
  ];
}
