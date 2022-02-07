@extends('layout')
@section('content')	

	<section id="cart_items">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán</li>
				</ol>
			</div>

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12">
						<div class="bill-to">
							<p>Thông tin gửi hàng</p>
							<div class="form-one">
								<form action="{{URL::to('/restore-checkout')}}"  method="POST">
									{{csrf_field()}}
									<input type="text" name="shipping_email" required placeholder="Email *">
									<input type="text" name="shipping_name" required placeholder="Họ và tên *">
									<input type="text" name="shipping_address" required placeholder="Địa chỉ *">
									<input type="text" name="shipping_phone" required placeholder="Điện thoại *">
									<label>Ghi chú</label>
									<textarea name="shipping_notes" placeholder="Notes about your order, Special Notes for Delivery" rows="5"></textarea><br><br>
									<input type="submit" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-default">
								</form>
								<form>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chọn thành phố(tỉnh)</label>
                                    <select name="city" id="city" class="form-control m-bot15 choose city">
                                    	<option value="">----Chọn thành phố(tỉnh)----</option>
                                    	@foreach($city as $key=>$ci)
                                        <option value="{{$ci->id_tp}}">{{$ci->name_tp}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chọn quận(huyện)</label>
                                    <select name="province" id="province" class="form-control m-bot15 choose province">
                                        <option value="">----Chọn quận(huyện)----</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chọn phường(xã)</label>
                                    <select name="wards" id="wards" class="form-control m-bot15 wards">
                                        <option value="">----Chọn phường(xã)----</option>
                                    </select>
                                </div>

                                <input type="button"value="Tính phí vận chuyển" name="caculate_order" class="btn btn-default">
                            	</form>
							</div>
						</div>
					</div>	


					<div class="col-sm-12">		
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
					</div>	
				</div>
			</div>
	</section> <!--/#cart_items-->

@endsection