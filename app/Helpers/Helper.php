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