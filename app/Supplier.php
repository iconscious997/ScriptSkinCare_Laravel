<?php

namespace App;
// use Company;

class Supplier extends Model
{
	protected $table = 'supplier_details';

	// public function companys()
	// {
	// 	return $this->hasMany('App\Company');
	// }

	public function get_company($id)
	{
		// $t = $this->where('user_id', $id)->first()->companys();
		// $t = Supplier::with('companys')->where('user_id', $id)->first();
		$s = $this->where('user_id', $id)->first();
		$c = Company::find( $s->company_id )->first();
		// echo $s->company_id;
		// dd($c);
		return $c;
	}
}
