@extends('layout')
@section('content')	
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
  </ol>
</nav>
	<div class="row"><br><br><br>
		<div class="col-sm-5 ">
			<div  class="col-sm-12">
				@if(session()->has('message'))
					<div class="alert alert-success">{!! session()->get('message')!!}</div>
				@elseif(session()->has('error'))
					<div class="alert alert-danger">{!! session()->get('error')!!}</div>
				@endif
					</div>
			<div class="login-form"><!--login form-->
				<h2>Đăng nhập</h2>
				<form action="{{URL::to('/login-customer')}}" method="POST">
					{{csrf_field()}}
					<input type="email" name="email_account"  required placeholder="Email" />
					<input type="password" name="password_account" required placeholder="Mật khẩu"/>
					{{-- <span>
						<input type="checkbox" class="checkbox"> 
						Ghi nhớ tài khoản
					</span> --}}
					<center>
						<button type="submit" class="btn btn-default" style="padding: 7px 30px; border-radius: 3px; margin-top: 20px;"> Đăng nhập </button>
					</center>
					<br><i><a class="pull-right" href="{{URL::to('/customer-forget-password')}}" >Quên mật khẩu ?</a></i><hr>
				</form>


				<ul class="list-login">
					<center>Hoặc</center>
					<li><a href="{{URL::to('/customer-login-google')}}">
						<center><img src="{{URL::to('/public/uploads/logo/gg.png')}}" alt="google-icon"><span>Đăng nhập với Google</span></center>
					</a></li>
					{{-- <li><a href="{{URL::to('/customer-login-facebook')}}"><center><img src="{{URL::to('/public/uploads/logo/fb.png')}}  " alt="google-icon"><span>Đăng nhập với Facebook</span></center></a></li> --}}
				
				</ul>



			</div><!--/login form-->
		</div>
		<div class="col-sm-1">
			<h2 class="or">Hoặc</h2>
		</div>
		<div class="col-sm-5">
			<div class="signup-form"><!--sign up form-->
				<h2>Đăng kí tài khoản mới</h2>
				<form action="{{URL::to('/add-customer')}}" method="POST">
					{{csrf_field()}}
					<input type="text" name="customer_name" required placeholder="Họ và tên"/>
					<input type="text" name="customer_phone" required placeholder="Số điện thoại"/>
					<input type="email" name="customer_email" required placeholder="Email"/>
					<input type="password" name="customer_password" required placeholder="Mật khẩu"/>
					<button type="submit" style="padding: 7px 16px; border-radius: 5px;" class="btn btn-default">Đăng kí</button>
				</form>
			</div><!--/sign up form-->
		</div>
	</div>
	

@endsection