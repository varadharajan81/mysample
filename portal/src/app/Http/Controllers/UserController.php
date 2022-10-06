<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Validator;

use Auth;
use Hash;
use App\Http\Requests;
use App\UserModel as User;
use App\Bank;
use App\CreditManager;
use App\LoanApplication;
use App\Loan;
use App\LoanApplicationDetail;

class UserController extends Controller
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
            $users = User::where(['status' => 1])->with('user_types')->orderBy('id', 'desc')->Paginate();
            return view('users.index', ['users' => $users]);
        } else {
            return redirect()
                    ->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->user_type_id == 1) {
            return view('users.create');
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
            'name' => 'required|max:255',
            'user_type_id' => 'required',
            'mobile' => 'required|numeric|unique:users',
            'password' => 'required|min:6'
        ],
            []
        );

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($validator->errors());
        } else {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->mobile .'@quixange.com';
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->user_type_id = 1;
            $user->api_token = '';
            $user->otp = '';
            $user->bank_id = 0;
            $user->status = ($request->status) ? 1 : 0;

            if ($user->save()) {
                return redirect()
                        ->route('users.index')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->user_type_id == 1) {
            $user = User::findOrFail($id);
            return view('users.edit', compact('user'));
        } else {
            return redirect()
                    ->route('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make(
            $request->all(),
            [
            'name' => 'required|max:255',
            'mobile' => 'required',
        ],
            []
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->user_type_id = 1;
            $user->bank_id = 0;
            $user->status = ($request->status) ? 1 : 0;
            if ($user->save()) {
                return redirect()
                                ->route('users.index')
                                ->with('message', 'updated');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = User::findOrFail($id);
        if (User::destroy($id)) {
            return redirect()
                        ->route('users.index')
                        ->with('message', 'deleted');
        }
    }

    public function userAdd()
    {
        return response(array('status' => "200",'error' => false));
    }

    public function dashboard()
    {
        if (Auth::user()->user_type_id == 1):
            $user_count = User::where(['user_type_id' => 4])->count();
            $agent_count = User::where(['user_type_id' => 3])->count();
            $bank_count = Bank::where(['status' => 1])->count();
        else:
            $bank = Auth::user()->bank_id;
            $user_count = User::where(['user_type_id' => 4, 'bank_id' => $bank])->count();
            $agent_count = User::where(['user_type_id' => 3, 'bank_id' => $bank])->count();
            $bank_count = Bank::where(['status' => 1, 'id' => $bank])->count();
        endif;

        return view('users.dashboard', compact('user', 'user_count', 'bank_count'));
    }
}
