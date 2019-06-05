<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTheLoai;
use Illuminate\Support\Str;
use DB;

class theloaiController extends Controller
{
    //
    public function danhsach(){
    	$theloai = DB::table('theloai')->get();
    	return view('admin.theloai.danhsach', ['theloai'=>$theloai]);
    }

    public function them(){
    	return view('admin.theloai.them');
    }

    public function postthem(StoreTheLoai $request){
        DB::table('theloai')->insert([
            'Ten' => $request->Ten,
            'TenKhongDau' => Str::slug($request->Ten)
        ]);
    	return redirect(route('ThemTheLoai'))->with('success', 'Thêm thể loại thành công!');
    }

    public function sua($id){
    	$theloai = DB::table('theloai')->find($id);
    	return view('admin.theloai.sua', ['theloai'=>$theloai]);
    }

    public function postsua(StoreTheLoai $request, $id){
        DB::table('theloai')->where('id', $id)->update([
            'Ten' => $request->Ten,
            'TenKhongDau' => Str::slug($request->Ten)
        ]);
    	return redirect(route('danhsachtheloai'))->with('success', 'Sửa thể loại thành công!');
    }

    public function xoa($id){
    	DB::table('theloai')->where('id', $id)->delete();
    	return redirect(route('danhsachtheloai'))->with('success', 'Xóa thể loại thành công!');
    }
}
