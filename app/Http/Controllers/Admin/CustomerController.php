<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use DB;
use Excel;
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $data = Customer::all();

        if($request->export == 'yes')
        {
            $export = $data->map(function($value)
            {
                if($value->status==0)
                {
                    $status =  'Active';
                }
                else if($value->status==1)
                {
                    $status =  'Deactive' ;
                }

                return [
                    // 'Register Date'   =>  $value->date("d-m-Y", strtotime($value->created_date)),
                    'Name'            =>   $value->first_name,
                    'Email'           =>   isset($value->email) ? $value->email    : '',
                    'Age'             =>   isset($value->dob) ? $value->dob : '',
                    'Gender'          =>   isset($value->gender) ? $value->gender    : '',
                    'Status'          =>   $status,
                ];
            })->toArray();
            Excel::create('Customerlist', function($excel) use ($export) {
                $excel->sheet('Sheet1', function($sheet) use ($export) {
                    $sheet->fromArray($export);
                });
            })->download('xls');

            return redirect()->back();
        }

        return view('admin.customers',compact('data'));
    }

    public function customeradd()
    {
        return view('admin.customeradd');
    }

    public function customeredit($id)
    {        
        $customer = Customer::where('id', $id)->first();                
        return view('admin.customeradd',compact('customer'));
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
                'email.required'         => 'Email is required',
                'signup_source.required' => 'Sign-up is required',
                'created_date.required'  => 'Registered Date is required',
                'created_by.required'    => 'Registered By is required',
                'skin_concerns.required' => 'Most Recent Skin Concern is required',
                'skin_type.required'     => 'Most Recent Skin Type is required'
            ]);

            $customer = Customer::find($request->id);
            $customer->first_name       = $request->first_name;
            $customer->last_name        = $request->last_name;
            $customer->dob              = date('Y-m-d', strtotime($request->dob));
            $customer->gender           = $request->gender;
            $customer->email            = $request->email;
            $customer->signup_source    = $request->signup_source;
            $customer->created_date     = date('Y-m-d', strtotime($request->created_date));
            $customer->skin_concerns    = $request->skin_concerns;
            $customer->skin_type        = $request->skin_type;
            $customer->created_by       = \Auth::user()->id;
            $customer->modified_by      = \Auth::user()->id;
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
                'skin_type.required' => 'Most Recent Skin Type is required'
            ]);
            $customer = Customer::create([                
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

            setflashmsg('Customer Added Successfully','1');
        }

        return redirect('/customers');
    }



}
