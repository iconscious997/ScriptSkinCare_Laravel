<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use Validator;
use App\Supplier;
use App\Brand;
use App\Mymodel\Supplier\Productline;
use App\Mymodel\Supplier\Product;

class SupplierHomeController extends Controller
{
	public function index() {
		return view('supplier.supplierdashboard');
	}

	public function product()
	{
		$data = $all_roles = [];
		return view('supplier.product.list', compact('data', 'all_roles') );
	}

	public function productstep1()
	{
		// get company id for current user
		$s = Supplier::where('user_id', \Auth::user()->id)->first();
		// get brands list
		$brands = Brand::where('brand_company_id', $s->company_id)->get();
		// get product line list
		if( Session::has('productstep1') ) {
			$product = Product::find(Session::get('productstep1'));
			$brand_id = $product->brand_id;
			$proline = Productline::where('brand_id',$brand_id)->get();
			return view('supplier.product.productstep1', compact('brands', 'product', 'proline') );
		}
		// $proline = Productline::find( $id );
		return view('supplier.product.productstep1', compact('brands') );
	}

	public function productstep1store(Request $request)
	{
		
		if( !empty( $request->id ) && $request->check_data == 'update' ) {
			// check for validation
			$validatedData = $request->validate([
				'brand_id'     		=> 'required',
				'product_line_id'	=> 'required',
				'product_name'     	=> 'required',
				'product_code'     	=> 'required',
				'product_size'     	=> 'required',
			],[
				'brand_id.required'			=> "Brand Name is Required",
				'product_line_id.required'	=> "Product Line is Required"
			]);

			if ($request->file('product_image')) {
				$randomNumber = time()."_".rand(1000, 9999);

				$imageName = \Auth::user()->id.'_product_'.$randomNumber.'_'.$request->file('product_image')->getClientOriginalExtension();

				$request->file('product_image')->move(
					base_path() . '/public/images/product', $imageName
				);
			} else {
				$imageName = $request->old_image_name;
			}
			$product = Product::find($request->id);
			$product->brand_id 			= $request->brand_id;
			$product->product_line_id 	= $request->product_line_id;
			$product->product_name 		= $request->product_name;
			$product->product_code 		= $request->product_code;
			$product->product_size 		= $request->product_size;
			$product->product_image 	= $imageName;
			$product->product_text 		= $request->product_text;
			$product->save();
			setflashmsg('Record Updated Successfully','1');
			return redirect()->route('supplierproductstep2');
		} else {
			// check for validation
			$validatedData = $request->validate([
				'brand_id'     		=> 'required',
				'product_line_id'	=> 'required',
				'product_name'     	=> 'required',
				'product_code'     	=> 'required',
				'product_size'     	=> 'required',
				'product_image'     => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
			],[
				'brand_id.required'			=> "Brand Name is Required",
				'product_line_id.required'	=> "Product Line is Required"
			]);

			if ($request->file('product_image')) {
				$randomNumber = time()."_".rand(1000, 9999);

				$imageName = \Auth::user()->id.'_product_'.$randomNumber.'_'.$request->file('product_image')->getClientOriginalExtension();

				$request->file('product_image')->move(
					base_path() . '/public/images/product', $imageName
				);

			} else {
				$imageName='img_avatar1.png';
			}
			// now add data to supplier_details table
			$product = Product::create([
				'brand_id'              => $request->brand_id,
				'product_line_id'       => $request->product_line_id,
				'product_name'     		=> $request->product_name,
				'product_code'     		=> $request->product_code,
				'product_size'     		=> $request->product_size,
				'product_image'			=> $imageName,
				'product_text'			=> $request->product_text,
				'status'                => 0,
				'created_date'          => date('Y-m-d H:i:s'),
				'created_by'            => \Auth::user()->id,
				'modified_by'           => \Auth::user()->id,
			]);

			// dd($product);
			if( !empty($product->exists) ) {
	            // success
				Session::put('productstep1', $product->id);
				setflashmsg('Record Inserted Successfully','1');
				return redirect()->route('supplierproductstep2');
			} else {
				setflashmsg('Some error occured. Please try again','0');
				return redirect()->route('supplierproductstep1');
			}

		}
	}

	public function getproductlinebybrand(Request $request)
	{
		$brand_id = $request->brand_id;
		$proline = Productline::where('brand_id',$brand_id)->get();
		$output = '<option value="" disabled selected>Please select your product line</option>';
		foreach($proline as $row) {
			$output .= '<option value="'.$row->id.'">'.$row->productline_name.'</option>';
		}
		echo $output;
	}

	public function productstep2()
	{
		return view('supplier.product.productstep2');
	}

	public function productstep3()
	{
		return view('supplier.product.productstep3');
	}

	public function productstep4()
	{
		return view('supplier.product.productstep4');
	}

	public function productstep5()
	{
		return view('supplier.product.productstep5');
	}

	public function productstep6()
	{
		return view('supplier.product.productstep6');
	}

	public function productstep7()
	{
		return view('supplier.product.productstep7');
	}

	public function productstep8()
	{
		return view('supplier.product.productstep8');
	}

	public function productstep9()
	{
		return view('supplier.product.productstep9');
	}

	public function productstep10()
	{
		return view('supplier.product.productstep10');
	}

	public function company(Request $request)
	{
		

            $open = false;
		if ($request->isMethod('post')) {
			$d = Supplier::join('company_details','supplier_details.company_id','=','company_details.id');
			if( !empty($request->business_name) ) {
				$open = true;
				$d->where('company_details.business_name', 'LIKE', '%'.$request->business_name.'%');
			}
			if( !empty($request->trading_name) ) {
				$open = true;
				$d->where('company_details.trading_name', 'LIKE', '%'.$request->trading_name.'%');
			}


			if( !empty($request->business_telephone_number) ) {
				$open = true;
				$d->where('company_details.business_telephone_number', 'LIKE', '%'.$request->business_telephone_number.'%');
			}
			if( !empty($request->email) ) {
				$open = true;
				$d->where('company_details.email_address', 'LIKE', '%'.$request->email.'%');
			}
			if( !empty($request->website) ) {
						$open = true;
						$d->where('company_details.website', 'LIKE', '%'.$request->website.'%');
					}

			if(isset($request->status) ) {

				$open = true;
				$d->where('company_details.status', '=', $request->status);

			}
			if ( !empty($request->create_date) ) {
				$open = true;
				$d->whereDate('company_details.created_date', '=', covertDateServer($request->create_date) );
			}

			$data = $d->where('supplier_details.id','=',\Auth::user()->id)->get();


		} else {

			  $data=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                ->join('role_user','supplier_details.user_id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->join('users','supplier_details.user_id','=','users.id')
                ->select('supplier_details.id','supplier_details.company_id','supplier_details.brand_ids','supplier_details.first_name','supplier_details.last_name','supplier_details.position','roles.label','users.email','company_details.business_name','company_details.address','company_details.trading_name','company_details.business_telephone_number','company_details.website','supplier_details.status as sstatus','users.id as user_id')
                ->where('supplier_details.id','=',\Auth::user()->id)
                ->get();
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
         

		

		return view('supplier.company.list', compact('data', 'open','request','all_brand_name') );
	}

	public function companyadd()
	{
		return view('supplier.product.add');
	}

	public function companyedit($id, Request $request)
	{

		if ($request->isMethod('post')) {




		}else{

			$company=Supplier::join('company_details','supplier_details.company_id','=','company_details.id')
                ->select('company_details.*')
                ->where('supplier_details.id','=',\Auth::user()->id)
                ->where('company_details.id','=',$id)
                ->first();

                
		return view('supplier.company.edit', compact('company','request') );

		}
		
	}
	public function brand(Request $request)
	{
		$open = false;
		if ($request->isMethod('post')) {
			$d = Brand::join('company_details','brands.brand_company_id','=','company_details.id');
			if( !empty($request->business_name) ) {
				$open = true;
				$d->where('company_details.business_name', 'LIKE', '%'.$request->business_name.'%');
			}
			if( !empty($request->brand_name) ) {
				$open = true;
				$d->where('brands.brand_name', 'LIKE', '%'.$request->brand_name.'%');
			}
			if( !empty($request->status) ) {
				$open = true;
				$d->where('brands.status', '=', $request->status);
			}
			if ( !empty($request->create_date) ) {
				$open = true;
				$d->whereDate('brands.created_date', '=', covertDateServer($request->create_date) );
			}
			$data = $d->get();
		} else {
			$data = Brand::join('company_details','brands.brand_company_id','=','company_details.id')->select('brands.brand_name','brands.id','brands.brand_logo','company_details.business_name')->get();
		}
		return view('supplier.brand.list', compact('data', 'open') );
	}

	public function brandadd()
	{	
		// echo \Auth::user()->id;
		$s = new Supplier;
		$company = $s->get_company( \Auth::user()->id );
		return view('supplier.brand.add', compact('company'));
	}

	public function brandaddstore(Request $request)
	{
    	// check for validation
		$validatedData = $request->validate([
			'brand_name'     => 'required',
			'company_id'     => 'required',
			'brand_logo'     => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
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
			'brand_company_id'         => $request->company_id,
			'brand_logo'               => $imageName,
			'user_added_by'            => \Auth::user()->id,
			'approved_by'              => 0,
			'status'                   => 0,
			'created_date'             => date('Y-m-d H:i:s'),
			'created_by'               => \Auth::user()->id,
			'modified_by'              => \Auth::user()->id,
		]);

		if( !empty($brands->exists) ) {
            // success
			setflashmsg('Record Inserted Successfully','1');
		} else {
			setflashmsg('Some error occured. Please try again','0');
		}
		return redirect('/supplier/brand');
	}

	public function brandedit($id, Request $request)
	{
		if ($request->isMethod('post')) {
			// check for validation
			$validatedData = $request->validate([
				'brand_name'     => 'required',
				'company_id'     => 'required',
				'brand_logo'     => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
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
			$brands = Brand::find($id);
			$brands->brand_name = $request->brand_name;
			// $brands->supplier_parent_id = $request->supplier_parent_id;
			$brands->brand_logo = $imageName;
			$brands->user_added_by = \Auth::user()->id;
			// $brands->approved_by = $request->approved_by;
			$brands->modified_by = \Auth::user()->id;
			$brands->save();

			setflashmsg('Record Updated Successfully','1');
			return redirect()->route('supplierbrand');
		} else {
			$brand = Brand::join('company_details','brands.brand_company_id','=','company_details.id')
			->select('brands.brand_name','brands.id','brands.brand_logo','company_details.business_name','brands.brand_company_id')
			->where('brands.id',$id)
			->first();
			// dd($brand);
			return view('supplier.brand.edit', compact('id', 'brand'));
		}
	}

	public function productline(Request $request)
	{
		$open = false;
		if ($request->isMethod('post')) {
			$d = Productline::join('brands as b','b.id','=','productline.brand_id');
			if( !empty($request->brand_name) ) {
				$open = true;
				$d->where('b.brand_name', 'LIKE', '%'.$request->brand_name.'%');
			}
			if( !empty($request->productline_name) ) {
				$open = true;
				$d->where('productline.productline_name', 'LIKE', '%'.$request->productline_name.'%');
			}
			if( !empty($request->status) ) {
				$open = true;
				$d->where('productline.status', '=', $request->status);
			}
			if ( !empty($request->create_date) ) {
				$open = true;
				$d->whereDate('productline.created_date', '=', covertDateServer($request->create_date) );
			}
			$data = $d->get();
		} else {
			$data = Productline::join('brands as b','b.id','=','productline.brand_id')
			->select('productline.*','b.brand_name')
			->get();
		}
		return view('supplier.productline.list', compact('data', 'open') );
	}

	public function productlineadd(Request $request)
	{
		if ($request->isMethod('post')) {
			// check for validation
			$validatedData = $request->validate([
				'brand_id'       	=> 'required',
				'productline_name'  => 'required',
			],[
				'brand_id.required' => 'Brand Name is Required'
			]);
			$prodline = Productline::create([
				'brand_id'               => $request->brand_id,
				'productline_name'       => $request->productline_name,
				'status'                 => 0,
				'created_date'           => date('Y-m-d H:i:s'),
				'created_by'             => \Auth::user()->id,
				'modified_by'            => \Auth::user()->id,
			]);

			if( !empty($prodline->exists) ) {
	            // success
				setflashmsg('Record Inserted Successfully','1');
			} else {
				setflashmsg('Some error occured. Please try again','0');
			}
			return redirect()->route('supplierproductline');
		}
		// get company id for current user
		$s = Supplier::where('user_id', \Auth::user()->id)->first();
		// get brands list
		$brands = Brand::where('brand_company_id', $s->company_id)->get();
		// dd($brands);
		return view('supplier.productline.add', compact('brands') );
	}

	public function productlineedit($id, Request $request)
	{
		if ($request->isMethod('post')) {
			// check for validation
			$validatedData = $request->validate([
				'brand_id'       	=> 'required',
				'productline_name'  => 'required',
			],[
				'brand_id.required' => 'Brand Name is Required'
			]);
			$proline = Productline::find($id);
			$proline->brand_id = $request->brand_id;
			$proline->productline_name = $request->productline_name;
			$proline->modified_by = \Auth::user()->id;
			$proline->save();

			setflashmsg('Record Updated Successfully','1');
			return redirect()->route('supplierproductline');
		} else {
			// get company id for current user
			$s = Supplier::where('user_id', \Auth::user()->id)->first();
			// get brands list
			$brands = Brand::where('brand_company_id', $s->company_id)->get();
			$proline = Productline::find($id);
			return view('supplier.productline.edit', compact('id', 'brands', 'proline') );
		}
	}
}
