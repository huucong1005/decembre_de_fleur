@extends('layout')
@section('content')	

	<section id="cart_items">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>

			<div class="table-responsive cart_info">
				@if(session()->has('message'))
					<div class="alert alert-success">{{ session()->get('message')}}</div>
				@elseif(session()->has('error'))
					<div class="alert alert-danger">{{ session()->get('error')}}</div>
				@endif
	
				<table class="table table-condensed">	
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="name">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>

					<form action="{{url('/update-cart-ajax')}}" method="POST">
					{{csrf_field()}}

					@if(Session::get('cart')==true)
						@php
							$total = 0;
						@endphp

						@foreach(Session::get('cart') as $key =>$cart)

							@php
								$subtotal = $cart['product_price']*$cart['product_qty'];
								$total+=$subtotal;
							@endphp

						<tr>
							<td class="cart_product">
								<a href=""><img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="70" height="80" alt="{{$cart['product_name']}}"></a>
							</td>
							<td class="cart_description">
								<h4>{{$cart['product_name']}}</h4>
								<p>ID:{{$cart['product_id']}} </p>
							</td>
							<td class="cart_price">
								<p>{{number_format($cart['product_price'],0,',','.')}} VND</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									
									<input class="cart_quantity" type="number" min="1" max="20" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" size="2">	
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									{{number_format($subtotal,0,',','.')}} VND
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/delete-cart-ajax/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>

						@endforeach
						
						<tr>
							<td colspan="3">
								<input type="submit" class="btn btn-defaul check_out" value="Cập nhật giỏ hàng" name="update_qty" >	
								<a href="{{url('/delete-all-cart-ajax')}}" class="btn btn-default check_out"> Xóa tất cả sản phẩm</a>
								@if(Session::get('coupon'))
									<a href="{{url('/unset-coupon')}}" class="btn btn-default check_out"> Xóa mã giảm giá</a>
								@endif
							</td>
							<td colspan="3">
								<div class="total_area">								
										<li>Tổng tiền: <span>{{number_format($total,0,',','.')}} VND</span></li>
										<li>Mã giảm giá: 
											@if(Session::get('coupon'))
												@foreach(Session::get('coupon') as $key =>$cou)
													@if($cou['coupon_function']==1)
														<span>{{$cou['coupon_number']}} %</span>
															@php
															$total_coupon =($total*$cou['coupon_number'])/100;
															echo '<li>Giảm:<span>'.number_format($total_coupon,0,',','.').' VND</span></li>';
															@endphp
														<li>Tiền sau khi giảm:<span> {{number_format($total_coupon,0,',','.')}} VND<span></li>
													@elseif($cou['coupon_function']==2)
														<span>{{number_format($cou['coupon_number'],0,',','.')}} VND</span>
															@php
															$total_coupon =($total-$cou['coupon_number']);
															@endphp
														<li>Tiền sau khi giảm:<span> {{number_format($total_coupon,0,',','.')}} VND</span></li>
													@endif
												@endforeach
											@else 
												<span>Chưa có</span>
											@endif
										</li>
                        	{{-- <a href="" class="btn btn-default check_out" >Thanh toán</a> --}}
								</div>
							</td>	
						</tr>
					@else
						<tr>
							<td colspan="5"><center><h4>
								@php echo'Chưa có sản phẩm nào trong giỏ!' @endphp
							</h4></center></td>
						</tr>
					@endif
				</form>
				<br>
				@if(Session::get('cart'))
					<form action="{{url('/check-coupon')}}" method="POST">
					@csrf
						<tr>
							<td colspan="2">
								<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
								<input type="submit" class="btn btn-default check_out" name="check_coupon" value="Tính mã giảm giá">
							</td>	
						</tr>
					</form>
				@endif

					</tbody>
				</table>			
				
				
			</div>

	</section> <!--/#cart_items-->

	{{-- <section id="do_action">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>

						<a class="btn btn-default update" href="">Get Quotes</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền: <span>{{number_format($total,0,',','.')}} VND</span></li>
							<li>Thuế <span></span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span></span></li>
						</ul>
						
                        <a href="" class="btn btn-default check_out" >Thanh toán</a>
                        

					</div>
				</div>
			</div>
		
	</section> //#do_action --}}
@endsection