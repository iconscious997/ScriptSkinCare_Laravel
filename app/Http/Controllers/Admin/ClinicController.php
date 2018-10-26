<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use DB;
use App\Clinic;
use App\Supplier;

class ClinicController extends Controller
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

            $data = Clinic::all();
        }

        if ($request->isMethod('post')) {


            
            if (isset($request->clinic_name) && !empty($request->clinic_name)) {
               
                $query[]=['clinic_name', 'like','%' . $request->clinic_name. '%'];
                    
            }
            if (isset($request->telephone_number) && !empty($request->telephone_number)) {
                
                
                $query[]=['telephone_number', 'like','%'. $request->telephone_number.'%'];
                
            }

             if (isset($request->clinic_website) && !empty($request->clinic_website)) {
                
                 $query[]=['clinic_website', 'like','%'. $request->clinic_website.'%'];
            }
              if (isset($request->email) && !empty($request->email)) {
                
                 $query[]=['clinic_email', 'like','%'. $request->email.'%'];

            }

             if (isset($request->status) && !empty($request->status)) {
                
                $query[]=['clinic_status', '=',$request->status];
            }

            if(isset($query) && !empty($query)){

                

                             $d = Clinic::
                            where($query);
                            if (isset($request->create_date) && !empty($request->create_date)) {
                                        
                        $d->whereDate('created_date', '=', date("Y-m-d", strtotime($request->create_date)) );
                      
                    }

                    $data = $d->get();
                    

            }else if(isset($request->create_date) && !empty($request->create_date)){



                    $data = Clinic::whereDate('created_date', '=', date("Y-m-d", strtotime($request->create_date)) )->get();



            }else{

                $data = Clinic::all();
            }

           
                    

        }
        // die();
        
        return view('admin.retail-site-list',compact('data','request'));

    }

    public function clinicadd()
    {
        return view('admin.new-retail');
    }

    public function clinicedit($id)
    {        
       $retailsite = Clinic::find($id);
       return view('admin.retail-site-edit', compact('retailsite'));

    }

    // public function clinicactivedeactive($id,$status){
        
    //     DB::table('client_details')
    //     ->where("client_details.id", '=',  $id)
    //     ->update(['client_details.status'=> $status]);

    //      return redirect('/clinics');
    // }

    
    public function clinicstore(Request $request)
    {   

           $validatedData = $request->validate([
            'clinic_name'               => 'required',
            'trading_name'              => 'required',
            'clinic_location'           => 'required',
            'telephone_number'          => 'required|numeric|digits_between:10,12',
            'clinic_email'              => 'required|email',
            'clinic_website'            => 'required|url',
        ]);
        
            $clinic = Clinic::find($request->id);
            $clinic->clinic_name                 = $request->clinic_name;
            $clinic->trading_name                  = $request->trading_name;
            $clinic->clinic_location                       = $request->clinic_location;
            $clinic->telephone_number     = $request->telephone_number;
            $clinic->clinic_email                 = $request->clinic_email;
            $clinic->clinic_website                       = $request->clinic_website;
            $clinic->modified_by                   = \Auth::user()->id;
            $clinic->save();

            // 
            setflashmsg('Record Updated Successfully','1');   

            return redirect('/retail-site-list'); 
     
    }


    public function clinicinsert(Request $request)
    {

          $validatedData = $request->validate([
            'clinic_name'               => 'required',
            'trading_name'              => 'required',
            'clinic_location'           => 'required',
            'telephone_number'          => 'required|numeric|digits_between:10,12',
            'clinic_email'              => 'required|email',
            'clinic_website'            => 'required|url',
        ]);


        
            $clinic = Clinic::create([
                'clinic_name'                => request('clinic_name'),
                'trading_name'               => request('trading_name'),
                'clinic_location'            => request('clinic_location'),
                'telephone_number'           => request('telephone_number'),
                'clinic_email'               => request('clinic_email'),
                'clinic_website'             => request('clinic_website'),
                'clinic_status'               => 0,
                'created_date'               => date('Y-m-d H:i:s'),
                'created_by'                 => \Auth::user()->id,
                'modified_by'                => \Auth::user()->id,
            ]);

            setflashmsg('Record Inserted Successfully','1');

            return redirect('/retail-site-list'); 

    }
}
