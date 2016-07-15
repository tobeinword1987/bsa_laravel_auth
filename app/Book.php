<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','author', 'year', 'genre'];
//$flight = App\Flight::create(['name' => 'Flight 10']);

    public function user()
    {
        return $this->hasOne('App\User');
    }

}
