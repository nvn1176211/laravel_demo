@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('admin.layout.errors')
                @include('admin.layout.messages')
                <form action="{{route('PTTT')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Thể Loại</label>
                        <select class="form-control" name="idTheLoai" id="TheLoai">
                           @foreach($theloai as $tl)
                            <option value="{{$tl->id}}">{{$tl->Ten}}</option>
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
                        <textarea name="TieuDe" class="ckeditor" id="demo"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea name="TomTat" class="ckeditor" id="demo"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="NoiDung" class="ckeditor" id="demo"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="Hinh">
                    </div>
                    <div class="form-group">
                    	<label>Nổi bật</label><br>
                    	<label class="radio-inline"><input type="radio" name="NoiBat" value="1" checked>Có</label>
                    	<label class="radio-inline"><input type="radio" name="NoiBat" value="0">Không</label>
                    </div><br>
                    <button type="submit" class="btn btn-default">Lưu</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
                <br><br>
            </div>
        </div>
        <!-- /.row -->
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