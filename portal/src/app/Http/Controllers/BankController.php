<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Auth;
use App\Bank;
use App\State;
use App\District;

class BankController extends Controller
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
            $banks = Bank::orderBy('id', 'desc')->with(['state'])->paginate();
            return view('banks.index', ['banks' => $banks, 'q' => '']);
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
            $banks = Bank::orderBy('id', 'desc')->where('name', 'LIKE', "%$q%")->Paginate();
        } else {
            $banks = Bank::orderBy('id', 'desc')->Paginate();
        }

        return view('banks.index', ['banks' => $banks, 'q' => $q ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->user_type_id == 1) {
            return view('banks.create');
        } else {
            return redirect()
                    ->route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // setting up custom error messages for the field validation
        $validator = Validator::make(
            $request->all(),
            [
            'name' => 'required|unique:bank|max:255',
            ],
            []
        );

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($validator->errors());
        } else {
            $bank = new Bank;
            $bank->name = $request->name;
            $bank->short_name = $request->short_name;
            $bank->status = ($request->status) ? 1 : 0;

            if ($bank->save()) {
                return redirect()
                        ->route('banks.index')
                        ->with('message', 'created');
            } else {
                return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($validator->errors());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $bank = Bank::findOrFail($id);
        return view('banks.show', ['bank' => $bank]);
    }
}
