<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\LoginUser;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function danhsach(){
    	$user = DB::table('users')->get();
    	return view('admin.user.danhsach', ['user'=>$user]);
    }

    public function them(){
    	return view('admin.user.them');
    }

    public function postthem(StoreUser $request){
    	DB::table('users')->insert(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'quyen'=>$request->quyen,
                'password'=>bcrypt($request->password)
            ]
        );
    	return redirect(route('TU'))->with('success', 'Thêm thành công!');
    }

    public function sua($id){
    	$user = DB::table('users')->find($id);
    	return view('admin.user.sua', ['user'=>$user]);
    }

    public function postsua(UpdateUser $request, $id){
        if($request->CheckChangePassword == 'on' ){
            DB::table('users')->where('id', $id)->update([
                  'name'=>$request->name,
                  'quyen'=>$request->quyen,
                  'password'=>bcrypt($request->password)
              ]);      
        }else{
            DB::table('users')->where('id', $id)->update([
                  'name'=>$request->name,
                  'quyen'=>$request->quyen
              ]);  
        }

    	return redirect(route('SU', $id))->with('success', 'Sửa thành công!');
    }

    public function getxoa($id){
        DB::table('comment')->where('idUser', $id)->delete();
    	DB::table('users')->where('id', $id)->delete();
    	return redirect(route('DSU'))->with('success', 'Xóa thành công!');
    }

    public function GetDangNhapAdmin(){
        return view('admin.login');
    }

    public function PostDangNhapAdmin(LoginUser $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect(route('DSU'))->with('success', 'Đăng nhập thành công!');
        }else{
            return redirect(route('DN'))->with('warning', 'Đăng nhập thất bại!');
        }
    }

    public function GetDangXuat(){
        Auth::logout();
        return redirect(route('DN'));
    }
}
