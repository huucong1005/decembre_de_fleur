@extends('layout')
@section('content')	
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{URL::to('/login-checkout')}}">Đăng nhập</a></li>
    <li class="breadcrumb-item active" aria-current="page">Lấy lại mật khẩu</li>
  </ol>
</nav>
	<div class="row"><br><br><br>
		<div class="col-sm-12 ">
			<div class="login-form"><!--login form-->
				@if(session()->has('message'))
					<div class="alert alert-success">{!! session()->get('message')!!}</div>
				@elseif(session()->has('error'))
					<div class="alert alert-danger">{!! session()->get('error')!!}</div>
				@endif
				<h2>Điền email của bạn để lấy lại mật khẩu !</h2>
				<form action="{{URL::to('/send-mail-recover-password')}}" method="POST">
					{{csrf_field()}}
					<input type="email" name="email_account"  required placeholder="Email" />
					<center>
						<button type="submit" class="btn btn-default" style="padding: 7px 30px; border-radius: 3px; margin-top: 20px;">Gửi</button>
					</center>
				
			</div><!--/login form-->
		</div>
	</div>
	

@endsection