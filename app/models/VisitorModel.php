<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class VisitorModel extends Model
{
    public $timestamps = false;
    protected $table = 'visitor';
    protected $guarded = ['id'];
}
