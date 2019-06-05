<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreTinTuc;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function getxoa($id, $idTinTuc){
        DB::table('comment')->where('id', $id)->delete();
        return redirect(route('STT', $idTinTuc))->with('success', 'Xóa bình luận thành công!');
    }
    public function PostComment($idTinTuc, Request $request){
    	DB::table('comment')->insert(
    		[
    			'idUser'=>Auth::user()->id,
    			'idTinTuc'=>$idTinTuc,
    			'NoiDung'=>$request->NoiDung
    		]
    	);
    	$tt = DB::table('tintuc')->find($idTinTuc);
    	return redirect('tintuc/'.$idTinTuc.'/'.$tt->TieuDeKhongDau.'.html')->with('success', 'Thêm bình luận thành công!');
    }
}
