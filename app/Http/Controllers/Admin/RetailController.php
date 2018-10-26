<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use DB;
use Excel;
use App\Retail;
use App\Role;

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
          
        if ($request->isMethod('get')) { 
            $data=Retail::join('role_user','retail_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')        
                ->join('clinic_details','retail_details.id','=','retail_details.clinic_id')    
                ->join('users','retail_details.user_id','=','users.id')
                ->select('*')->get();
        }

        //needs to do search query 
        if ($request->isMethod('post')) {
             $query=[];
          
            if (isset($request->business_name) && !empty($request->business_name)) {
                            
                $query[]=['clinic_details.clinic_name', 'like','%' . $request->business_name. '%'];                    
            }
            
            if (isset($request->business_telephone_number) && !empty($request->business_telephone_number)) {               
                
                $query[]=['clinic_details.telephone_number', 'like','%'. $request->business_telephone_number.'%'];                
            }

            if (isset($request->website) && !empty($request->website)) {                
                 $query[]=['clinic_details.clinic_website', 'like','%'. $request->website.'%'];
            }
           
            if (isset($request->first_name) && !empty($request->first_name)) {                
               $query[]=['retail_details.first_name', 'like','%'. $request->first_name.'%'];                
            }

            if (isset($request->position) && !empty($request->position)) {                
                $query[]=['retail_details.position', 'like','%'. $request->position.'%'];
            }

            if (isset($request->last_name) && !empty($request->last_name)) {
                $query[]=['retail_details.last_name', 'like','%'. $request->last_name.'%'];
            }

            if (isset($request->email) && !empty($request->email)) {
                 $query[]=['retail_details.email', 'like','%'. $request->email.'%'];
            }

            
            if (isset($request->pstatus) && !empty($request->pstatus)) {                
                $query[]=['roles.id', '=',$request->pstatus];                
            }
            
            if (isset($request->status) && !empty($request->status)) {                
                $query[]=['retail_details.status', '=',$request->status];
            }


            if(isset($query) && !empty($query)){

            $d = Retail::join('clinic_details','retail_details.clinic_id','=','clinic_details.id')
            ->join('role_user','retail_details.user_id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->join('users','retail_details.user_id','=','users.id')
            ->where($query);
             if (isset($request->create_date) && !empty($request->create_date)) {                                
                $d->whereDate('retail_details.created_date', '=', date("Y-m-d", strtotime($request->create_date)) );                
            }

            $data = $d->select('retail_details.id','retail_details.clinic_id','retail_details.first_name','retail_details.last_name','retail_details.position','roles.label','retail_details.email','clinic_details.clinic_name','clinic_details.clinic_location','clinic_details.trading_name','clinic_details.telephone_number','clinic_details.clinic_website','clinic_details.clinic_status','users.id as user_id')->get();
        }
     }


        $all_roles=Role::all();    
        return view('admin.retail',compact('data','request','all_roles'));
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

    public function clinicactivedeactive($id,$status){
       
        DB::table('clinic_details')
        ->where("clinic_details.id", '=',  $id)
        ->update(['clinic_details.status'=> $status]);

        return redirect('/retail');
    }



}
