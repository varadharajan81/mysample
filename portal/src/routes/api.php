<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/customer', function (Request $request) {
    return $request->customer();
});

Route::group(['prefix' => 'version/mar20/'], function () {
    Route::get('/', function () {
        echo "Mycomp - MySample";//
    });

    Route::group(['prefix' => 'pages/'], function () {
      Route::get('terms', function () {
          return view('terms');
      });

      Route::get('about', function () {
          return view('about');
      });

      Route::get('privacy', function () {
          return view('privacy');
      });

      Route::get('disclaimer', function () {
          return view('disclaimer');
      });

      Route::get('contactus', function () {
          return view('contactus');
      });
    });

    Route::post('get-profile', function (Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'profile_code' => 'required|numeric',
                'access_code' => 'required|alpha_num|min:25',
                'mobile' => 'required|max:9999999999',
            ]
        );

        if ($validator->fails()) {
            return Response::json([
                'domain' => Config::get('app.domain'),
                'status' => 400,
                'error' => true,
                'message' => "Missing params"
            ], 400);
        } else {
            $customer_code = $request->profile_code;
            $access_code = $request->access_code;
            $is_valid_customer = is_customer($customer_code,$access_code);
            if ($is_valid_customer) {
                $customer = App\Customer::where(['id' => $is_valid_customer, 'customer_code' => $customer_code, 'status' => 1])->orderBy('id', 'desc')->get(['customer_code AS profile_code', 'name', 'surname', 'title', 'email','mobile','mobile_alternate','dob'])->first();
                return Response::json([
                    'domain' => Config::get('app.domain'),
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success',
                    'customer' => $customer,
                ], 200);
            } else {
              return Response::json([
                  'domain' => Config::get('app.domain'),
                  'status' => 201,
                  'error' => true,
                  'message' => 'Invalid customer',
              ], 201);
            }
        }
    });

    Route::post('change-password', function (Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'mobile' => 'required|numeric|max:9999999999',
                'old_password' => 'required|min:6|max:8',
                'new_password' => 'required|min:6|max:8',
                'access_code' => 'required|min:25',
                'profile_code' => 'required|max:18',
            ]
        );
        if ($validator->fails()) {
            return Response::json([
                'domain' => Config::get('app.domain'),
                'status' => 400,
                'error' => true,
                'message' => "Missing params"
            ], 400);
        } else {
            $mobile = $request->mobile;
            $customer_code = $request->profile_code;
            $password = $request->old_password;
            $token = $request->access_code;
            $customer = App\Customer::where(['mobile' => $mobile, 'status' => 1, 'is_verified' => 1, 'is_deleted' => 0,'customer_code' => $customer_code])->orderBy('id', 'desc')->get(['mobile', 'api_token','password'])->first();
            if (isset($customer->mobile)) {
                //if (Hash::check($customer->password, $hashedPassword) && Hash::check($customer->api_token, $tokenhashed)) {
                if (Hash::check($password, $customer->password) && Hash::check($token, $customer->api_token)) {
                    $passwordhashed = Hash::make($request->new_password);
                    $updated = App\Customer::where(['mobile' => $mobile, 'customer_code' => $customer_code, 'is_verified' => 1])->update(['updated_on' => date('Y-m-d H:i:s'), 'password' => $passwordhashed, 'api_token' => 'deny']);
                    if ($updated) {
                        return Response::json([
                            'domain' => Config::get('app.domain'),
                            'status' => 200,
                            'error' => false,
                            'message' => 'Password updated'
                        ], 200);
                    } else {
                        return Response::json([
                            'domain' => Config::get('app.domain'),
                            'status' => 201,
                            'error' => true,
                            'message' => 'Please try again'
                        ], 201);
                    }
                }else{
                    return Response::json([
                        'domain' => Config::get('app.domain'),
                        'status' => 201,
                        'error' => true,
                        'message' => 'Invalid credentials'
                    ], 201);
                }
            }else{
                return Response::json([
                    'domain' => Config::get('app.domain'),
                    'status' => 201,
                    'error' => true,
                    'message' => 'Invalid customer'
                ], 201);
            }
        }
    });

    Route::post('signin', function (Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|max:255',
                'password' => 'required|min:6|max:8'
            ]
        );

        if ($validator->fails()) {
            return Response::json([
                'domain' => Config::get('app.domain'),
                'status' => 400,
                'error' => true,
                'message' => "Enter valid credentials"
            ], 400);
        } else {
            $username = $request->username;
            $password = $request->password;
            //$password = Hash::make($request->password);
            $customer = App\Customer::where('is_deleted', '!=', 1)
            ->where(function($user) use ($username) {
                $user->where('email', $username)
                  ->orWhere('mobile', $username);
            })->orderBy('id', 'desc')->get(['status','is_deleted','is_verified','mobile','password','customer_code'])->first();

            if (isset($customer->mobile)) {
                $hashedPassword = $customer->password;
                if (Hash::check($password, $hashedPassword)) {
                    if ($customer->status == 1 && $customer->is_verified == 1) {
                        $customer_otp = new App\Mobileotp;
                        $customer_otp->mobile = $customer->mobile;
                        $customer_otp->otp = 123456;
                        $customer_otp->message = 'Login';
                        if ($customer_otp->save()) {
                            $customer_otp->profile_code = $customer->customer_code;
                            unset($customer_otp->id,$customer_otp->otp,$customer_otp->message);
                            return Response::json([
                                'domain' => Config::get('app.domain'),
                                'status' => 200,
                                'error' => false,
                                'message'=> 'Login Success',
                                'customer' => $customer_otp
                            ], 200);
                        }else {
                            return Response::json([
                                'domain' => Config::get('app.domain'),
                                'status' => 201,
                                'error' => true,
                                'message' => 'Please try again'
                            ], 201);
                        }
                    }else {
                      unset($customer->status, $customer->is_verified,$customer->password,$customer->is_deleted,$customer->customer_code);
                      return Response::json([
                          'domain' => Config::get('app.domain'),
                          'status' => 202,
                          'error' => true,
                          'message' => 'Not verified',
                          'customer' => $customer
                      ], 202);
                    }
                }else {
                    return Response::json([
                        'domain' => Config::get('app.domain'),
                        'status' => 201,
                        'error' => true,
                        'message' => 'Invalid credentials'
                    ], 201);
                }
            } else {
              return Response::json([
                  'domain' => Config::get('app.domain'),
                  'status' => 201,
                  'error' => true,
                  'message' => 'Invalid credentials'
              ], 201);
            }
        }
    });

    Route::post('get-address', function (Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'profile_code' => 'required|numeric',
                'access_code' => 'required|alpha_num',
            ]
        );

        if ($validator->fails()) {
            return Response::json([
                'domain' => Config::get('app.domain'),
                'status' => 400,
                'error' => true,
                'message' => "Missing params"
            ], 400);
        } else {
            $customer_code = $request->profile_code;
            $access_code = $request->access_code;
            $is_valid_customer = is_customer($customer_code,$access_code);
            if ($is_valid_customer) {
                $perm_address = App\CustomerAddress::where(['customer_id' => $is_valid_customer, 'address_type' => 1, 'status' => 1])->orderBy('id', 'desc')->first();
                if($perm_address){
                    $perm_address->makeHidden(['id','customer_id']);
                }
                $comm_address = App\CustomerAddress::where(['customer_id' => $is_valid_customer, 'address_type' => 2, 'status' => 1])->orderBy('id', 'desc')->first();
                if($comm_address){
                    $comm_address->makeHidden(['id','customer_id']);
                }
                return Response::json([
                    'domain' => Config::get('app.domain'),
                    'status' => 200,
                    'error' => false,
                    'message' => 'Address updated',
                    'permenant_address' => $perm_address,
                    'communication_address' => $comm_address
                ], 200);
            } else {
              return Response::json([
                  'domain' => Config::get('app.domain'),
                  'status' => 201,
                  'error' => true,
                  'message' => 'Invalid customer',
              ], 201);
            }
        }
    });

    Route::post('signout', function (Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'profile_code' => 'required|max:18',
                'access_code' => 'required|min:25'
            ]
        );

        if ($validator->fails()) {
            return Response::json([
                'domain' => Config::get('app.domain'),
                'status' => 400,
                'error' => true,
                'message' => "Missing params"
            ], 400);
        } else {
            $access_code = $request->access_code;
            $customer_code = $request->profile_code;
            $is_valid_customer = is_customer($customer_code,$access_code);
            if ($is_valid_customer) {
                App\Customer::where(['customer_code' => $customer_code, 'is_verified' => 1])->update(['api_token' => 'deny']);
                return Response::json([
                    'domain' => Config::get('app.domain'),
                    'status' => 200,
                    'error' => false,
                    'message' => 'Successfully signed out',
                ], 200);
            }else {
                return Response::json([
                    'domain' => Config::get('app.domain'),
                    'status' => 201,
                    'error' => true,
                    'message' => 'Invalid request'
                ], 201);
            }
        }
    });
});
