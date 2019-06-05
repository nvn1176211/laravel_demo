<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use App\theloai;
use App\loaitin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function(){
	$data = collect([]);
	$lt = DB::table('loaitin')->where('idTheLoai', '1')->get();
	foreach($lt as $i){
		$dt = DB::table('tintuc')->where('idLoaiTin', $i->id)->get();
		$data = $data->merge($dt);	
	}
    $data = $data->sortByDesc('id')->take(5);
    $data1 = $data->take(10);
    $fdata = $data->shift();
    $TieuDe = $fdata->TieuDe;
	// echo var_dump($fdata);
	echo var_dump($data);
	// echo var_dump($TieuDe);

});
Route::group(['prefix'=>'admin', 'middleware'=>'LoginMiddleware'], function(){
	Route::prefix('theloai')->group(function(){
		Route::get('them', 'theloaiController@them')->name('ThemTheLoai');
		Route::post('them', 'theloaiController@postthem');
		Route::get('sua/{id}', 'theloaiController@sua');
		Route::post('sua/{id}', 'theloaiController@postsua');
		Route::get('xoa/{id}', 'theloaiController@xoa');
		Route::get('danhsach', 'theloaiController@danhsach')->name('danhsachtheloai');
	});
	Route::prefix('loaitin')->group(function(){
		Route::get('them', 'loaitinController@them')->name('ThemLoaiTin');
		Route::post('them', 'loaitinController@postthem')->name('PTLT');
		Route::get('sua/{id}', 'loaitinController@sua')->name('SLT');
		Route::post('sua/{id}', 'loaitinController@postsua')->name('PSLT');
		Route::get('xoa/{id}', 'loaitinController@xoa');
		Route::get('danhsach', 'loaitinController@danhsach')->name('danhsachloaitin');
	});
	Route::prefix('tintuc')->group(function(){
		Route::get('danhsach', 'tintucController@danhsach')->name('DSTT');
		Route::get('them', 'tintucController@them')->name('TTT');
		Route::post('them', 'tintucController@postthem')->name('PTTT');
		Route::get('sua/{id}', 'tintucController@sua')->name('STT');
		Route::post('sua/{id}', 'tintucController@postsua')->name('PSTT');
		Route::get('xoa/{id}', 'tintucController@getxoa');
		
	});
	Route::prefix('comment')->group(function(){
		Route::get('xoa/{id}/{idTinTuc}', 'CommentController@getxoa');
		
	});
	Route::prefix('user')->group(function(){
		Route::get('danhsach', 'UserController@danhsach')->name('DSU');
		Route::get('them', 'UserController@them')->name('TU');
		Route::post('them', 'UserController@postthem')->name('PTU');
		Route::get('sua/{id}', 'UserController@sua')->name('SU');
		Route::post('sua/{id}', 'UserController@postsua')->name('PSU');
		Route::get('xoa/{id}', 'UserController@getxoa');
	});
	Route::prefix('slide')->group(function(){
		Route::get('danhsach', 'SlideController@danhsach')->name('DSSL');
		Route::get('them', 'SlideController@them')->name('TSL');
		Route::post('them', 'SlideController@postthem')->name('PTSL');
		Route::get('sua/{id}', 'SlideController@sua')->name('SSL');
		Route::post('sua/{id}', 'SlideController@postsua')->name('PSSL');
		Route::get('xoa/{id}', 'SlideController@getxoa');
	});
	Route::get('ajax/GetLoaiTin/{id}', 'AjaxController@GetLoaiTin');
});

Route::get('admin/dangnhap', 'UserController@GetDangNhapAdmin')->name('DN');
Route::post('admin/dangnhap', 'UserController@PostDangNhapAdmin')->name('PDN');
Route::get('admin/dangxuat', 'UserController@GetDangXuat')->name('DX');

Route::get('trangchu', 'PagesController@TrangChu')->name('TrangChu');
Route::get('lienhe', 'PagesController@LienHe')->name('LienHe');
Route::get('loaitin/{id}/{TenKhongDau}.html', 'PagesController@LoaiTin')->name('LoaiTin');
Route::get('tintuc/{id}/{TieuDeKhongDau}.html', 'PagesController@TinTuc')->name('TinTuc');
Route::get('dangnhap', 'PagesController@GetDangNhap');
Route::post('dangnhap', 'PagesController@PostDangNhap');
Route::get('dangxuat', 'PagesController@GetDangXuat');
Route::post('comment/{idTinTuc}', 'CommentController@PostComment');

Route::get('nguoidung', 'PagesController@GetNguoiDung');
Route::post('nguoidung', 'PagesController@PostNguoiDung');

Route::get('dangky', 'PagesController@GetDangKy');
Route::post('dangky', 'PagesController@PostDangKy');

Route::get('timkiem', 'PagesController@TimKiem');