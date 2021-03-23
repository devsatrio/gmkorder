<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AdminLogModel extends Model
{
    public $timestamps = false;
    protected $table = 'log_admin';
    protected $guarded = ['id'];
}
