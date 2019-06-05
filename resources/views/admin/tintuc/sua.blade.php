@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Sửa</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('admin.layout.errors')
                @include('admin.layout.messages')
                <form action="{{route('PSTT', $tintuc->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Thể Loại</label>
                        <select class="form-control" name="idTheLoai" id="TheLoai">
                           @foreach($theloai as $tl)
                            <option 
							@if($tl->id == DB::table('loaitin')->find($tintuc->idLoaiTin)->idTheLoai)
								{{'selected'}}
							@endif
                            value="{{$tl->id}}">{{$tl->Ten}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control" name="idLoaiTin" id="LoaiTin">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <textarea name="TieuDe" class="ckeditor" id="demo">
                        	{{$tintuc->TieuDe}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea name="TomTat" class="ckeditor" id="demo">
                        	{{$tintuc->TomTat}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="NoiDung" class="ckeditor" id="demo">
                        	{{$tintuc->NoiDung}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <p>
                        	<img width="400" src="upload/tintuc/{{$tintuc->Hinh}}" alt="Hinh">
                        </p>
                        <input type="file" class="form-control" name="Hinh">
                    </div>
                    <div class="form-group">
                    	<label>Nổi bật</label><br>
                    	<label class="radio-inline"><input type="radio" name="NoiBat" value="1" 
						@if($tintuc->NoiBat == 1)
							{{'checked'}}
						@endif
                    	>Có</label>
                    	<label class="radio-inline"><input type="radio" name="NoiBat" value="0"
						@if($tintuc->NoiBat == 0)
							{{'checked'}}
						@endif
                    	>Không</label>
                    </div><br>
                    <button type="submit" class="btn btn-default">Lưu</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
                <br><br>
            </div>
        </div>
        {{-- comment --}}
        <div class="row">
            @include('admin.layout.messages')
            <div class="col-lg-12">
                <h1 class="page-header">Bình luận
                    <small>danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comment as $cm)
                        <tr class="odd gradeX" align="center">
                            <td>{{$cm->id}}</td>
                            <td>{{
                            	DB::table('users')->find($cm->idUser)->name
                            }}</td>
                            <td>{{$cm->NoiDung}}</td>
                            <td>{{$cm->created_at}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$cm->idTinTuc}}">Xóa</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('script')
<script>
	$(document).ready(function(){
		var x = $("#TheLoai").val();
		$.get("admin/ajax/GetLoaiTin/"+x, function(data){
			$('#LoaiTin').html(data);
		});
		$('#TheLoai').change(function(){
			var x = $("#TheLoai").val();
			$.get("admin/ajax/GetLoaiTin/"+x, function(data){
				$('#LoaiTin').html(data);
			});
		});
	});
</script>
@endsection