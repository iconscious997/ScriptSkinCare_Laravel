<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use Validator;
use Hash;
use App\Supplier;
use App\Brand;
use App\Role;
use App\Company;
use App\User;
use App\RoleUser;
use App\Mymodel\Supplier\Productline;
use App\Mymodel\Supplier\Product;


class SupplierUserController extends Controller
{
	public function index(Request $request) {
		
		if ($request->isMethod('get')) {

            $data=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
            ->join('role_user','supplier_details.user_id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->join('users','supplier_details.user_id','=','users.id')
            ->select('supplier_details.*','company_details.business_name','company_details.trading_name','company_details.website','roles.label','users.email','supplier_details.status as sstatus','users.id as user_id')
            ->where('supplier_details.company_id','=',Session::get('company_id'))
            ->get();
        }

        if ($request->isMethod('post')) {
            
            $query=[];
            if (isset($request->business_name) && !empty($request->business_name)) {
                $query[]=['company_details.business_name', 'like','%' . $request->business_name. '%'];
            }
            
            if (isset($request->first_name) && !empty($request->first_name)) {                
                $query[]=['supplier_details.first_name', 'like','%'. $request->first_name.'%'];
            }

            if (isset($request->last_name) && !empty($request->last_name)) {
                $query[]=['supplier_details.last_name', 'like','%'. $request->last_name.'%'];
            }

            if (isset($request->email) && !empty($request->email)) {                
                 $query[]=['users.email', 'like','%'. $request->email.'%'];
            }

            if (isset($request->position) && !empty($request->position)) {                
                $query[]=['supplier_details.position', 'like','%'. $request->position.'%'];
            }

            if (isset($request->pstatus) && !empty($request->pstatus)) {
                $query[]=['roles.id', '=',$request->pstatus];
            }
            
            if (isset($request->status) && !empty($request->status)) {
                $query[]=['supplier_details.status', '=',$request->status];
            }

            if(isset($query) && !empty($query)){
                $d = Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','supplier_details.user_id','=','users.id')
                ->where($query);
                
                if (isset($request->create_date) && !empty($request->create_date)) {
                    $d->whereDate('supplier_details.created_date', '=', date("Y-m-d", strtotime($request->create_date)) );                
                }

                $data = $d->select('supplier_details.*','company_details.business_name','company_details.trading_name','company_details.website','roles.label','users.email','supplier_details.status as sstatus','users.id as user_id')
                ->where('supplier_details.company_id','=',Session::get('company_id'))
                ->get();
            }else if (isset($request->create_date) && !empty($request->create_date)) {

                 $d = Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','supplier_details.user_id','=','users.id');
                
                $d->whereDate('supplier_details.created_date', '=', date("Y-m-d", strtotime($request->create_date)) );            

                $data = $d->select('supplier_details.*','company_details.business_name','company_details.trading_name','company_details.website','roles.label','users.email','supplier_details.status as sstatus','users.id as user_id')
                ->where('supplier_details.company_id','=',Session::get('company_id'))
                ->get();
            }else{

                $data=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','supplier_details.user_id','=','users.id')
                ->select('supplier_details.*','company_details.business_name','company_details.trading_name','company_details.website','roles.label','users.email','supplier_details.status as sstatus','users.id as user_id')
                ->where('supplier_details.company_id','=',Session::get('company_id'))
                ->get();
            }            

        }

            
        $i=0;

        $all_brand_name=array();
        $user_parent_name=array();
        
        foreach ($data as $value) {
                            
            $temp_data=array();
            if($value->user_parent_id!=0){
                $user_parent=Supplier::find($value->user_parent_id);
                $temp_data=$user_parent->first_name." ".$user_parent->last_name;
            }else{
               $temp_data="-";
            }

            array_push($user_parent_name, $temp_data);
                                
            if ($value->brand_ids!=null) {
                $i++;
                # code...
                $add_brand_tmp=array();
                $tmp_remove = explode(',', $value->brand_ids);

                 foreach ($tmp_remove as $sub) {                     
                        if (isset($sub) && !empty($sub)) {
                            # code...
                            $brands_data = Brand::find( $sub); 
                            array_push($add_brand_tmp, $brands_data->brand_name);
                        }
                }
            
                $temp_data=implode(",", $add_brand_tmp);
                           
            }else{

                $temp_data="-";
            }

            array_push($all_brand_name, $temp_data);
            
        }
                
        $all_roles = Role::where('user_type', 1)->where('status', 0)->get();        
        return view( 'supplier.user.list',compact('data','all_brand_name','user_parent_name','request','all_roles'));   

	}


	public function useradd()
	{
		 $roles = Role::where('user_type', 1)->where('status', 0)
        ->get();
        $supplier_admin = Supplier::join('role_user','supplier_details.user_id','=','role_user.user_id')
             ->join('roles','role_user.role_id','=','roles.id')
             ->where('supplier_details.company_id', Session::get('company_id'))
             ->where('roles.name', "supplier_admin")
             ->select('supplier_details.id','supplier_details.first_name','supplier_details.last_name')->get();

         return view( 'supplier.user.add',compact('roles','supplier_admin'));   
	}

	public function userstore(Request $request)
	{
		
        // check for validation
            $validatedData = $request->validate([
                'first_name'                => 'required',
                'last_name'                 => 'required',
                'business_tel_number'       => 'required|numeric|digits_between:10,12',
                'business_address_line_1'   => 'required',
                'user_role'                 => 'required',
                'position'                  => 'required',
                'mobile_number'             => 'required|numeric|digits_between:10,12',
                // check for available email address in user table
                'email'                     => 'required|string|email|max:255|unique:users',
                'password'                  => 'required|string',
            ],[
                'first_name.required'               => 'First Name is required',
                'last_name.required'                => 'Last Name is required',
                'business_tel_number.required'      => 'Business Telephone is required',
                'business_address_line_1.required'  => 'Business Address is required',
                'user_role.required'                => 'User Role is required',
                'position.required'                 => 'Postion is required',
                'mobile_number.required'            => 'Mobile is required',
                'email.required'                    => 'Email is required',
                'password.required'                 => 'Password is required'
            ]);            

            if(isset($request->user_parent_id)){
                if ($request->user_role==3 && $request->user_selected_role==3) {
                    
                    # code...
                    setflashmsg('Please Select Different User and User Role','2');
                    return redirect('/supplier/useradd');

                }else if($request->user_role==3){
                    setflashmsg('Please Select Different User and User Role ','2');
                    return redirect('/supplier/useradd');
                }else{
                    $user_parent_id=$request->user_parent_id;
                }             

            }else{
                $user_parent_id=0;              
            }                


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

                // now add data to supplier_details table
                $supplier = Supplier::create([
                    'user_id'                   => $user->id,
                    'company_id'                => Session::get('company_id'),
                    'user_parent_id'            => $user_parent_id,
                    'first_name'                => $request->first_name,
                    'last_name'                 => $request->last_name,
                    'supplier_name'             => "",
                    'position'                  => $request->position,
                    'business_tel_number'       => $request->business_tel_number,
                    'business_address_line_1'   => $request->business_address_line_1,
                    'business_address_line_2'   => $request->business_address_line_2,
                    'city'                      => '',
                    'state'                     => '',
                    'country'                   => '',
                    'mobile_number'             => $request->mobile_number,
                    'status'                    => 0,
                    'created_date'              => date('Y-m-d H:i:s'),
                    'created_by'                => \Auth::user()->id,
                    'modified_by'               => \Auth::user()->id,
                ]);
            
                if( !empty($supplier->exists) ) {
                    // success                    
                    setflashmsg('Supplier Added Successfully','1');                   
                    return redirect('/supplier/user');                    
                } else {
                    setflashmsg('Some error occured. Please try again','0');
                    return redirect('/supplier/useradd');
                }
	}


	public function useredit($id)
	{
		
		$roles = Role::where('user_type', 1)->where('status', 0)->get();
        $supplier = Supplier::find($id);

         $supplier_admin = Supplier::join('role_user','supplier_details.user_id','=','role_user.user_id')
             ->join('roles','role_user.role_id','=','roles.id')
                ->where('supplier_details.company_id', Session::get('company_id'))
                ->where('roles.name', "supplier_admin")
                ->select('supplier_details.id','supplier_details.first_name','supplier_details.last_name')->get()->toArray();

        $user_selected_role = RoleUser::where('user_id', $supplier->user_id)->first();
        $user = User::find($supplier->user_id);

        
        
        return view('supplier.user.edit', compact('supplier','roles','user_selected_role', 'user','supplier_admin'));      
	}


	public function usereditstore(Request $request)
    {
    	
        # code...
        // check for validation
            $validatedData = $request->validate([
                'first_name'                => 'required',
                'last_name'                 => 'required',
                'business_tel_number'       => 'required|numeric|digits_between:10,12',
                'business_address_line_1'   => 'required',
                'user_role'                 => 'required',
                'position'                  => 'required',
                'mobile_number'             => 'required|numeric|digits_between:10,12',
            ],[
                'first_name.required'               => 'First Name is required',
                'last_name.required'                => 'Last Name is required',
                'business_tel_number.required'      => 'Business Telephone is required',
                'business_address_line_1.required'  => 'Business Address is required',
                'user_role.required'                => 'User Role is required',
                'position.required'                 => 'Position is required',
                'mobile_number.required'            => 'Mobile Number is required'
            ]);


             if(isset($request->user_parent_id)){
                    
                    if ($request->user_role==3 && $request->user_selected_role==3) {
                                
                      setflashmsg('Please Select Different User and User Role ','2');
                        return redirect('/supplier/useredit/'.$request->id);


                    }else if($request->user_role==3){

                        setflashmsg('Please Select Different User and User Role ','2');
                        return redirect('/supplier/useredit/'.$request->id);

                    }else{
                        $user_parent_id=$request->user_parent_id;
                    }

                }else{
                    $user_parent_id=0;
                }

        
            $supplier = Supplier::find($request->id);
            $supplier->user_parent_id            = $user_parent_id;
            $supplier->first_name                = $request->first_name;
            $supplier->last_name                 = $request->last_name;
            $supplier->supplier_name             = "";
            $supplier->position                  = $request->position;
            $supplier->business_tel_number       = $request->business_tel_number;
            $supplier->business_address_line_1   = $request->business_address_line_1;
            $supplier->business_address_line_2   = $request->business_address_line_2;
            $supplier->city                      = '';
            $supplier->state                     = '';
            $supplier->country                   = '';
            $supplier->mobile_number             = $request->mobile_number;
            $supplier->modified_by               = \Auth::user()->id;
            $supplier->save();
            // now update user role

            $user_role = RoleUser::where('user_id', $supplier->user_id)->first();
            DB::statement("DELETE FROM role_user WHERE role_id = '$user_role->role_id' AND user_id = '$supplier->user_id'");

            // RoleUser::where('user_id', $supplier->user_id)->first()->delete();
            RoleUser::create([
                'role_id'       => $request->user_role,
                'user_id'       => $supplier->user_id,
                'status'        => 0,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => \Auth::user()->id,
                'modified_by'   => \Auth::user()->id,
            ]);

            // dd($request);
            setflashmsg('Supplier User Updated Successfully','1'); 

     		return redirect('/supplier/user');   
    }


	
}
