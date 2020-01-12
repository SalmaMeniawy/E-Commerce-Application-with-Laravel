<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Admin;
use App\Seller;
use App\Buyer;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
    ];
    /**
    * eloquent relationship with admin model    
    */
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    /**
    * eloquent relationship with Seller model    
    */
    public function seller(){
        return $this->belongsTo(Seller::class);
    }
    /**
     * eloquent relationship with Buyer model 
     */
    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
