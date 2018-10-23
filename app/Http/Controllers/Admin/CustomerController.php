<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use DB;
use App\Customer;
use App\User;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Customer::all();

        $data=Customer::join('users','client_details.registered_by','=','users.id')
                ->select('client_details.*', 'users.id as userid','users.name')->get();
        return view('admin.customers',compact('data'));
    }

    public function customeradd()
    {
         $user_admin_retailer = User::select('id as userid','name')->whereIn('user_type',array(0,2))->get();
       
        return view('admin.customeradd',compact('user_admin_retailer'));
    }

    public function customeredit($id)
    {        
        $customer = Customer::where('id', $id)->first();                
        $user_admin_retailer = User::select('id as userid','name')->whereIn('user_type',array(0,2))->get();
        return view('admin.customeradd',compact('customer','user_admin_retailer'));
    }

    public function customeractivedeactive($id,$status){
        
        DB::table('client_details')
        ->where("client_details.id", '=',  $id)
        ->update(['client_details.status'=> $status]);

         return redirect('/customers');
    }

    
    public function customerstore(Request $request)
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
                // 'email.required'         => 'Email is required',
                'signup_source.required' => 'Sign-up is required',
                'created_date.required'  => 'Registered Date is required',
                'created_by.required'    => 'Registered By is required',
                'skin_concerns.required' => 'Most Recent Skin Concern is required',
                'skin_type.required'     => 'Most Recent Skin Type is required'
            ]);

            $customer = Customer::find($request->id);
            $customer->first_name               = $request->first_name;
            $customer->last_name                = $request->last_name;
            $customer->dob                      = date('Y-m-d', strtotime($request->dob));
            $customer->gender                   = $request->gender;
            $customer->email                    = $request->email;
            $customer->signup_source            = $request->signup_source;
            $customer->created_date             = date('Y-m-d', strtotime($request->created_date));
            $customer->skin_concerns            = $request->skin_concerns;
            $customer->skin_type                = $request->skin_type;
            $customer->manual_skin_assessment   = $request->manual_skin_assessment == 1? '1':'0';
            $customer->registered_by            = $request->created_by;
            $customer->created_by               = \Auth::user()->id;
            $customer->modified_by              = \Auth::user()->id;            
            $customer->save();
            setflashmsg('Customer Details Updated Successfully','1');
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
                'skin_type.required'     => 'Most Recent Skin Type is required'
            ]);
            $customer = Customer::create([                
                'first_name'            => request('first_name'),
                'last_name'             => request('last_name'),
                'dob'                   => date( 'Y-m-d', strtotime(request('dob'))),
                'gender'                => request('gender'),
                'email'                 => request('email'),
                'signup_source'         => request('signup_source'),
                'created_date'          => date('Y-m-d', strtotime(request('created_date'))),
                'registered_by'         => request('created_by'),            
                'skin_concerns'         => request('skin_concerns'),
                'skin_type'             => request('skin_type'),   
                'manual_skin_assessment'=> request('manual_skin_assessment') == 1? '1':'0',
                'modified_by'           => \Auth::user()->id,
            ]);

            setflashmsg('Customer Added Successfully','1');
        }

        return redirect('/customers');
    }     
}