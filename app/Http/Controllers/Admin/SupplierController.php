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
            'business_telephone'        => 'required|numeric',
            'email_address'             => 'required|email',
            'website'                   => 'required|url',
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
            setflashmsg('Record Updated Successfully','1');
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
        }
        /*
        if ($validatedData->fails())
        {
            $errors = [];
            if($validatedData->errors()->has('registered_business_name')) {
                // add this to array
                $errors['registered_business_name'] = $validatedData->errors()->first('registered_business_name');
            }
            if($validatedData->errors()->has('trading_name')) {
                // add this to array
                $errors['trading_name'] = $validatedData->errors()->first('trading_name');
            }
            if($validatedData->errors()->has('abn')) {
                // add this to array
                $errors['abn'] = $validatedData->errors()->first('abn');
            }
            if($validatedData->errors()->has('address')) {
                // add this to array
                $errors['address'] = $validatedData->errors()->first('address');
            }
            if($validatedData->errors()->has('business_telephone')) {
                // add this to array
                $errors['business_telephone'] = $validatedData->errors()->first('business_telephone');
            }
            if($validatedData->errors()->has('email_address')) {
                // add this to array
                $errors['email_address'] = $validatedData->errors()->first('email_address');
            }
            if($validatedData->errors()->has('website')) {
                // add this to array
                $errors['website'] = $validatedData->errors()->first('website');
            }
            return response()->json([
                'error' => 1, 
                'msg'   => 'validate',
                'data'  => [ 'errors' => $errors ]
            ]);
            exit;
        }
        */
        
        if($company->exists) {
            // success
            Session::put('first', $company->id);
            return redirect('/supplierstep2');
        }
        
        // redirect('back');

    }

    public function supplierstep2($id='')
    {
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

// SELECT supplier_details.id,supplier_details.supplier_name FROM `supplier_details` INNER JOIN role_user ON supplier_details.user_id=role_user.user_id INNER JOIN roles ON role_user.role_id=roles.id WHERE supplier_details.company_id=16 AND roles.name="supplier_admin"

         

            
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
                'business_tel_number'       => 'required|numeric',
                'business_address_line_1'   => 'required',
                'user_role'                 => 'required',
                // 'business_address_line_2'             => 'required|email',
                'mobile_number'             => 'required|numeric',
            ],[
                'business_address_line_1.required' => 'Business Address is Required'
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
        } else {


            // check for validation
            $validatedData = $request->validate([
                'first_name'                => 'required',
                'last_name'                 => 'required',
                'business_tel_number'       => 'required|numeric',
                'business_address_line_1'   => 'required',
                'user_role'                 => 'required',
                // 'business_address_line_2'             => 'required|email',
                'mobile_number'             => 'required|numeric',
                // check for available email address in user table
                'email'                     => 'required|string|email|max:255|unique:users',
                'password'                  => 'required|string',
            ],[
                'business_address_line_1.required' => 'Business Address is Required'
            ]);


           if(isset($request->user_parent_id)){


                if ($request->user_role==3 && $request->user_selected_role==3) {
            
                   
                            # code...
                    setflashmsg('Please Select Different User and User Role 1','2');
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

                
                if( !Session::has('parent_id') ) {

                    Session::put('parent_id', $supplier->id);

                }
            
            Session::put('second', $supplier->id);

            });
        }




        // if( !empty($supplier->exists) ) {
            // success
            
            if( $request->savestep == 0 ) {
                return redirect('/supplierstep3');
            } else {
           
                return redirect('/supplierstep2');
            }
        // } else {
          
        //     return redirect('/supplierstep2');
        // }
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

        // $supplier = Supplier::where('id', Session::get('parent_id'))->get();
         $supplier = Supplier::join('role_user','supplier_details.user_id','=','role_user.user_id')
             ->join('roles','role_user.role_id','=','roles.id')
                ->where('supplier_details.company_id', Session::get('first'))
                ->where('roles.name', "supplier_admin")
                ->select('supplier_details.id','supplier_details.first_name','supplier_details.last_name')->get()->toArray();

        $sub_supplier = Supplier::where('company_id', Session::get('first'))->get();
       
        // Session::put('first', 1);
        // $suppliers = Supplier::all();
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
                // 'created_by'     => 'required',
                'assign_to_user' => 'required',
                'brand_logo'     => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'approved_by'    =>  'required',

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
            $brands->brand_logo = $imageName;
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

                        // echo $sub;
                    }

                    $add_brand      = implode(',', $add_brand_tmp);

                // $pos = array_search($brands->id, $tmp_remove);
                // $result = remove_element($tmp_remove,"'".$brands->id."'");
                // dump($result);
                // $pos;

                $supplier = Supplier::find($value->id);
                $supplier->brand_ids       = $add_brand;
                $supplier->save();
            }

           

            foreach ($request->assign_to_user as $key => $value) {
               

                $supplier = Supplier::find($value);
                $tmp = explode(',', $supplier->brand_ids);
                // dump($tmp);
                if( !in_array($brands->id, $tmp) ) {
                    array_push($tmp, $brands->id);

                    $supplier->brand_ids       = implode(',', $tmp);
                }else if (in_array($brands->id, $tmp))
                {
                     $supplier->brand_ids  =implode(',', $tmp);
                }
                else{
                    
                    $supplier->brand_ids       =$brands->id;
                }
                
                $supplier->save();
            }

              


            setflashmsg('Record Updated Successfully','1');
            return redirect('/supplierstep4'); 

        } else {


            // check for validation
            $validatedData = $request->validate([
                'brand_name'     => 'required',
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
                'brand_logo'               => $imageName,
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

                return redirect('/supplierstep4'); 
            } else {
                setflashmsg('Some error occured. Please try again','0');
                return redirect('/supplierstep3');
            }

        }
        
    }

    public function supplierstep4()
    {


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

    public function supplierList()
    {
         // $data = Supplier::with('alljoindata_supplier')->all();
         // echo $data->alljoindata_supplier->business_name;
        $data=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
            ->join('role_user','supplier_details.user_id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->join('users','supplier_details.user_id','=','users.id')
            ->select('*')->get();

            $i=0;

            $all_brand_name=array();
         foreach ($data as $value) {
                
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

                         
                        
                            // if( $sub!=$brands->id) {
                                // array_push($add_brand_tmp, $sub);

                               
                            // }

                        // echo $sub;
                    }
                    $temp_data=implode(",", $add_brand_tmp);
             // echo $value->brand_ids;
             
             
                }else{

                    $temp_data="-";
                }
             

             array_push($all_brand_name, $temp_data);
              

         }
         // dd($all_brand_name);
         // echo $i;
         //  die();
        return view( 'admin.supplier-list',compact('data','all_brand_name'));
    }

    public function supplierList2()
    {
        return view( 'admin.supplier-list2');
    }
}
