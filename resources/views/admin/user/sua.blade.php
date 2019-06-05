@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Sửa</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('admin.layout.errors')
                @include('admin.layout.messages')
                <form action="{{route('PSU', $user->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Tên</label>
                        <input class="form-control" name="name" type="text" value="{{$user->name}}"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" type="email" value="{{$user->email}}" readonly="" />
                    </div>
                    <div class="form-group">
                    	<label>Quyền người dùng</label>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="quyen" value="0" 
							@if($user->quyen == 0)
								{{"checked"}}
							@endif
                            >Thường
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="quyen" value="1"
                            @if($user->quyen == 1)
                            	{{"checked"}}
                            @endif
                            >Admin
                          </label>
                        </div>
                    </div>
                    <div class="form-group">
                    	<input type="checkbox" name="CheckChangePassword" id="CheckChangePassword">
                        <label>Đổi mật khẩu</label>
                        <input class="form-control ChangePassword" name="password" type="text" disabled="" />
                    </div>
                    <div class="form-group" id='xnpassword' hidden>
                        <label>Nhập lại mật khẩu</label>
                        <input class="form-control ChangePassword" name="xnpassword" type="text" disabled="" />
                    </div>
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
			$('#CheckChangePassword').change(function(){
				if($(this).is(":checked")){
					$('.ChangePassword').removeAttr('disabled');
					$('#xnpassword').removeAttr('hidden')
				}else{
					$('.ChangePassword').attr('disabled', '');
					$('#xnpassword').attr('hidden', '')
				}
			});
		});
	</script>
@endsection