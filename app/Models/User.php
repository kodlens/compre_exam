<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable 
{
    //implements MustVerifyEmail
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    
    //protected $guard = 'admin';

    // protected $table = 'users';
    // protected $primaryKey = 'user_id'; //the fuck.. nahurot akong adlaw nimo ..

    // protected $fillable = [
    //     'username', 'lname', 'fname', 'mname', 'sex',
    //     'status',
    //     'bdate',
    //     'birthplace', 'contact_no',
    //     'email',
    //     'first_program_choice', 'second_program_choice',
    //     'learning_mode',
    //     'last-school_attended',
    //     'province', 'city', 'barangay', 'barangay_id', 'street',
    //     'password', 'role'
    // ];

    protected $connection = 'registrar_gadtc';
    protected $table ='tblstudhinfo';
    protected $primaryKey = 'StudID';


    public $incrementing = false; //if primary key is non-numeric
    // If you wish to use a non-incrementing or a non-numeric primary key 
    // you must define a public $incrementing property 
    // on your model that is set to false:
    

    protected $keyType = 'string'; 
    //If your model's primary key is not an integer, 
    //you should define a protected $keyType property on your model. 
    //This property should have a value of string:

    protected $fillable = [
        'StudID', 'username', 'StudLname', 'StudFname', 'StudMname', 'StudSex', 'email', 'password'
   ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
