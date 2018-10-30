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
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            $data = Company::all();
        }

        if ($request->isMethod('post')) {
            
            if (isset($request->business_name) && !empty($request->business_name)) {
                $query[]=['business_name', 'like','%' . $request->business_name. '%'];
            }

            if (isset($request->business_telephone_number) && !empty($request->business_telephone_number)) {
                $query[]=['business_telephone_number', 'like','%'. $request->business_telephone_number.'%'];                
            }

            if (isset($request->website) && !empty($request->website)) {                
                 $query[]=['website', 'like','%'. $request->website.'%'];
            }

            if (isset($request->email) && !empty($request->email)) {                
                 $query[]=['email_address', 'like','%'. $request->email.'%'];
            }

            if (isset($request->status) && !empty($request->status)) {                
                $query[]=['status', '=',$request->status];
            }

            if(isset($query) && !empty($query)){
                $d = Company::
                where($query);

                if (isset($request->create_date) && !empty($request->create_date)) {
                    $d->whereDate('created_date', '=', date("Y-m-d", strtotime($request->create_date)) );                      
                }

                $data = $d->get();

            }else if(isset($request->create_date) && !empty($request->create_date)){

                $data = Company::whereDate('created_date', '=', date("Y-m-d", strtotime($request->create_date)) )->get();
            }else{
                $data = Company::all();
            }
        }
                
        return view('admin.company-list',compact('data','request'));
    }

    public function companyadd() {
        return view('admin.company-add');
    }

    public function companyedit($id){        
       $company = Company::find($id);
       return view('admin.companyedit', compact('company'));
    }

    public function companyinsert(Request $request)
    {        
        $validatedData = $request->validate([
            'registered_business_name'  => 'required',
            'trading_name'              => 'required',
            'abn'                       => 'required',
            'address'                   => 'required',
            'business_telephone'        => 'required|numeric|digits_between:10,12',
            'email_address'             => 'required|email',
            'website'                   => 'required|url',
        ]);

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

        setflashmsg('Record Inserted Successfully','1'); 
        return redirect('/supplier-company-list');
    }   
    
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
        ],[
            'registered_business_name.required'   => 'Registered Business Name is required',
            'trading_name.required'               => 'Trading Name is required',
            'abn.required'                        => 'ABN is required',
            'address.required'                    => 'Address is required',
            'business_telephone.required'         => 'Business Telephone is required',
            'email_address.required'              => 'Email is required',
            'website.required'                    => 'Website is required'               
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

            setflashmsg('Record Updated Successfully','1');

            if($company->exists) {                        
                return redirect('/supplier-company-list');
            }     
    }
}