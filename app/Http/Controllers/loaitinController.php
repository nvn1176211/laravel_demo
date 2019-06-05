<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreLoaiTin;
use Illuminate\Support\Str;

class loaitinController extends Controller
{
    //
    public function danhsach(){
    	$loaitin = DB::table('loaitin')->get();
    	return view('admin.loaitin.danhsach', ['loaitin'=>$loaitin]);
    }

    public function them(){
        $theloai = DB::table('theloai')->get();
    	return view('admin.loaitin.them', ['theloai'=>$theloai]);
    }

    public function postthem(StoreLoaiTin $request){
        DB::table('loaitin')->insert(
            [
                'Ten' => $request->Ten,
                'TenKhongDau' => Str::slug($request->Ten),
                'idTheLoai' => $request->idTheLoai
            ]
        );
    	return redirect(route('ThemLoaiTin'))->with('success', 'Thêm thành công!');
    }

    public function sua($id){
        $loaitin = DB::table('loaitin')->find($id);
        $theloai = DB::table('theloai')->get();
    	return view('admin.loaitin.sua', ['loaitin'=>$loaitin, 'theloai'=>$theloai]);
    }

    public function postsua(StoreLoaiTin $request, $id){
    	DB::table('loaitin')->where('id', $id)->update(
            [
                'Ten'=>$request->Ten,
                'TenKhongDau'=>Str::slug($request->Ten),
                'idTheLoai'=>$request->idTheLoai
            ]
        );
    	return redirect(route('SLT', $id))->with('success', 'Sửa thành công!');
    }

    public function xoa($id){
    	DB::table('loaitin')->where('id', $id)->delete();
    	return redirect(route('danhsachloaitin'))->with('success', 'Xóa thành công!');
    }
}
