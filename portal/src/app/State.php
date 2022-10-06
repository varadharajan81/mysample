<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class State extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'state';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_on','updated_on','name','status'];

    /**
     * Attributes that should be vissible.
     *
     * @var array
     */

    protected $hidden = ['created_on','updated_on'];
    public function states()
    {
        return $this->hasMany('App\State');
    }

    public function banks()
    {
        return $this->hasMany('App\Bank');
    }

    public function user_address()
    {
        return $this->hasMany('App\UserAddress');
    }
}
