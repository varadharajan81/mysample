<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
	/**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table = "staff";

	/**
     * Get the user types that owns the user.
     */
    public function bank() {
			return $this->belongsTo('App\Bank');
    }
}
