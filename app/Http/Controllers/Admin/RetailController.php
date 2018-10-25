<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use DB;
use Hash;
use Excel;
use App\Retail;
use App\Clinic;
use App\Role;
use App\User;
use App\RoleUser;

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
            ->select('*')->toSql();

        return view('admin.retail',compact('data'));
    }

    public function retailadd()
    {
         if( Session::has('retail_site_id') ) {
            $retailsite = Clinic::find(Session::get('retail_site_id'));

            return view('admin.retailadd', compact('retailsite'));
        }

        return view('admin.retailadd');
    }

    
    public function retailsitestore(Request $request)
    {
        
        $validatedData = $request->validate([
            'clinic_name'               => 'required',
            'trading_name'              => 'required',
            'clinic_location'           => 'required',
            'telephone_number'          => 'required|numeric|digits_between:10,12',
            'clinic_email'              => 'required|email',
            'clinic_website'            => 'required|url',
        ]);

        // here check if id is present then update data
        if( !empty( $request->id ) ) {
            $clinic = Clinic::find($request->id);
            $clinic->clinic_name                 = $request->clinic_name;
            $clinic->trading_name                  = $request->trading_name;
            $clinic->clinic_location                       = $request->clinic_location;
            $clinic->telephone_number     = $request->telephone_number;
            $clinic->clinic_email                 = $request->clinic_email;
            $clinic->clinic_website                       = $request->clinic_website;
            $clinic->modified_by                   = \Auth::user()->id;
            $clinic->save();

            // 
            setflashmsg('Record Updated Successfully','1');
            // dd($request);
        } else {
            $clinic = Clinic::create([
                'clinic_name'                => request('clinic_name'),
                'trading_name'               => request('trading_name'),
                'clinic_location'            => request('clinic_location'),
                'telephone_number'           => request('telephone_number'),
                'clinic_email'               => request('clinic_email'),
                'clinic_website'             => request('clinic_website'),
                'status'                     => 0,
                'created_date'               => date('Y-m-d H:i:s'),
                'created_by'                 => \Auth::user()->id,
                'modified_by'                => \Auth::user()->id,
            ]);

            setflashmsg('Record Inserted Successfully','1');
        }

         if($clinic->exists) {
            // success
            Session::put('retail_site_id', $clinic->id);
            return redirect('/retail-user');
        }

    }

    public function retail_user_add()
    {
         if( !Session::has('retail_site_id') ) {

             return redirect('/retailadd');
        }

          $retail_admin = Retail::join('role_user','retail_details.user_id','=','role_user.user_id')
             ->join('roles','role_user.role_id','=','roles.id')
                ->where('retail_details.clinic_id', Session::get('retail_site_id'))
                ->where('roles.name', "retail_admin")
                ->select('retail_details.id','retail_details.first_name','retail_details.last_name')->get()->toArray();

        $retailsite = Clinic::find(Session::get('retail_site_id'));
         $roles = Role::where('user_type', 2)->where('status', 0)->get();
        return view('admin.retail-user',compact('roles','retailsite','retail_admin'));
    }
    public function retailuserstore(Request $request)
    {   

         if( $request->whattodo == 'new' ) {
            // if request is for new then reset session
            if( Session::has('retail_details_id') ) {
                Session::forget('retail_details_id');
            }
        }


        $retail = null;
        if( !empty( $request->id ) && $request->whattodo == 'update' ) {
    
       
    
            // check for validation
            $validatedData = $request->validate([
                'first_name'                => 'required',
                'last_name'                 => 'required',
                'telephone_number'       => 'required|numeric|digits_between:10,12',
                'clinic_location'   => 'required',
                'user_role'                 => 'required',
                'position'                  => 'required',
                'mobile_number'             => 'required|numeric|digits_between:10,12',
            ],[
                'clinic_location.required' => 'Business Address is Required'
            ]);

            
              if(isset($request->user_parent_id)){

                    
                    if ($request->user_role==6 && $request->user_selected_role==6) {
                
                       
                                # code...
                      setflashmsg('Please Select Different User and User Role ','2');
                        return redirect('/retail-user');

                    }else if($request->user_role==6){

                    setflashmsg('Please Select Different User and User Role ','2');
                    return redirect('/retail-user');

                    }else{

                        $user_parent_id=$request->user_parent_id;

                    }

                }else{

                    $user_parent_id=0;

                }

        
            $retail = Retail::find($request->id);
            $retail->user_parent_id            = $user_parent_id;
            $retail->first_name                = $request->first_name;
            $retail->last_name                 = $request->last_name;
            $retail->retail_name             = "";
            $retail->telephone_number       = $request->telephone_number;
            $retail->clinic_location   = $request->clinic_location;
            $retail->business_address_line_2   = $request->business_address_line_2;
            $retail->city                      = '';
            $retail->state                     = '';
            $retail->country                   = '';
            $retail->mobile_number             = $request->mobile_number;
            $retail->modified_by               = \Auth::user()->id;
            $retail->save();

             if( !Session::has('parent_id') && $request->user_role==6) {

                    Session::put('parent_id', $request->id);

                }

            // now update user role
            $user_role = RoleUser::where('user_id', $retail->user_id)->first();
            DB::statement("DELETE FROM role_user WHERE role_id = '$user_role->role_id' AND user_id = '$retail->user_id'");
            // RoleUser::where('user_id', $retail->user_id)->first()->delete();
            RoleUser::create([
                'role_id'       => $request->user_role,
                'user_id'       => $retail->user_id,
                'status'        => 0,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => \Auth::user()->id,
                'modified_by'   => \Auth::user()->id,
            ]);
            // dd($request);
            setflashmsg('Record Updated Successfully','1');
        } else {


            // check for validation
            $validatedData = $request->validate([
                'first_name'                => 'required',
                'last_name'                 => 'required',
                'telephone_number'          => 'required|numeric|digits_between:10,12',
                'clinic_location'           => 'required',
                'user_role'                 => 'required',
                'position'                  => 'required',
                'mobile_number'             => 'required|numeric|digits_between:10,12',
                // check for available email address in user table
                'email'                     => 'required|string|email|max:255|unique:users',
                'password'                  => 'required|string',
            ],[
                'clinic_location.required' => 'Business Address is Required'
            ]);
           
           if(isset($request->user_parent_id)){


                if ($request->user_role==6 && $request->user_selected_role==6) {
            
                   
                            # code...
                    setflashmsg('Please Select Different User and User Role','2');
                    return redirect('/retail-user');

                }else if($request->user_role==6){

                    setflashmsg('Please Select Different User and User Role ','2');

                    return redirect('/retail-user');

                }else{

                    $user_parent_id=$request->user_parent_id;

                }

              

            }else{

                $user_parent_id=0;
              
            }
    
            

            DB::transaction(function() use ($request,$retail) {

                 
           
                // create new user data to users table
                $user = User::create([
                    'name'          => $request->first_name,
                    'email'         => $request->email,
                    'password'      => Hash::make($request->password),
                    'user_type'     => 1,
                    'status'        => 0,
                    'created_date'  => date('Y-m-d H:i:s'),
                    'created_by'    => \Auth::user()->id,
                    'modified_by'   => \Auth::user()->id,
                ]);
                // now add this user to specified role on role_user table
                RoleUser::create([
                    'role_id'       => $request->user_role,
                    'user_id'       => $user->id,
                    'status'        => 0,
                    'created_date'  => date('Y-m-d H:i:s'),
                    'created_by'    => \Auth::user()->id,
                    'modified_by'   => \Auth::user()->id,
                ]);



                



                // now add data to retail_details table
                $retail = Retail::create([
                    'user_id'                   => $user->id,
                    'user_role_id'               => $request->user_role,
                    'user_parent_id'            => ($request->user_parent_id ? $request->user_parent_id : 0),
                    'first_name'                => $request->first_name,
                    'last_name'                 => $request->last_name,
                    'email'                     => $request->email,
                    'business_tel_number'       => $request->telephone_number,
                    'address_line_1'            => $request->clinic_location,
                    'mobile_number'             => $request->mobile_number,
                    'address_line_2'   => '',
                    'city'                      => '',
                    'state'                     => '',
                    'country'                   => '',
                    'clinic_id'                => Session::get('retail_site_id'),
                    'position'                  => $request->position,
                    'status'                    => 0,
                    'created_date'              => date('Y-m-d H:i:s'),
                    'created_by'                => \Auth::user()->id,
                    'modified_by'               => \Auth::user()->id,
                ]);

                
                if( !Session::has('parent_id') && $request->user_role==6) {

                    Session::put('parent_id', $retail->id);

                }
            
            Session::put('retail_details_id', $retail->id);

            });

            setflashmsg('Record Inserted Successfully','1');
        }




        // if( !empty($retail->exists) ) {
            // success
            
            if( $request->savestep == 0 ) {

                session()->forget('retail_site_id');
                session()->forget('retail_details_id');
                session()->forget('parent_id');
                
                return redirect('/retail');
            } else {
           
                return redirect('/retail-user');
            }
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
