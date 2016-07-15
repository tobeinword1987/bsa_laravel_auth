<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 */
class User extends Model
{
    protected $fillable = ['firstname','lastname', 'email'];


    public function book()
    {
        return $this->hasMany('App\Book');
    }
}
