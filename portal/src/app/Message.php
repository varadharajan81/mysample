<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_on','updated_on', 'mobile', 'otp', 'message'];

    /**
     * Attributes that should not be vissible.
     *
     * @var array
     */

    protected $hidden = ['created_on','updated_on'];

    /**
     * Send SMS through API.
     */
    public function sendMessage($number, $message)
    {
        $id = "me@gmail.com";
        $pwd = "team@1234";

        $mesasge = urlencode($message);
        $send_message = true;

        if ($send_message == true) {
            if (!empty(trim($number)) &&  !empty(trim($message))) {
                $query_string = 'ID=' . urlencode($id) . '&Pwd='. urlencode($pwd) .'&PhNo=' . urlencode($number) . '&Text=' . urlencode($message);

                $url = "https://www.businesssms.co.in/SMS.aspx/?" . $query_string;

                // Get cURL resource
                $curl = curl_init();
                // Set some options - we are passing in a useragent too here
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                ));
                // Send the request & save response to $resp
                $resp = curl_exec($curl);
                // Close request to clear up some resources
                curl_close($curl);
            }
            return $resp;
        }
    }
}
