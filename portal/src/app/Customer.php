<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','mobile','password','api_token','otp','status'];

    /**
     * Attributes that should be vissible.
     *
     * @var array
     */

	protected $hidden = ['created_on','updated_on','updated_by','password','username'];
}
