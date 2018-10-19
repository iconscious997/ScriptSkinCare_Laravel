<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use DB;
use App\Company;
use App\Supplier;

class CompanyController extends Controller
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
        $data = Company::all();
        return view('admin.company-list',compact('data'));
    }

    // public function companyadd()
    // {
    //     return view('admin.companyadd');
    // }

    public function companyedit($id)
    {        
       $company = Company::find($id);
       return view('admin.companyedit', compact('company'));

    }

    // public function companyactivedeactive($id,$status){
        
    //     DB::table('client_details')
    //     ->where("client_details.id", '=',  $id)
    //     ->update(['client_details.status'=> $status]);

    //      return redirect('/companys');
    // }

    
    public function companystore(Request $request)
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


            if($company->exists) {
            // success
            
                    return redirect('/supplier-company-list');
                }
     
        }
}
