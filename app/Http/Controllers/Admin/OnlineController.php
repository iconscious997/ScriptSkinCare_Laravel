<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OnlineController extends Controller
{
	public function orders()
	{
		return view('admin.online.orders');
	}

	public function customer()
	{
		return view('admin.online.customers');
	}

	public function coupons()
	{
		return view('admin.online.coupons');
	}

	public function reports()
	{
		return view('admin.online.reports');
	}
}
