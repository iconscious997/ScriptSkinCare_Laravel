<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Role;
use App\User;
use App\Permission;
use App\PermissionRole;

class PermissionController extends Controller
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

    public function supplierpermission()
    {
    	// get roles
    	$roles = Role::where('user_type',1)->get();
    	$permissions = Permission::where('role_type',1)->get();
        $permissionsrole = PermissionRole::get();
        $user = User::all();
    	return view( 'admin.supplierpermission', compact('roles','permissions', 'permissionsrole', 'user') );
    }

    public function supplierpermissionstore(Request $request)
    {
        // dd($request);
        // dd($request->supplier_admin[0]);
        // delete permission for supplier_admin
        $s = Role::where('name','supplier_admin')->first();
        DB::statement("DELETE FROM permission_role WHERE role_id = '$s->id'");
        // delete permission for product_manager
        $p = Role::where('name','product_manager')->first();
        DB::statement("DELETE FROM permission_role WHERE role_id = '$p->id'");
        // delete permission for brand_manager
        $b = Role::where('name','brand_manager')->first();
        DB::statement("DELETE FROM permission_role WHERE role_id = '$b->id'");
        // add permission for supplier_admin
        if(!empty($request->supplier_admin)){
            foreach ($request->supplier_admin as $sup) {
                $ss = explode('_',$sup);
                PermissionRole::create([
                    'permission_id' => $ss[1],
                    'role_id'       => $ss[0],
                    'status'        => 0,
                    'created_date'  => date('Y-m-d H:i:s'),
                    'created_by'    => \Auth::user()->id,
                    'modified_by'   => \Auth::user()->id,
                ]);
            }
        }
        // add permission for product_manager
        if(!empty($request->product_manager)){
            foreach ($request->product_manager as $pro) {
                $pp = explode('_',$pro);
                PermissionRole::create([
                    'permission_id' => $pp[1],
                    'role_id'       => $pp[0],
                    'status'        => 0,
                    'created_date'  => date('Y-m-d H:i:s'),
                    'created_by'    => \Auth::user()->id,
                    'modified_by'   => \Auth::user()->id,
                ]);
            }
        }
        
        // add permission for brand_manager
        if(!empty($request->brand_manager)){    
            foreach ($request->brand_manager as $bm) {
                $brm = explode('_',$bm);
                PermissionRole::create([
                    'permission_id' => $brm[1],
                    'role_id'       => $brm[0],
                    'status'        => 0,
                    'created_date'  => date('Y-m-d H:i:s'),
                    'created_by'    => \Auth::user()->id,
                    'modified_by'   => \Auth::user()->id,
                ]);
            }
        }

        setflashmsg('Permissions Updated Successfully','1');
        return redirect('/supplierpermission');
    }
}
