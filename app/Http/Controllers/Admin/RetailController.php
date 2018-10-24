<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use DB;
use Excel;
use App\Retail;

class RetailController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
         $data=Retail::join('role_user','retail_details.user_id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')        
            ->join('clinic_details','retail_details.id','=','retail_details.clinic_id')    
            ->join('users','retail_details.user_id','=','users.id')
            ->select('*')->get();

        return view('admin.retail',compact('data'));
    }

    public function retailadd()
    {
        return view('admin.retailadd');
    }

    
    public function retailstore(Request $request)
    {   

        if( !empty( $request->id ) ) { 

            $validatedData = $request->validate([
                'first_name'     => 'required',
                'last_name'      => 'required',
                'dob'            => 'required',
                'gender'         => 'required',            
                // 'email'          => 'required|email',
                'signup_source'  => 'required',
                'created_date'   => 'required|date',
                'created_by'     => 'required',
                'skin_concerns'  => 'required',
                'skin_type'      => 'required',          
            ],[
                'first_name.required'    => 'First Name is required',
                'last_name.required'     => 'Last Name is required',
                'dob.required'           => 'Date of Birth is required',
                'gender.required'        => 'Gender is required',
                'email.required'         => 'Email is required',
                'signup_source.required' => 'Sign-up is required',
                'created_date.required'  => 'Registered Date is required',
                'created_by.required'    => 'Registered By is required',
                'skin_concerns.required' => 'Most Recent Skin Concern is required',
                'skin_type.required'     => 'Most Recent Skin Type is required'
            ]);

            $retail = retail::find($request->id);
            $retail->first_name       = $request->first_name;
            $retail->last_name        = $request->last_name;
            $retail->dob              = date('Y-m-d', strtotime($request->dob));
            $retail->gender           = $request->gender;
            $retail->email            = $request->email;
            $retail->signup_source    = $request->signup_source;
            $retail->created_date     = date('Y-m-d', strtotime($request->created_date));
            $retail->skin_concerns    = $request->skin_concerns;
            $retail->skin_type        = $request->skin_type;
            $retail->created_by       = \Auth::user()->id;
            $retail->modified_by      = \Auth::user()->id;
            $retail->save();
            setflashmsg('retail Details Updated Successfully','1');
        }else{

            $validatedData = $request->validate([
                'first_name'     => 'required',
                'last_name'      => 'required',
                'dob'            => 'required',
                'gender'         => 'required',            
                'email'          => 'required|email|max:255|unique:client_details',
                'signup_source'  => 'required',
                'created_date'   => 'required|date',
                'created_by'     => 'required',
                'skin_concerns'  => 'required',
                'skin_type'      => 'required',          
            ],[
                'first_name.required'   => 'First Name is required',
                'last_name.required'    => 'Last Name is required',
                'dob.required'          => 'Date of Birth is required',
                'gender.required'       => 'Gender is required',
                'email.required'        => 'Email is required',
                'signup_source.required'=> 'Sign-up is required',
                'created_date.required' => 'Registered Date is required',
                'created_by.required'   => 'Registered By is required',
                'skin_concerns.required' => 'Most Recent Skin Concern is required',
                'skin_type.required' => 'Most Recent Skin Type is required'
            ]);
            $retail = retail::create([                
                'first_name'     => request('first_name'),
                'last_name'      => request('last_name'),
                'dob'            => date( 'Y-m-d', strtotime(request('dob'))),
                'gender'         => request('gender'),
                'email'          => request('email'),
                'signup_source'  => request('signup_source'),
                'created_date'   => date('Y-m-d', strtotime(request('created_date'))),
                'created_by'     => \Auth::user()->id,            
                'skin_concerns'  => request('skin_concerns'),
                'skin_type'      => request('skin_type'),            
                'modified_by'    => \Auth::user()->id,
            ]);

            setflashmsg('retail Added Successfully','1');
        }

        return redirect('/retails');
    }

     public function retailedit($id)
    {        
        $retail = retail::where('id', $id)->first();                
        return view('admin.retailadd',compact('retail'));
    }

    public function retailactivedeactive($id,$status){

        DB::table('client_details')
        ->where("client_details.id", '=',  $id)
        ->update(['client_details.status'=> $status]);

        return redirect('/retails');
    }



}
