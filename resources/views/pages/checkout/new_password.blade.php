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
				@php
					$token =$_GET['token'];
					$email =$_GET['email'];
				@endphp
				<h2>Điền mật khẩu mới!</h2>
				<form action="{{URL::to('/confirm-password')}}" method="POST">
					{{csrf_field()}}
					<input type="hidden" name="email" value="{{$email}}" />
					<input type="hidden" name="token" value="{{$token}}" />
					<input type="password" name="password_account"  required placeholder="New password..." />
					<center>
						<button type="submit" class="btn btn-default" style="padding: 7px 30px; border-radius: 3px; margin-top: 20px;">Xác nhận</button>
					</center>
				
			</div><!--/login form-->
		</div>
	</div>
	

@endsection