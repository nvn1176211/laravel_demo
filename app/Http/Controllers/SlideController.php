<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreSlide;
use Illuminate\Support\Str;

class SlideController extends Controller
{
    //
    public function danhsach(){
    	$slide = DB::table('slide')->get();
    	return view('admin.slide.danhsach', ['slide'=>$slide]);
    }

    public function them(){
    	return view('admin.slide.them');
    }

    public function postthem(StoreSlide $request){
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $hinh = Str::random(4).'_'.$name;
            $file->move('upload/slide', $hinh);
        }
        else
        {
            $hinh = '';
        }

        DB::table('slide')->insert([
            'Ten'=>$request->Ten,
            'NoiDung'=>$request->NoiDung,
            'Hinh'=>$hinh,
            'link'=>$request->link
        ]);
        return redirect(route('TSL'))->with('success', 'Thêm thành công');
    }

    public function sua($id){
        $slide = DB::table('slide')->find($id);
        return view('admin.slide.sua', ['slide'=>$slide]);
    }

    public function postsua(StoreSlide $request, $id){
        $SlideCu = DB::table('slide')->find($id);
        if($request->hasFile('Hinh'))
        {
            unlink('upload/slide/'.$SlideCu->Hinh);
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $hinh = Str::random(4).'_'.$name;
            $file->move('upload/slide', $hinh);
        }
        else
        {
            $hinh = $SlideCu->Hinh;
        }
        DB::table('slide')->where('id', $id)->update(
            [
                'Ten'=>$request->Ten,
                'NoiDung'=>$request->NoiDung,
                'Hinh'=>$hinh,
                'link'=>$request->link,
            ]
        );
        return redirect(route('SSL', $id))->with('success', 'Sửa thành công');
    }

    public function getxoa($id){
        DB::table('slide')->where('id', $id)->delete();
        return redirect(route('DSSL'))->with('success', 'Xóa thành công!');
    }
}
