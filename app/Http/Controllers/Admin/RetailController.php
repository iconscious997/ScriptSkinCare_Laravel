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
          
        if ($request->isMethod('get')) { 
            $data=Retail::join('role_user','retail_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')        
                ->join('clinic_details','clinic_details.id','=','retail_details.clinic_id')    
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
            }else{

                $data=Retail::join('role_user','retail_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')        
                ->join('clinic_details','clinic_details.id','=','retail_details.clinic_id')    
                ->join('users','retail_details.user_id','=','users.id')
                ->select('*')->get();
            }
        }

            $all_roles=Role::where('user_type', 2)->where('status', 0)->get();
           return view('admin.retail',compact('data','request','all_roles'));
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
        ],[
            'clinic_name.required'      => 'Retail Name is required',
            'trading_name.required'     => 'Trading Name is required',
            'clinic_location.required'  => 'Retail Location is required',
            'telephone_number.required' => 'Telephone is required',
            'clinic_email.required'     => 'Retail Email is required',
            'clinic_website.required'   => 'Retail Website is required'                          
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
            
            setflashmsg('Retail Updated Successfully','1');

        } else {
            $clinic = Clinic::create([
                'clinic_name'                => request('clinic_name'),
                'trading_name'               => request('trading_name'),
                'clinic_location'            => request('clinic_location'),
                'telephone_number'           => request('telephone_number'),
                'clinic_email'               => request('clinic_email'),
                'clinic_website'             => request('clinic_website'),
                'clinic_status'              => 0,
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

    public function retail_user_add($id='')
    {
         if( !Session::has('retail_site_id') ) {
             return redirect('/retailadd');
         }
        
         if($id == NULL) $id = Session::get('retail_details_id');

          $retail_admin = Retail::join('role_user','retail_details.user_id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->where('retail_details.clinic_id', Session::get('retail_site_id'))
            ->where('roles.name', "retail_admin")
            ->select('retail_details.id','retail_details.first_name','retail_details.last_name')->get()->toArray();

            $retailsite = Clinic::find(Session::get('retail_site_id'));
            $roles = Role::where('user_type', 2)->where('status', 0)->get();
            if( Session::has('retail_details_id') ) {
                $retailuser = Retail::find($id);
                $user_selected_role = RoleUser::where('user_id', $retailuser->user_id)->first();
                $user = User::find($retailuser->user_id);

                return view('admin.retail-user', compact('roles','retailsite','retail_admin','retailuser','user','user_selected_role'));
            }else{
                return view('admin.retail-user',compact('roles','retailsite','retail_admin'));
            }
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
                'telephone_number'          => 'required|numeric|digits_between:10,12',
                'clinic_location'           => 'required',
                'user_role'                 => 'required',
                'position'                  => 'required',
                'mobile_number'             => 'required|numeric|digits_between:10,12',
                
            ],[
                'first_name.required'       => 'First Name is required',
                'last_name.required'        => 'Last Name is required',
                'telephone_number.required' => 'Telephone is required',
                'clinic_location.required'  => 'Retail Location is required',
                'user_role.required'        => 'User Role is required',
                'position.required'         => 'Position is required',
                'mobile_number.required'    => 'Mobile is required'                          
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
            $retail->first_name                = $request->first_name;
            $retail->last_name                 = $request->last_name;
            $retail->user_parent_id            = $user_parent_id;
            $retail->business_tel_number       = $request->telephone_number;
            $retail->address_line_1            = $request->clinic_location;
            $retail->mobile_number             = $request->mobile_number;
            $retail->address_line_2            = '';
            $retail->city                      = '';
            $retail->state                     = '';
            $retail->country                   = '';
            $retail->position                  = $request->position;
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
            
            setflashmsg('Record Updated Successfully','1');
            Session::put('retail_details_id', $retail->id);
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
                'first_name.required'       => 'First Name is required',
                'last_name.required'        => 'Last Name is required',
                'telephone_number.required' => 'Telephone is required',
                'clinic_location.required'  => 'Retail Location is required',
                'user_role.required'        => 'User Role is required',
                'position.required'         => 'Position is required',
                'mobile_number.required'    => 'Mobile is required',
                'email.required'            => 'Email is Required',
                'password.required'         => 'Password is Required'
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
                    'user_role_id'              => $request->user_role,
                    'user_parent_id'            => ($request->user_parent_id ? $request->user_parent_id : 0),
                    'first_name'                => $request->first_name,
                    'last_name'                 => $request->last_name,
                    'email'                     => $request->email,
                    'business_tel_number'       => $request->telephone_number,
                    'address_line_1'            => $request->clinic_location,
                    'mobile_number'             => $request->mobile_number,
                    'address_line_2'            => '',
                    'city'                      => '',
                    'state'                     => '',
                    'country'                   => '',
                    'clinic_id'                 => Session::get('retail_site_id'),
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

                   
        if( $request->savestep == 0 ) {
            session()->forget('retail_site_id');
            session()->forget('retail_details_id');
            session()->forget('parent_id');            
            return redirect('/retail');
        } else {           
            return redirect('/retail-user');
        }
    }

    public function get_list_of_retail_user($id='')
    {   
         $data=Retail::where('clinic_id', $id)->get();

         $send_data='';
         foreach ($data as $key => $value) {             
             $send_data.="<tr>
                        <td>".$value->first_name." ".$value->last_name."</td>
                        <td> <a href='".url('/retail-user').'/'.$value->id."' ><button type='button' class='btn btn-default'> Edit</button></a> </td>
                    </tr>";
         }
        return $send_data;
    }

    public function retailuserlist(Request $request)
    {
        if ($request->isMethod('get')) {

            $data=Retail::join('clinic_details','retail_details.clinic_id','=','clinic_details.id')
            ->join('role_user','retail_details.user_id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->join('users','retail_details.user_id','=','users.id')
            ->select('retail_details.*','clinic_details.clinic_name','clinic_details.trading_name','clinic_details.clinic_website','roles.label','users.email','retail_details.status as sstatus','users.id as user_id')->get();
        }
        
        if ($request->isMethod('post')) {            
            $query=[];          
            if (isset($request->clinic_name) && !empty($request->clinic_name)) {            
                $query[]=['clinic_details.clinic_name', 'like','%' . $request->clinic_name. '%'];
            }
            
            if (isset($request->first_name) && !empty($request->first_name)) {
                $query[]=['retail_details.first_name', 'like','%'. $request->first_name.'%'];
            }

            if (isset($request->last_name) && !empty($request->last_name)) {
                $query[]=['retail_details.last_name', 'like','%'. $request->last_name.'%'];
            }

            if (isset($request->email) && !empty($request->email)) {
                 $query[]=['users.email', 'like','%'. $request->email.'%'];
            }

            if (isset($request->position) && !empty($request->position)) {
                $query[]=['retail_details.position', 'like','%'. $request->position.'%'];
            }

            if (isset($request->pstatus) && !empty($request->pstatus)) {
                $query[]=['roles.id', '=',$request->pstatus];
            }
            
            if (isset($request->status) && !empty($request->status)) {
                $query[]=['retail_details.status', '=',$request->status];
            }

            if(isset($query) && !empty($query)){

                $d = retail::join('clinic_details','retail_details.clinic_id','=','clinic_details.id')
                ->join('role_user','retail_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','retail_details.user_id','=','users.id')
                ->where($query);

                if (isset($request->create_date) && !empty($request->create_date)) {
                    $d->whereDate('retail_details.created_date', '=', date("Y-m-d", strtotime($request->create_date)) );
                }

                $data = $d->select('retail_details.*','clinic_details.clinic_name','clinic_details.trading_name','clinic_details.clinic_website','roles.label','users.email','retail_details.status as sstatus','users.id as user_id')->get();

            }else if (isset($request->create_date) && !empty($request->create_date)) {

                 $d = retail::join('clinic_details','retail_details.clinic_id','=','clinic_details.id')
                ->join('role_user','retail_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','retail_details.user_id','=','users.id');
                $d->whereDate('retail_details.created_date', '=', date("Y-m-d", strtotime($request->create_date)) );

                $data = $d->select('retail_details.*','clinic_details.clinic_name','clinic_details.trading_name','clinic_details.clinic_website','roles.label','users.email','retail_details.status as sstatus','users.id as user_id')->get();

            }else{

                $data=retail::join('clinic_details','retail_details.clinic_id','=','clinic_details.id')
                ->join('role_user','retail_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','retail_details.user_id','=','users.id')
                ->select('retail_details.*','clinic_details.clinic_name','clinic_details.trading_name','clinic_details.clinic_website','roles.label','users.email','retail_details.status as sstatus','users.id as user_id')->get();
            }
        }

          $i=0;

            $user_parent_name=array();
            foreach ($data as $value) {                            
                $temp_data=array();

                if($value->user_parent_id!=0){
                    $user_parent=Retail::find($value->user_parent_id);
                    $temp_data=$user_parent->first_name." ".$user_parent->last_name;
                }else{
                    $temp_data="-";
                }

                array_push($user_parent_name, $temp_data);
            }

                
            $all_roles = Role::where('user_type', 2)->where('status', 0)->get();
             
            return view( 'admin.retail-user-list',compact('data','user_parent_name','request','all_roles'));  
    }

    public function retailuseredit($id)
    {
         $retailuser = Retail::find($id);
          $retail_admin = Retail::join('role_user','retail_details.user_id','=','role_user.user_id')
           ->join('roles','role_user.role_id','=','roles.id')
           ->where('retail_details.clinic_id', $retailuser->clinic_id)
           ->where('roles.name', "retail_admin")
           ->select('retail_details.id','retail_details.first_name','retail_details.last_name')->get()->toArray();

            $retailsite = Clinic::find($retailuser->clinic_id);
            $roles = Role::where('user_type', 2)->where('status', 0)->get();

            $user_selected_role = RoleUser::where('user_id', $retailuser->user_id)->first();
            $user = User::find($retailuser->user_id);

            return view('admin.retail-user-edit', compact('roles','retailsite','retail_admin','retailuser','user','user_selected_role'));
    }

    public function retailuserupdate(Request $request)
    {
        // check for validation
         $validatedData = $request->validate([
            'first_name'                => 'required',
            'last_name'                 => 'required',
            'telephone_number'          => 'required|numeric|digits_between:10,12',
            'clinic_location'           => 'required',
            'user_role'                 => 'required',
            'position'                  => 'required',
            'mobile_number'             => 'required|numeric|digits_between:10,12',
            
        ],[
            'first_name.required'       => 'First Name is required',
            'last_name.required'        => 'Last Name is required',
            'telephone_number.required' => 'Telephone is required',
            'clinic_location.required'  => 'Business Address is Required',
            'user_role.required'        => 'User Role is Required',
            'position.required'         => 'Position is Required',
            'mobile_number.required'    => 'Mobile is Required'
        ]);


        if(isset($request->user_parent_id)){

            if ($request->user_role==6 && $request->user_selected_role==6) {                
                # code...
                setflashmsg('Please Select Different User and User Role ','2');
                return redirect('/retail-user-edit/'.$request->id);
            }else if($request->user_role==6){
                setflashmsg('Please Select Different User and User Role ','2');
                return redirect('/retail-user-edit/'.$request->id);
            }else{
                $user_parent_id=$request->user_parent_id;
            }
        }else{
            $user_parent_id=0;
        }


            $retail = Retail::find($request->id);
            $retail->first_name                = $request->first_name;
            $retail->last_name                 = $request->last_name;
            $retail->user_parent_id            = $user_parent_id;
            $retail->business_tel_number       = $request->telephone_number;
            $retail->address_line_1            = $request->clinic_location;
            $retail->mobile_number             = $request->mobile_number;
            $retail->address_line_2            = '';
            $retail->city                      = '';
            $retail->state                     = '';
            $retail->country                   = '';
            $retail->position                  = $request->position;
            $retail->modified_by               = \Auth::user()->id;
            $retail->save();
          
            // now update user role
            $user_role = RoleUser::where('user_id', $retail->user_id)->first();
            DB::statement("DELETE FROM role_user WHERE role_id = '$user_role->role_id' AND user_id = '$retail->user_id'");
            
            RoleUser::create([
                'role_id'       => $request->user_role,
                'user_id'       => $retail->user_id,
                'status'        => 0,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => \Auth::user()->id,
                'modified_by'   => \Auth::user()->id,
            ]);

            setflashmsg('Record Updated Successfully','1');
            return redirect('/retail-user-list');
    }


    public function newretailuser()
    {
        $roles = Role::where('user_type', 2)->where('status', 0)->get();
        $retailsite = Clinic::all();
        return view('admin.new-retail-user', compact('roles','retailsite'));
    }

    public function newretailuserstore(Request $request)
    {        
         // check for validation
            $validatedData = $request->validate([
                'first_name'                => 'required',
                'last_name'                 => 'required',
                'telephone_number'          => 'required|numeric|digits_between:10,12',
                'clinic_location'           => 'required',
                'user_role'                 => 'required',
                'position'                  => 'required',
                'clinic_id'                  => 'required',
                'mobile_number'             => 'required|numeric|digits_between:10,12',
                // check for available email address in user table
                'email'                     => 'required|string|email|max:255|unique:users',
                'password'                  => 'required|string',
            ],[
                'first_name.required'       => 'First Name is required',
                'last_name.required'        => 'Last Name is required',
                'telephone_number.required' => 'Telephone is required',
                'clinic_location.required'  => 'Retail Location is required',
                'user_role.required'        => 'User Role is required',
                'position.required'         => 'Position is required',
                'clinic_id.required'        => 'Retail is required',
                'mobile_number.required'    => 'Mobile is Required',
                'email.required'            => 'Email is Required',
                'password.required'         => 'password is Required'
            ]);
           
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
                'clinic_id'                => $request->clinic_id,
                'position'                  => $request->position,
                'status'                    => 0,
                'created_date'              => date('Y-m-d H:i:s'),
                'created_by'                => \Auth::user()->id,
                'modified_by'               => \Auth::user()->id,
            ]);

            setflashmsg('Retail User Added Successfully','1');
            return redirect('/retail-user-list');

    }

    public function clinicactivedeactive($id,$status){       
        DB::table('clinic_details')
        ->where("clinic_details.id", '=',  $id)
        ->update(['clinic_details.clinic_status'=> $status]);
        return redirect('/retail');
    }
}