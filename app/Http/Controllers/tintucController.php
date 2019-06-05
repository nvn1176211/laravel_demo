<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreTinTuc;
use Illuminate\Support\Str;

class tintucController extends Controller
{
    //
    public function danhsach(){
    	$tintuc = DB::table('tintuc')->get();
    	return view('admin.tintuc.danhsach', ['tintuc'=>$tintuc]);
    }

    public function them(){
        $theloai = DB::table('theloai')->get();
    	return view('admin.tintuc.them', ['theloai'=>$theloai]);
    }

    public function postthem(StoreTinTuc $request){
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $hinh = Str::random(4).'_'.$name;
            $file->move('upload/tintuc', $hinh);
        }
        else
        {
            $hinh = '';
        }

        DB::table('tintuc')->insert([
            'TieuDe'=>$request->TieuDe,
            'TieuDeKhongDau'=>Str::slug($request->TieuDe),
            'TomTat'=>$request->TomTat,
            'NoiDung'=>$request->NoiDung,
            'Hinh'=>$hinh,
            'NoiBat'=>$request->NoiBat,
            'SoLuotXem'=>0,
            'idLoaiTin'=>$request->idLoaiTin
        ]);
        return redirect(route('TTT'))->with('success', 'Thêm tin tức thành công');
    }

    public function sua($id){
        $theloai = DB::table('theloai')->get();
        $tintuc = DB::table('tintuc')->find($id);
        $comment = DB::table('comment')->where('idTinTuc', $tintuc->id)->get();
        return view('admin.tintuc.sua', ['theloai'=>$theloai, 'tintuc'=>$tintuc, 'comment'=>$comment]);
    }

    public function postsua(StoreTinTuc $request, $id){
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $hinh = Str::random(4).'_'.$name;
            $file->move('upload/tintuc', $hinh);
        }
        DB::table('tintuc')->where('id', $id)->update(
            [
                'TieuDe'=>$request->TieuDe,
                'TieuDeKhongDau'=>Str::slug($request->TieuDe),
                'TomTat'=>$request->TomTat,
                'NoiDung'=>$request->NoiDung,
                'Hinh'=>$hinh,
                'NoiBat'=>$request->NoiBat,
                'SoLuotXem'=>0,
                'idLoaiTin'=>$request->idLoaiTin            
            ]
        );
        return redirect(route('STT', $id))->with('success', 'Sửa thành công');
    }

    public function getxoa($id){
        DB::table('tintuc')->where('id', $id)->delete();
        return redirect(route('DSTT'))->with('success', 'Xóa thành công!');
    }
}
