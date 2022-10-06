<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobileotp extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mobileotps';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_on','updated_on','mobile','otp'];

    /**
     * Attributes that should be vissible.
     *
     * @var array
     */

    protected $hidden = ['created_on','updated_on'];

    public function customer()
    {
        return $this->belongsTo('App\Customer','mobile','mobile');
    }
}
