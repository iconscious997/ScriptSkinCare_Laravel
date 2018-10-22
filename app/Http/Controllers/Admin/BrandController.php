<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use DB;
use App\Brand;
use App\Company;
use App\Supplier;

class BrandController extends Controller
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
        

                $data = Brand::join('company_details','brands.brand_company_id','=','company_details.id')->select('brands.brand_name','brands.id','brands.brand_logo','company_details.business_name')->get();


        }

        if ($request->isMethod('post')) {

             if (isset($request->business_name) && !empty($request->business_name)) {
                
            
                $query[]=['company_details.business_name', 'like','%' . $request->business_name. '%'];
                    
            }

             if (isset($request->brand_name) && !empty($request->brand_name)) {
                
                 $query[]=['brands.brand_name', 'like','%'. $request->brand_name.'%'];
            }


               if (isset($request->status) && !empty($request->status)) {
                
                $query[]=['brands.status', '=',$request->status];
            }

             if(isset($query) && !empty($query)){

                

                             $d = Brand::join('company_details','brands.brand_company_id','=','company_details.id')
                            ->where($query);
                            if (isset($request->create_date) && !empty($request->create_date)) {
                                        
                        $d->whereDate('created_date', '=', date("Y-m-d", strtotime($request->create_date)) );
                      
                    }

                    $data = $d->get();

            }else if(isset($request->create_date) && !empty($request->create_date)){


                      $data = Brand::join('company_details','brands.brand_company_id','=','company_details.id')
                      ->whereDate('brands.created_date', '=', date("Y-m-d", strtotime($request->create_date)) )
                      ->select('brands.brand_name','brands.id','brands.brand_logo','company_details.business_name')->get();
                

            }else{

                  $data = Brand::join('company_details','brands.brand_company_id','=','company_details.id')->select('brands.brand_name','brands.id','brands.brand_logo','company_details.business_name')->get();
            }



        }

        
        
        return view('admin.brand-list',compact('data','request'));
    }

    // public function brandadd()
    // {
    //     return view('admin.brandadd');
    // }

    public function brandedit($id)
    {        
        $brands_data = Brand::where('id', $id)->first(); 
        $sub_supplier=Supplier::where('company_id', $brands_data->brand_company_id)->get();

         $supplier = Supplier::join('role_user','supplier_details.user_id','=','role_user.user_id')
             ->join('roles','role_user.role_id','=','roles.id')
                ->where('supplier_details.company_id', $brands_data->brand_company_id)
                ->where('roles.name', "supplier_admin")
                ->select('supplier_details.id','supplier_details.first_name','supplier_details.last_name')->get()->toArray();

                 $result = Supplier::where('company_id', $brands_data->brand_company_id)->select('id','brand_ids')->get()->toArray();
          
            foreach ($result as  $value) {
                    
                    if ($value['brand_ids']!=null) {
                        

                        $tmp = explode(',', $value['brand_ids']);

                        if (in_array($id, $tmp)) {
                            
                             $update_supplier[]= $value['id'];
                        }


                    }
                    
                    
            }
        // echo $brands_data->brand_company_id;
        // dd($supplier_data);
        
        return view('admin.brandedit',compact('brands_data','supplier','sub_supplier','update_supplier'));
    }

    // public function brandactivedeactive($id,$status){
        
    //     DB::table('client_details')
    //     ->where("client_details.id", '=',  $id)
    //     ->update(['client_details.status'=> $status]);

    //      return redirect('/brands');
    // }

    
    public function brandstore(Request $request)
    {   

           
        if( !empty( $request->id ) ) { 

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

            $sub_supplier = Supplier::where('company_id', $brands->brand_company_id)->get();
                 
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
            return redirect('/supplier-brand-list'); 

        
    }


     
}
}
