<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsModel extends Model
{
    protected $fillable = [
        'template_name',
        'message',
        'created By',
  ];
}
