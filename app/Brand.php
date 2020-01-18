<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
class Brand extends Model
{
    protected $fillable = ['brand_name','admin_id'];
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
