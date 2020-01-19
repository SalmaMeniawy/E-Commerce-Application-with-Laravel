<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
class Category extends Model
{
    protected $fillable = ['category_name','admin_id'];
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
