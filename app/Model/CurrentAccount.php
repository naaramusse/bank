<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CurrentAccount extends Model
{
  protected $table = 'current_accounts';

  protected $fillable = [
    'id',
    'branch',
    'account'
  ];
}
