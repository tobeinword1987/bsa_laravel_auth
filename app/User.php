<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 */
class User  extends Authenticatable
//    Model
{
    protected $fillable = ['firstname','lastname', 'email','password', 'role'];

    protected $hidden = [
        'remember_token',
    ];


    public function book()
    {
        return $this->hasMany('App\Book');
    }
}
