<?php

if( !function_exists('setflashmsg') ) {
	function setflashmsg($msg,$type = '1') {
		if($type == '1') {
			request()->session()->flash('notify-success', $msg);
		} else {
			request()->session()->flash('notify-error', $msg);
		}
	}
}

if( !function_exists('covertDateServer') ) {
	function covertDateServer($d) {
		return date('Y-m-d', strtotime($d));
	}
}

if( !function_exists('showDate') ) {
	function showDate($d) {
		return date('d-m-Y', strtotime($d));
	}
}