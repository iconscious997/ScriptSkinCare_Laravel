@extends('layouts.master')
@section('content')
<form action="{{ url('/supplierpermissionstore') }}" method="POST" id="first" enctype="multipart/form-data">
    @csrf
    <div class="wizard">
        <div class="container">
            <div class="row">
                <h3 class="text-center">Manage Role Permissions</h3>
            </div>
        </div>
    </div>

    <div class="content-fix">
        <div class="container">
            <div class="row">
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-8">
                    <div class="clearfix">&nbsp;</div>
                    {{-- @if( !empty($roles) )
                    <h4 class="bold-600 mb-10">Manage Roles</h4>
                    <div class="clearfix">&nbsp;</div>
                    <table class="table">
                        <thead>
                            <th>Role</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach( $roles as $role )
                                <tr>
                                    <td>{{ $role->label }}</td>
                                    <td><a href="{{ url('/supplierpermission/'.$role->id) }}">
                                        <button type='button' class='btn btn-default'> Edit</button>
                                    </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif --}}
                    @if( !empty($permissions) )
                    {{-- @php echo '<pre>' @endphp --}}
                        <h4 class="bold-600 mb-10">Manage Permissions</h4>
                        <div class="clearfix">&nbsp;</div>
                        <table class="table">
                            <thead>
                                <th>Permission</th>
                                @foreach( $roles as $role )
                                <th>{{ $role->label }}</th>
                                @endforeach
                            </thead>
                            <tbody>
                                @foreach( $permissions as $permission )
                                <tr>
                                    <td>{{ $permission->label }}</td>
                                    @foreach( $roles as $role )
                                    @php 
                                        // print_r($permissionsrole->where('permission_id',$permission->id)->where('role_id',$role->id));
                                    @endphp
                                    <td><input type="checkbox" @if($role->permissions->contains($permission)) checked @endif name="{{ $role->name }}[]" value="{{ $role->id.'_'.$permission->id }}"></td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-offset-2 col-md-8 text-center mt-20 mb-20">
                                <button class="btn btn-dark btn-pad selected" type="submit"> SAVE CHANGES</button>
                            </div>
                            <div class="col-md-2">&nbsp;</div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-2">&nbsp;</div>
                </div>
            </div>
        </div>

    </form>
    <div class="footer">
        <div class="conatiner text-center">
            <div class="row">
                <div class="col-md-2 col-sm-2">&nbsp;</div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                           <a href="{{ url('/user-supplier-add') }}"> <button class="btn btn-default btn-block"> + ADD NEW SUPPLIER</button></a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                           <a href="{{ url('/add-new-user') }}"><button class="btn btn-default btn-block"> + ADD A NEW USER</button></a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <a href="{{ url('/add-new-brand') }}"><button class="btn btn-default btn-block"> + ADD A NEW BRAND</button></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2">&nbsp;</div>
            </div>
        </div>
    </div>
    @endsection