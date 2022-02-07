@extends('layout')
@section('content')	

<section id="form"><!--form-->
	<div class="row">
		<div class="col-sm-5 ">
			<div class="login-form"><!--login form-->
				<h2>Đăng nhập</h2>
				<form action="{{URL::to('/login-customer')}}" method="POST">
					{{csrf_field()}}
					<input type="email" name="email_account"  required placeholder="Email" />
					<input type="password" name="password_account" required placeholder="Mật khẩu"/>
					<span>
						<input type="checkbox" class="checkbox"> 
						Ghi nhớ tài khoản
					</span>
					<button type="submit" class="btn btn-default">Đăng nhập</button>
				</form>
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
					<button type="submit" class="btn btn-default">Đăng kí</button>
				</form>
			</div><!--/sign up form-->
		</div>
	</div>
</section><!--/form-->
	

@endsection