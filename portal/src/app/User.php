<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile' , 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_on','updated_on', 'password', 'remember_token', 'otp', 'api_token', 'status'
    ];

    public function user_address()
    {
        return $this->hasOne('App\UserAddress');
    }

    public function loanapplications()
    {
        return $this->hasMany('App\LoanApplication');
    }

    public function divider($number_of_digits)
    {
        $tens="1";
        if ($number_of_digits>8) {
            return 10000000;
        }

        while (($number_of_digits-1)>0) {
            $tens.="0";
            $number_of_digits--;
        }
        return $tens;
    }

    public function convnumber($num)
    {
        // $num = 108340990000.00;
        $ext="";//thousand,lac, crore
        $number_of_digits = strlen($num);
        if ($number_of_digits>3) {
            if ($number_of_digits%2!=0) {
                $divider = $this->divider($number_of_digits-1);
            } else {
                $divider = $this->divider($number_of_digits);
            }
        } else {
            $divider = 1;
        }
        $fraction = $num/$divider;
        $fraction = number_format($fraction, 2);
        if ($number_of_digits == 4 || $number_of_digits == 5) {
            $ext = "k";
        }
        if ($number_of_digits == 6 || $number_of_digits == 7) {
            $ext = "Lac";
        }
        if ($number_of_digits == 8 || $number_of_digits == 9) {
            $ext = "Cr";
        }
        if ($number_of_digits >= 10 && $number_of_digits <= 20) {
            $ext = "Cr";
        }
        return $fraction." ".$ext;
    }
}
