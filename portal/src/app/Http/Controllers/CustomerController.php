<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Auth;
use App\Customer;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_type_id == 1) {
            $customers = Customer::whereNotNull('customer_code')->orderBy('id', 'desc')->Paginate();
            return view('customers.index', ['customers' => $customers, 'q' => '']);
        } else {
            return redirect()
                    ->route('home');
        }
    }

    /**
     * Search the specified resource.
     *
     * @param  string  $q
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $q = $request->q;
        if (!empty($request->q)) {
            $customers = Customer::orderBy('id', 'desc')->where('name', 'LIKE', "%$q%")->Paginate();
        } else {
            $customers = Customer::orderBy('id', 'desc')->Paginate();
        }
        return view('customers.index', ['customers' => $customers, 'q' => $q ]);
    }
}
