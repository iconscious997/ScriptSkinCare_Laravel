<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use Validator;
use App\Supplier;
use App\Brand;

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
    	return view('supplier.product.productstep1');
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



    public function company()
    {
    	$data = $all_roles = [];
    	return view('supplier.product.list', compact('data', 'all_roles') );
    }

    public function companyadd()
    {
    	return view('supplier.product.add');
    }

    public function brand()
    {
    	// $data = $all_roles = [];
    	$data = Brand::join('company_details','brands.brand_company_id','=','company_details.id')->select('brands.brand_name','brands.id','brands.brand_logo','company_details.business_name')->get();
    	return view('supplier.brand.list', compact('data') );
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

    public function productline()
    {
    	$data = $all_roles = [];
    	return view('supplier.product.list', compact('data', 'all_roles') );
    }

    public function productlineadd()
    {
    	return view('supplier.product.add');
    }
}
