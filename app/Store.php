<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
class Store extends Model
{
    protected $fillable = ['store_name' , 'sammary','admin_id'];
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
