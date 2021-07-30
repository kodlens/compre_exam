<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{

    //implements MustVerifyEmail
    use HasFactory; //Notifiable;

    protected $connection = 'registrar_gadtc';
    protected $guard = 'student';

    protected $table = 'tblstudhinfo';

    protected $primaryKey = 'StudID';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $incrementing = false; //if primary key is non-numeric
    // If you wish to use a non-incrementing or a non-numeric primary key
    // you must define a public $incrementing property
    // on your model that is set to false:


    protected $keyType = 'string';
    //If your model's primary key is not an integer,
    //you should define a protected $keyType property on your model.
    //This property should have a value of string:


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
