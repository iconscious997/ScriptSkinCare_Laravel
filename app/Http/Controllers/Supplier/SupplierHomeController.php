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

	public function productadd()
	{
		return view('supplier.product.add');
	}

	public function company()
	{
		$data = $all_roles = [];
		return view('supplier.product.list', compact('data', 'all_roles') );
	}

	public function companyadd()
	{
		return view('supplier.product.add');
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
