<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AjaxController extends Controller
{
    //
    public function GetLoaiTin($id){
    	$loaitin = DB::table('loaitin')->where('idTheLoai', $id)->get();
    	foreach($loaitin as $lt){
    		echo '<option value="'.$lt->id.'">'.$lt->Ten.'</option>';
    	}
    }
}
