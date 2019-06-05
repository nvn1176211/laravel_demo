@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            @include('admin.layout.messages')
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Tóm tắt</th>
                        <th>Thể loại</th>
                        <th>Loại tin</th>
                        <th>Xem</th>
                        <th>Nổi bật</th>
                        <th>Xóa</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tintuc as $tt)
                        <tr class="odd gradeX" align="center">
                            <td>{{$tt->id}}</td>
                            <td>
                            	<p>{{$tt->TieuDe}}</p>
                            	<img width="100" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                            </td>
                            <td>{{$tt->TomTat}}</td>
                            <td>{{
                                DB::table('theloai')->find(
                                	DB::table('loaitin')->find($tt->idLoaiTin)->idTheLoai
                                )->Ten
                            }}</td>
                            <td>{{
                                DB::table('loaitin')->find($tt->idLoaiTin)->Ten
                            }}</td>
                            <td>{{$tt->SoLuotXem}}</td>
                            <td>
                            	@if($tt->NoiBat == 1)
                            		{{'Có'}}
                            	@else
                            		{{'Không'}}
                            	@endif
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tt->id}}">Xóa</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$tt->id}}">Chỉnh sửa</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection