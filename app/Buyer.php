<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $fillable = ['fname','lname','date_of_birth' ,'user_id'];
}
