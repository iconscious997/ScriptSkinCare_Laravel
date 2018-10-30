<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use Hash;
use Validator;
use App\Supplier;
use App\Brand;
use App\Company;
use App\Role;
use App\User;
use App\RoleUser;

class SupplierController extends Controller
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
        return view('admin.supplierlist');
    }

    public function supplieradd()
    {
        return view('admin.supplieradd');
    }

   public function supplierstep1()
    {
        // Session::put('first', 1);
        if( Session::has('first') ) {
            $company = Company::find(Session::get('first'));
            return view('admin.supplierstep1', compact('company'));
        }
        return view('admin.supplierstep1');
    }

    public function supplierstep1store(Request $request)
    {

        $validatedData = $request->validate([
            'registered_business_name'  => 'required',
            'trading_name'              => 'required',
            'abn'                       => 'required',
            'address'                   => 'required',
            'business_telephone'        => 'required|numeric|digits_between:10,12',
            'email_address'             => 'required|email',
            'website'                   => 'required|url',
        ],[
            'registered_business_name.required'   => 'Registered Business Name is required',
            'trading_name.required'               => 'Trading Name is required',
            'abn.required'                        => 'ABN is required',
            'address.required'                    => 'Address is required',
            'business_telephone.required'         => 'Business Telephone is required',
            'email_address.required'              => 'Email is required',
            'website.required'                    => 'Website is required'               
        ]);

        // here check if id is present then update data
        if( !empty( $request->id ) ) {
            $company = Company::find($request->id);
            $company->business_name                 = $request->registered_business_name;
            $company->trading_name                  = $request->trading_name;
            $company->abn                           = $request->abn;
            $company->address                       = $request->address;
            $company->business_telephone_number     = $request->business_telephone;
            $company->email_address                 = $request->email_address;
            $company->website                       = $request->website;
            $company->modified_by                   = \Auth::user()->id;
            $company->save();

            // 
            setflashmsg('Company Updated Successfully','1');
            // dd($request);
        } else {
            $company = Company::create([
                'business_name'                 => request('registered_business_name'),
                'trading_name'                  => request('trading_name'),
                'abn'                           => request('abn'),
                'address'                       => request('address'),
                'business_telephone_number'     => request('business_telephone'),
                'email_address'                 => request('email_address'),
                'website'                       => request('website'),
                'status'                        => 0,
                'created_date'                  => date('Y-m-d H:i:s'),
                'created_by'                    => \Auth::user()->id,
                'modified_by'                   => \Auth::user()->id,
            ]);

            setflashmsg('Company Added Successfully','1');
        }
       
        
        if($company->exists) {
            // success
            Session::put('first', $company->id);
            return redirect('/supplierstep2');
        }        
        
    }

    public function supplierstep2($id='')
    {

        if( !Session::has('first') ) {
             return redirect('/supplierstep1');
        }

        // Session::put('second', 1);
        $roles = Role::where('user_type', 1)->where('status', 0)->get();
    
        if($id == NULL) $id = Session::get('second');

            $supplier_admin = Supplier::join('role_user','supplier_details.user_id','=','role_user.user_id')
             ->join('roles','role_user.role_id','=','roles.id')
             ->where('supplier_details.company_id', Session::get('first'))
             ->where('roles.name', "supplier_admin")
             ->select('supplier_details.id','supplier_details.first_name','supplier_details.last_name')->get()->toArray();
      
            if( $id ) {
                Session::put('second', $id);
                $supplier = Supplier::find($id);

                if( !empty($supplier->user_id) ) {
                    // get this user seleced role
                    $user_selected_role = RoleUser::where('user_id', $supplier->user_id)->first();
                    $user = User::find($supplier->user_id);
                    return view('admin.supplierstep2', compact('supplier','roles','user_selected_role', 'user','supplier_admin'));
                }
            }

            return view( 'admin.supplierstep2', compact('roles','supplier_admin') );
    }

    public function supplierstep2store(Request $request)
    {
        if( $request->whattodo == 'new' ) {
            // if request is for new then reset session
            if( Session::has('second') ) {
                Session::put('supplier_parent_id', Session::get('second'));
                Session::forget('second');
            }
        }

        $supplier = null;
        if( !empty( $request->id ) && $request->whattodo == 'update' ) {
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
                'mobile_number.required'            => 'Mobile is Required'
            ]);

            
            if(isset($request->user_parent_id)){
                
                if ($request->user_role==3 && $request->user_selected_role==3) {
                    
                    # code...
                    setflashmsg('Please Select Different User and User Role ','2');
                        return redirect('/supplierstep2');

                }else if($request->user_role==3){

                    setflashmsg('Please Select Different User and User Role ','2');
                    return redirect('/supplierstep2');

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
            $supplier->business_tel_number       = $request->business_tel_number;
            $supplier->business_address_line_1   = $request->business_address_line_1;
            $supplier->business_address_line_2   = $request->business_address_line_2;
            $supplier->city                      = '';
            $supplier->state                     = '';
            $supplier->country                   = '';
            $supplier->mobile_number             = $request->mobile_number;
            $supplier->modified_by               = \Auth::user()->id;
            $supplier->save();

            if( !Session::has('parent_id') && $request->user_role==3) {
                   Session::put('parent_id', $request->id);
            }

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
            
            setflashmsg('User Updated Successfully','1');

        } else {

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
                'position.required'                 => 'Position is required', 
                'mobile_number.required'            => 'Mobile is Required',
                'email.required'                    => 'Email is Required',
                'password.required'                 => 'Password is Required'
            ]);

           if(isset($request->user_parent_id)){
                if ($request->user_role==3 && $request->user_selected_role==3) {                    
                    # code...
                    setflashmsg('Please Select Different User and User Role','2');
                    return redirect('/supplierstep2');
                }else if($request->user_role==3){
                    setflashmsg('Please Select Different User and User Role ','2');
                    return redirect('/supplierstep2');
                }else{
                    $user_parent_id=$request->user_parent_id;
                }
            }else{
                $user_parent_id=0;              
            }
    
            DB::transaction(function() use ($request,$supplier) {
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
                    'company_id'                => Session::get('first'),
                    'user_parent_id'            => ($request->user_parent_id ? $request->user_parent_id : 0),
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
                
                if( !Session::has('parent_id') && $request->user_role==3) {
                    Session::put('parent_id', $supplier->id);
                }
            
                Session::put('second', $supplier->id);

            });

            setflashmsg('User Added Successfully','1');
        }

                    
        if( $request->savestep == 0 ) {
            return redirect('/supplierstep3');
        } else {           
            return redirect('/supplierstep2');
        }        
    }

    public function get_list_of_supplier($id='')
    {   
         $data=Supplier::where('company_id', $id)->get();

         $send_data='';
         foreach ($data as $key => $value) {             
                $send_data.="<tr>
                    <td>".$value->first_name." ".$value->last_name."</td>                        
                    <td> <a href='".url('/supplierstep2').'/'.$value->id."' ><button type='button' class='btn btn-default'> Edit</button></a> </td>
                    </tr>";
         }
        return $send_data;
    }

    public function supplierstep3($id = NULL)
    {   

        if(!Session::has('second') ) {
             return redirect('/supplierstep2');
        }

        // $supplier = Supplier::where('id', Session::get('parent_id'))->get();
         $supplier = Supplier::join('role_user','supplier_details.user_id','=','role_user.user_id')
             ->join('roles','role_user.role_id','=','roles.id')
             ->where('supplier_details.company_id', Session::get('first'))
             ->where('roles.name', "supplier_admin")
             ->select('supplier_details.id','supplier_details.first_name','supplier_details.last_name')->get()->toArray();

        $sub_supplier = Supplier::where('company_id', Session::get('first'))->get();
       
                
        $roles = Role::where('user_type', 1)->where('status', 0)->get();
        if( Session::has('brand_id') && $id!='n' ) {
            if($id == NULL) $id = Session::get('brand_id');
            $brands_data = Brand::find( $id );

            $brand_id=Session::has('brand_id');
            $result = Supplier::where('company_id', Session::get('first'))->select('id','brand_ids')->get()->toArray();
          
            foreach ($result as  $value) {                    
                    if ($value['brand_ids']!=null) {
                        $tmp = explode(',', $value['brand_ids']);
                        if (in_array($id, $tmp)) {                            
                             $update_supplier[]= $value['id'];
                        }
                    }
            }

            return view('admin.supplierstep3', compact('supplier','roles','sub_supplier','brands_data','update_supplier','brand_id'));
        }

        return view( 'admin.supplierstep3', compact('supplier','roles','sub_supplier') );
    }

    public function supplierstep3store(Request $request)
    {
        if ($request->check_data == 'update' && $request->id) {                
            $validatedData = $request->validate([
                'brand_name'     => 'required',
                'supplier_parent_id' => 'required',
                'created_by'     => 'required',
                'assign_to_user' => 'required',
                'brand_logo'     => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'approved_by'    =>  'required',
            ],[
                'brand_name.required'           => 'Brand Name is required',
                'supplier_parent_id.required'   => 'Supplier Name is required',
                'created_by.required'           => 'Created By is required',
                'assign_to_user.required'       => 'Assign to User is required',
                'brand_logo.required'           => 'Brand Logo is required',
                'approved_by.required'          => 'Approved By is required'                
            ]);
            if ($request->file('brand_logo')) {
                $randomNumber = rand(1, 10000);
                $imageName = 'brand'.$randomNumber.'.'.$request->file('brand_logo')->getClientOriginalExtension();

                $request->file('brand_logo')->move(
                        base_path() . '/public/images/brand', $imageName
                    );
            } else {
                $imageName = $request->old_image_name;
            }

            $brands = Brand::find($request->id);
            $brands->brand_name = $request->brand_name;
            $brands->supplier_parent_id = $request->supplier_parent_id;
            $brands->brand_logo = $imageName;
            $brands->user_added_by= $request->created_by;
            $brands->approved_by= $request->approved_by;
            $brands->modified_by= \Auth::user()->id;
            $brands->save();

            $sub_supplier = Supplier::where('company_id', Session::get('first'))->get();
                 
            foreach ($sub_supplier as $key => $value) {
                $add_brand_tmp=array();
                $tmp_remove = explode(',', $value->brand_ids);
                
                foreach ($tmp_remove as $sub) {                            
                    if( $sub!=$brands->id) {
                       array_push($add_brand_tmp, $sub);
                    }                     
                }

                $add_brand = implode(',', $add_brand_tmp);
                
                $supplier = Supplier::find($value->id);
                $supplier->brand_ids = $add_brand;
                $supplier->save();
            }         

            foreach ($request->assign_to_user as $key => $value) {              

                $supplier = Supplier::find($value);
                $tmp = explode(',', $supplier->brand_ids);
                
                if( !in_array($brands->id, $tmp) ) {
                    array_push($tmp, $brands->id);
                    $supplier->brand_ids   = implode(',', $tmp);
                }else if (in_array($brands->id, $tmp)) {
                     $supplier->brand_ids  = implode(',', $tmp);
                }else{                    
                    $supplier->brand_ids   = $brands->id;
                }

                $supplier->save();
            }            

            Session::put('brand_id', $request->id);
            setflashmsg('Brand Updated Successfully','1');
            return redirect('/supplierstep4'); 

        } else {

            // check for validation
            $validatedData = $request->validate([
                'brand_name'     => 'required',
                'supplier_parent_id'     => 'required',
                'created_by'     => 'required',
                'assign_to_user' => 'required',
                'brand_logo'     => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'approved_by'    =>  'required',
                ]);

            if ($request->file('brand_logo')) {
                $randomNumber = time()."_".rand(1000, 9999);

                $imageName = 'brand'.$randomNumber.'.'.$request->file('brand_logo')->getClientOriginalExtension();

                $request->file('brand_logo')->move(
                    base_path() . '/public/images/brand', $imageName
                );

            } else {
                $imageName='img_avatar1.png';
            }
            
            // now add data to supplier_details table
            $brands = Brand::create([
                'brand_name'               => $request->brand_name,
                'brand_company_id'         => Session::get('first'),
                'supplier_parent_id'       => $request->supplier_parent_id,
                'brand_logo'               => $imageName,
                'user_added_by'            => $request->created_by,
                'approved_by'              => $request->approved_by,
                'status'                   => 0,
                'created_date'             => date('Y-m-d H:i:s'),
                // 'created_by'               => $request->created_by,
                'created_by'               => \Auth::user()->id,
                'modified_by'              => \Auth::user()->id,
            ]);

            if( !empty($brands->exists) ) {
                // assign 
                foreach ($request->assign_to_user as $key => $value) {
                    $supplier = Supplier::find($value);
                    $tmp = explode(',', $supplier->brand_ids);
                    if( !in_array($brands->id, $tmp) ) {
                        array_push($tmp, $brands->id);
                    }
                    $supplier->brand_ids       = implode(',', $tmp);
                    $supplier->save();
                }
                // success
                Session::put('brand_id', $brands->id);
                setflashmsg('Brand Added Successfully','1');
                return redirect('/supplierstep4'); 
            } else {
                setflashmsg('Some error occured. Please try again','0');
                return redirect('/supplierstep3');                
            }
        }        
    }

    public function supplierstep4()
    {
        if( !Session::has('brand_id') ) {
             return redirect('/supplierstep3');
        }

        $company = Company::find(Session::get('first'));
        $all_supplier_data = Supplier::where('company_id', Session::get('first'))->get();

            $tmp = '';
            $tmp_1 = array();
            foreach ($all_supplier_data as $key => $value) {
                if ($value->brand_ids!=null) {
                    $tmp .= $value->brand_ids;
                }               
            }
         
            $tmp_1=array_unique(explode(',', $tmp ));
            $brands_list=array();
            foreach ($tmp_1 as $key => $value) {
                # code...
                if (isset($value) && !empty($value)) {
                    $brands_list[]= Brand::find($value);
                }       
            }
            
        return view( 'admin.supplierstep4',compact('company','all_supplier_data','brands_list'));
    }

    public function supplierList(Request $request)
    {
          
        if ($request->isMethod('get')) {          
            $data=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
            ->join('role_user','supplier_details.user_id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->join('users','supplier_details.user_id','=','users.id')
            ->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')->get();
            }
                
            if ($request->isMethod('post')) {
                $query=[];          
                if (isset($request->business_name) && !empty($request->business_name)) {
                    $query[]=['company_details.business_name', 'like','%' . $request->business_name. '%'];                    
                 }
            
                if (isset($request->business_telephone_number) && !empty($request->business_telephone_number)) {                
                    $query[]=['company_details.business_telephone_number', 'like','%'. $request->business_telephone_number.'%'];                
                }

                if (isset($request->website) && !empty($request->website)) {                
                     $query[]=['company_details.website', 'like','%'. $request->website.'%'];
                }
           
                if (isset($request->first_name) && !empty($request->first_name)) {                
                    $query[]=['supplier_details.first_name', 'like','%'. $request->first_name.'%'];
                }

                if (isset($request->position) && !empty($request->position)) {                
                    $query[]=['supplier_details.position', 'like','%'. $request->position.'%'];
                }

                if (isset($request->last_name) && !empty($request->last_name)) {
                    $query[]=['supplier_details.last_name', 'like','%'. $request->last_name.'%'];
                }

                if (isset($request->email) && !empty($request->email)) {
                     $query[]=['users.email', 'like','%'. $request->email.'%'];
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

                    $data = $d->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')->get();

                } else if (isset($request->create_date) && !empty($request->create_date)){

                     $d = Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                        ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                        ->join('roles','role_user.role_id','=','roles.id')
                        ->join('users','supplier_details.user_id','=','users.id');            

                        $d->whereDate('supplier_details.created_date', '=', date("Y-m-d", strtotime($request->create_date)) );                
                        
                        $data = $d->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')->get();
                }else{
                        $data=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                        ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                        ->join('roles','role_user.role_id','=','roles.id')
                        ->join('users','supplier_details.user_id','=','users.id')
                        ->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')->get();
                }

            }

            $i=0;
            $all_brand_name=array();

            foreach ($data as $value) {                
                if ($value->brand_ids!=null) {

                    $i++;                    
                    $add_brand_tmp=array();
                    $tmp_remove = explode(',', $value->brand_ids);

                    foreach ($tmp_remove as $sub) {                         
                        if (isset($sub) && !empty($sub)) {                            
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
         
            $all_roles = Role::where('user_type', 1)->where('status', 0)
            ->get();         
            return view( 'admin.supplier-list',compact('data','all_brand_name','request','all_roles'));
    }

    public function finishSupplier($value='')
    {        
        session()->forget('first');
        session()->forget('parent_id');
        session()->forget('supplier_parent_id');
        session()->forget('brand_id');
        session()->forget('second');
        setflashmsg('New Supplier has been Set-Up Successfully','1');
        return redirect('/supplier');
    }

    public function supplierList2(Request $request , $id='')
    {
        
        if ($request->isMethod('get')) {
            $d=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
            ->join('role_user','supplier_details.user_id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->join('users','supplier_details.user_id','=','users.id')
            ->select('supplier_details.*','company_details.business_name','company_details.business_telephone_number','company_details.trading_name','company_details.website','roles.label','users.email','supplier_details.status as sstatus','users.id as user_id');
            
            if ($id!='') {                
                $d->where('supplier_details.company_id','=',$id);
            }

            $data=$d->get();
           
        }

         if ($request->isMethod('post')) {
            
            $query=[];

            if ($request->search=="Users") {                
                if (isset($request->user_parent_id) && !empty($request->user_parent_id)) {
                    $query[]=['supplier_details.user_parent_id', '=',$request->user_parent_id];
                }

                if (isset($request->role_id) && !empty($request->role_id)) {
                    $query[]=['roles.id', '=',$request->role_id];
                }

                if (isset($request->last_name) && !empty($request->last_name)) {                
                    $query[]=['supplier_details.last_name', 'like','%'. $request->last_name.'%'];
                }
            }

            if ($request->search=="Supplier") {                
                    if (isset($request->company_id) && !empty($request->company_id)) {
                        $query[]=['company_details.id', '=',$request->company_id];
                    }                  

                    if (isset($request->email) && !empty($request->email)) {                
                        $query[]=['users.email', 'like','%'. $request->email.'%'];                    
                    }

                     if (isset($request->trading_name) && !empty($request->trading_name)) {
                        $query[]=['company_details.trading_name', 'like','%'. $request->trading_name.'%'];
                    }
            }

            if ($request->search=="Brands") {
                    if (isset($request->user_parent_id_barnd) && !empty($request->user_parent_id_barnd)) {                
                        $query[]=['supplier_details.id', '=',$request->user_parent_id_barnd];
                    }
            }
           

            if(isset($query) && !empty($query)){

                $d = Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','supplier_details.user_id','=','users.id')
                ->where($query);
            
                if (isset($request->brand_id) && !empty($request->brand_id)) {                
                    $d->whereRaw('FIND_IN_SET('.$request->brand_id.',brand_ids)');
                }

                $data = $d->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')->get();

            }else if (isset($request->brand_id) && !empty($request->brand_id)){

                 $d = Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                    ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                    ->join('roles','role_user.role_id','=','roles.id')
                    ->join('users','supplier_details.user_id','=','users.id');
                    
                    $d->whereRaw('FIND_IN_SET('.$request->brand_id.',brand_ids)');
                    $data = $d->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')->get();

            } else {

                $data=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','supplier_details.user_id','=','users.id')
                ->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')->get();
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
                            if ($request->search=="Brands" && isset($request->status)) {
                                $brands_data = Brand::where('id','=',$sub)->where('status','=',$request->status)->select('*')->first();
                                        if (isset($brands_data->id) ) {                  
                                            array_push($add_brand_tmp, $brands_data->brand_name);
                                        }

                            }else{

                                $brands_data = Brand::find($sub);
                                    array_push($add_brand_tmp, $brands_data->brand_name);
                                }
                            }                                        
                                            
                        }

                        $temp_data=implode(",", $add_brand_tmp);                     
                             
                }else{

                     if ($request->search=="Brands" && isset($request->status)) {

                        $temp_data="";
                     }else{
                        $temp_data="-";
                     }
                }

                array_push($all_brand_name, $temp_data);                              

        }

                         
        $supplier_admin = Supplier::join('role_user','supplier_details.user_id','=','role_user.user_id')
        ->join('roles','role_user.role_id','=','roles.id')
        ->where('roles.name', "supplier_admin")
        ->select('supplier_details.id','supplier_details.first_name','supplier_details.last_name')->get();    
        $all_brand=Brand::all(); 
        $all_roles = Role::where('user_type', 1)->where('status', 0)->get();
        $company = Company::all();

        return view( 'admin.supplier-list2',compact('data','all_brand_name','user_parent_name','request','all_roles','supplier_admin','company','all_brand','id'));
    }

    public function supplieruserlist(Request $request)
    {
     
        if ($request->isMethod('get')) {

            $data=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
            ->join('role_user','supplier_details.user_id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->join('users','supplier_details.user_id','=','users.id')
            ->select('supplier_details.*','company_details.business_name','company_details.trading_name','company_details.website','roles.label','users.email','supplier_details.status as sstatus','users.id as user_id')->get();
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

                $data = $d->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')->get();
            }else if (isset($request->create_date) && !empty($request->create_date)) {

                 $d = Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','supplier_details.user_id','=','users.id');
                
                $d->whereDate('supplier_details.created_date', '=', date("Y-m-d", strtotime($request->create_date)) );            

                $data = $d->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')->get();
            }else{

                $data=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','supplier_details.user_id','=','users.id')
                ->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')->get();
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
        return view( 'admin.supplier-data-list',compact('data','all_brand_name','user_parent_name','request','all_roles'));   
    }

    public function supplieredit($id='')
    {        

        $roles = Role::where('user_type', 1)->where('status', 0)->get();
        $supplier = Supplier::find($id);

         $supplier_admin = Supplier::join('role_user','supplier_details.user_id','=','role_user.user_id')
             ->join('roles','role_user.role_id','=','roles.id')
                ->where('supplier_details.company_id', $supplier->company_id)
                ->where('roles.name', "supplier_admin")
                ->select('supplier_details.id','supplier_details.first_name','supplier_details.last_name')->get()->toArray();

        $user_selected_role = RoleUser::where('user_id', $supplier->user_id)->first();
        $user = User::find($supplier->user_id);

        $company = Company::all();
        
        return view('admin.supplier-data-edit', compact('supplier','roles','user_selected_role', 'user','supplier_admin','company'));       

    }


    public function supplierusereditstore(Request $request)
    {
        # code...
        // check for validation
            $validatedData = $request->validate([
                'first_name'                => 'required',
                'last_name'                 => 'required',
                'company_id'                 => 'required',
                'business_tel_number'       => 'required|numeric|digits_between:10,12',
                'business_address_line_1'   => 'required',
                'user_role'                 => 'required',
                'position'                  => 'required',
                'mobile_number'             => 'required|numeric|digits_between:10,12',
            ],[
                'first_name.required'               => 'First Name is required',
                'last_name.required'                => 'Last Name is required',
                'company_id.required'               => 'Company is required',
                'business_tel_number.required'      => 'Business Telephone is required',
                'business_address_line_1.required'  => 'Business Address is required',
                'user_role.required'                => 'User Role is required',
                'position.required'                 => 'Position is required',
                'mobile_number.required'            => 'Mobile Number is required'
            ]);


             if(isset($request->user_parent_id)){
                    
                    if ($request->user_role==3 && $request->user_selected_role==3) {
                                
                      setflashmsg('Please Select Different User and User Role ','2');
                        return redirect('/supplieruseredit/'.$request->id);

                    }else if($request->user_role==3){

                        setflashmsg('Please Select Different User and User Role ','2');
                        return redirect('/supplieruseredit/'.$request->id);

                    }else{
                        $user_parent_id=$request->user_parent_id;
                    }

                }else{
                    $user_parent_id=0;
                }

        
            $supplier = Supplier::find($request->id);
            $supplier->company_id                = $request->company_id;
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

            return redirect('/supplieruserlist');
    }


    public function usersupplieradd()
    {
        $company = Company::all();
        return view( 'admin.user-supplier-add',compact('company'));
    }

    public function usersupplierstore(Request $request)
    {
        
         $validatedData = $request->validate([
                'first_name'                => 'required',
                'last_name'                 => 'required',
                'company_id'                 => 'required',
                'business_tel_number'       => 'required|numeric|digits_between:10,12',
                'business_address_line_1'   => 'required',
                'position'                  => 'required',
                'mobile_number'             => 'required|numeric|digits_between:10,12',
                // check for available email address in user table
                'email'                     => 'required|string|email|max:255|unique:users',
                'password'                  => 'required|string',
            ],[
                'first_name.required'               => 'First Name is required',
                'last_name.required'                => 'Last Name is required',
                'company_id.required'               => 'Company is required',
                'business_tel_number.required'      => 'Business Telephone is required',
                'business_address_line_1.required'  => 'Business Address is required',
                'position.required'                 => 'Postion is required',
                'mobile_number.required'            => 'Mobile is required',
                'email.required'                    => 'Email is required',
                'password.required'                 => 'Password is required'
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
                    'role_id'       => 3,
                    'user_id'       => $user->id,
                    'status'        => 0,
                    'created_date'  => date('Y-m-d H:i:s'),
                    'created_by'    => \Auth::user()->id,
                    'modified_by'   => \Auth::user()->id,
                ]);


                // now add data to supplier_details table
                $supplier = Supplier::create([
                    'user_id'                   => $user->id,
                    'company_id'                => $request->company_id,
                    'user_parent_id'            =>  0,
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
                return redirect('/supplieruserlist');            
            } else {
                setflashmsg('Some error occured. Please try again','0');
                return redirect('/user-supplier-add');
            }
    }


    public function addnewuser()
    {
        $roles = Role::where('user_type', 1)->where('status', 0)
        ->get();
        $company = Company::all();
        return view( 'admin.add-new-user',compact('roles','company'));

    }

    public function get_supplier_company($id)
    {
             $supplier_admin = Supplier::join('role_user','supplier_details.user_id','=','role_user.user_id')
             ->join('roles','role_user.role_id','=','roles.id')
             ->where('supplier_details.company_id', $id)
             ->where('roles.name', "supplier_admin")
             ->select('supplier_details.id','supplier_details.first_name','supplier_details.last_name')->get();

            $send_data='';
            
            if ($supplier_admin->count()) {                    
                $send_data.='<option value="">Select Supplier User</option>';
                foreach ($supplier_admin as  $value) {
                     $send_data.=' <option  value="'.$value->id.'" >'.$value->first_name.' '.$value->last_name.'</option>';
                 }
            }else{
                    $send_data.=' <option  value=" " > No Supplier </option>';
            }                 
             
            return $send_data;
    }

    public function addnewuserstore(Request $request)
    {       

        // check for validation
            $validatedData = $request->validate([
                'first_name'                => 'required',
                'last_name'                 => 'required',
                'company_id'                => 'required',
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
                'company_id.required'               => 'Company is required',
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
                    return redirect('/add-new-user');

                }else if($request->user_role==3){
                    setflashmsg('Please Select Different User and User Role ','2');
                    return redirect('/add-new-user');
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
                    'company_id'                => $request->company_id,
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
                    return redirect('/supplieruserlist');                    
                } else {
                    setflashmsg('Some error occured. Please try again','0');
                    return redirect('/add-new-user');
                }

            }

            public function get_supplier_all($id='')
            {
                 $data=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                    ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                    ->join('roles','role_user.role_id','=','roles.id')
                    ->join('users','supplier_details.user_id','=','users.id')
                    ->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','roles.id as roles_id','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')->where('supplier_details.id', $id)->first();
                  
           $roles = Role::where('user_type', 1)->where('status', 0)->get();     

            $brands_data = Brand::where('brand_company_id','=',$data->company_id)->get();  
            $send_data='';
         
            $send_data.='<input type="hidden" name="_token" value="'.csrf_token().'">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Registered Business Name:" value="'.$data->business_name.'">             
                                    <span class="inputError" id="businesserror"></span>            
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="trading_name" id="trading_name" placeholder="Trading Name:" value="'.$data->trading_name.'">            
                                    <span class="inputError" id="trading_nameerror"></span>
                          </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address:" value="'.$data->address.'">             
                                    <span class="inputError" id="addresserror"></span>
            
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="business_telephone_number" id="business_telephone_number" placeholder="Business Telephone:" onkeypress="return isNumberKey(event)" value="'.$data->business_telephone_number.'">            
                                    <span class="inputError" id="bustelerror"></span>            
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="website" id="website" placeholder="Website:" value="'.$data->website.'">             
                                <span class="inputError" id="websiteerror"></span>
            
                            </div>
                            <div class="form-group col-md-6">            
                                <select name="brands_data[]" class="sm-select" id="brands_data" multiple="multiple">';
                                    foreach( $brands_data as $role ){
                                        $send_data.='<option  value="'.$role->id.'"  '.(in_array($role->id,explode(',', $data->brand_ids))?'selected':'').' >'.$role->brand_name.'</option>';
                                    }

                                    $send_data.='</select>
                                    <span class="inputError" id="brands_dataerror"></span>        
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">             
                                <input type="hidden" name="id" value="'.$data->id.'">
                                <input type="hidden" name="company_id" value="'.$data->company_id.'">
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name:" value="'.$data->first_name.'">             
                                <span class="inputError" id="firstnameerror"></span>            
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name:" value="'.$data->last_name.'">            
                                <span class="inputError" id="lastnameerror"></span>            
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email Address:" readonly value="'.$data->email.'">
                
                                <span class="inputError"></span>                
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="position" id="position" placeholder="Position :" value="'.$data->position.'">                            
                                <span class="inputError" id="positionerror"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <select name="user_role" id="user_role">
                                    <option value="">Select User Role</option>';
                                    foreach( $roles as $role ){
                                        $send_data.='<option '.($data->roles_id == $role->id ? 'selected' : '').' value="'.$role->id.'">'.$role->label.'</option>';
                                    }
                                    $send_data.='</select>          
                                    <span class="inputError" id="user_roleerror"></span>
          
                            </div>
                            <div class="form-group col-md-6">
                                <select name="status" id="status">
                                    <option value="">Select Status</option>
                                    <option value="0" '.($data->status==0 ? 'selected' : '').' >Active</option>
                                    <option value="1" '.($data->status== 1 ? 'selected' : '') .'>Deactive</option>
                                </select>          
                                <span class="inputError" id="statuserror"></span>          
                            </div>
                        </div>';                             
                return $send_data;
        }


        public function update_supplier_list_data(Request $request)
        {
                               
            $company = Company::find($request->company_id);
            $company->business_name                 = $request->business_name;
            $company->trading_name                  = $request->trading_name;
            $company->address                       = $request->address;
            $company->business_telephone_number     = $request->business_telephone_number;
            $company->website                       = $request->website;
            $company->modified_by                   = \Auth::user()->id;
            $company->save();

            $supplier = Supplier::find($request->id);
            $supplier->first_name      = $request->first_name;
            $supplier->last_name       = $request->last_name;
            $supplier->position        = $request->position;
            $supplier->brand_ids        = implode(',',$request->brands_data);
            $supplier->status          = $request->status;
            $supplier->modified_by     = \Auth::user()->id;
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
            
             if( !empty($supplier->exists) ) {

                    // success                    
                    setflashmsg('Supplier Updated Successfully','1');                   
                    
                   

                        
                    

                } else {
                    setflashmsg('Some error occured. Please try again','0');
                        
                }


                    if(Session::get('role_user_name')=='supplier_admin'){

                        return redirect('/supplier/company');

                        }else{

                            return redirect('/supplier');
                        }




        }


        public function update_supplier_password(Request $request)
        {
            $supplier   = User::find($request->hmid);
            $supplier->password = Hash::make($request->newpassword);
            $supplier->save();
            setflashmsg('Password has been reset successfully','1');


                    if(Session::get('role_user_name')=='supplier_admin'){

                        return redirect('/supplier/company');

                        }else{

                            if ($request->supplier_list==2) {
                
                                return redirect('/supplier-list2/');

                            }else{

                                return redirect('/supplier');
                                
                            }
                        }
            
            

        }
}