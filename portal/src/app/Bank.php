<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bank';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_on','updated_on','name','short_name','status'];

    /**
     * Attributes that should be vissible.
     *
     * @var array
     */

    protected $hidden = ['created_on','updated_on'];

    /**
     * Get the agent record associated with bank.
     */
    public function creditmanagers()
    {
        return $this->hasMany('App\CreditManager');
    }

    public function staff()
    {
        return $this->hasMany('App\Staff');
    }

    public function bank_branches()
    {
        return $this->hasMany('App\BankBranch');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
