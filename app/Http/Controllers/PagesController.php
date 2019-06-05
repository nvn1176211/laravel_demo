<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
use App\Http\Requests\LoginUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\StoreUser;

class PagesController extends Controller
{
    public function __construct(){
        $theloai = DB::table('theloai')->get();
        $slide = DB::table('slide')->get();
        View::share('theloai', $theloai);
        View::share('slide', $slide);
    }
    public function TrangChu(){
       return view('pages.home');
    }
    public function LienHe(){
       return view('pages.lienhe');
    }
    public function LoaiTin($id){
        $loaitin = DB::table('loaitin')->find($id);
        $tintuc = DB::table('tintuc')->where('idLoaiTin', $id)->paginate(5);
       return view('pages.loaitin', ['loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }
    public function TinTuc($id){
        $tintuc = DB::table('tintuc')->find($id);
        $comment = DB::table('comment')->where('idTinTuc', $id)->get();
        return view('pages.tintuc', ['tintuc'=>$tintuc, 'comment'=>$comment]);
    }
    public function GetDangNhap(){
        return view('pages.dangnhap');
    }
    public function PostDangNhap(LoginUser $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('trangchu');
        }else{
            return redirect('dangnhap');
        }
    }
    public function GetDangXuat(){
        Auth::logout();
        return redirect('trangchu');
    }
    public function GetNguoiDung(){
        return view('pages.nguoidung');
    }
    public function PostNguoiDung(UpdateUser $request){
        $id = Auth::user()->id;
        if($request->CheckChangePassword == 'on' ){
            DB::table('users')->where('id', $id)->update([
                  'name'=>$request->name,
                  'password'=>bcrypt($request->password)
              ]);      
        }else{
            DB::table('users')->where('id', $id)->update([
                  'name'=>$request->name
              ]);  
        }

        return redirect('nguoidung')->with('success', 'Sửa thành công!');
        // echo $id;
    }
    public function GetDangKy(){
        return view('pages.dangky');
    }
    public function PostDangKy(StoreUser $request){
        DB::table('users')->insert(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'quyen'=>0,
                'password'=>bcrypt($request->password)
            ]
        );
        return redirect('dangky')->with('success', 'Đăng ký thành công!');
    }
    public function TimKiem(Request $request){
        // $value = DB::table('tintuc')->where('TieuDe', 'like', '%'.$request->tukhoa.'%')->paginate(5);
        $value = DB::table('tintuc')->where('TieuDe', 'like', '%'.$request->tukhoa.'%')->orWhere('TomTat', 'like', '%'.$request->tukhoa.'%')->paginate(5);
        return view('pages.timkiem', ['value'=>$value, 'tukhoa'=>$request->tukhoa]);
    }
}
