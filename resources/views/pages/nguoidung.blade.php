@extends('layout.index')

@section('content')
    <!-- Navigation -->
    @include('layout.header')

    <!-- Page Content -->
    <div class="container">

    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Thông tin tài khoản</div>
				  	<div class="panel-body">
				  		<?php 
				  		if(Auth::check()){
				  			$user = Auth::user();
				  		}
				  		?>
				  		@include('admin.layout.errors')
				  		@include('admin.layout.messages')
				    	<form action="nguoidung" method="POST">
				    		@csrf
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1" value="{{$user->name}}">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
							  	readonly=""  value="{{$user->email}}"
							  	>
							</div>
							<br>	
							<div>
								<input type="checkbox" name="CheckChangePassword" id="CheckChangePassword">
				    			<label>Đổi mật khẩu</label>
							  	<input type="text" class="form-control ChangePassword" name="password" aria-describedby="basic-addon1">
							</div>
							<br>
							<div id='xnpassword' hidden>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control ChangePassword" name="xnpassword" aria-describedby="basic-addon1">
							</div>
							<br>
							<button type="submit" class="btn btn-default">Sửa
							</button>

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
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