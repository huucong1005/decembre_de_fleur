@extends('layout')
@section('content')	

	<section id="cart_items">
			<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
  </ol>
</nav>


			<div class="shopper-informations">
				<div class="row">
					@if(Session::get('cart')==true)
					<div class="col-sm-12">
						<div class="bill-to">
							<p>Địa chỉ giao hàng</p>
							<div class="form-one">
								
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
                                    <select name="wards" id="wards" class="form-control m-bot15 wards" required>
                                        <option value="">----Chọn phường(xã)----</option>
                                    </select>
                                </div>
                                <input type="button"value="Tính phí vận chuyển" name="caculate_order" class="btn  btn-primary btn-default caculate_delivery">
                            	</form>

                            	{{-- <?php 		echo Session::get('fee'); 		?> --}}

                            	
							</div>
						</div>
					</div>	
					@endif

					<div  class="col-sm-12">
				@if(session()->has('message'))
					<div class="alert alert-success">{!! session()->get('message')!!}</div>
				@elseif(session()->has('error'))
					<div class="alert alert-danger">{!! session()->get('error')!!}</div>
				@endif
					</div>

					<div class="col-sm-12">		
						<div class="bill-to"><p>Xem lại giỏ hàng</p></div>
						<div class="table-responsive cart_info">

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
							<td colspan="2">
							
								<input type="submit" class="btn btn-defaul check_out" value="Cập nhật giỏ hàng" name="update_qty" >	
								<a href="{{url('/delete-all-cart-ajax')}}" class="btn btn-default check_out"> Xóa tất cả sản phẩm</a>
								<br>
								@if(Session::get('coupon'))
									<a href="{{url('/unset-coupon')}}" class="btn btn-default check_out"> Xóa mã giảm giá</a>
								@endif

								@if(Session::get('fee'))
									<a href="{{url('/unset-feeship')}}" class="btn btn-default check_out"> Xóa phí vận chuyển</a>
								@endif
							</td>
							<td colspan="4">
								<div class="total_area">								
										<li>Tổng tiền: <span>{{number_format($total,0,',','.')}} VND</span></li>
										@if(Session::get('coupon'))
											<li>Mã giảm giá: 
												@foreach(Session::get('coupon') as $key =>$cou)

						{{-- GIAM THEO % --}}
													@if($cou['coupon_function']==1)
														<span>{{$cou['coupon_number']}} %</span>
															@php
															$total_coupon =($total*$cou['coupon_number'])/100;
															echo '<li>Giảm:<span>- '.number_format($total_coupon,0,',','.').' VND</span></li>';
															@endphp

															@php
																$total_after_coupon=$total-$total_coupon
															@endphp

														<li>Tiền sau khi giảm:<span> {{number_format($total_after_coupon,0,',','.')}} VND<span></li>

						{{-- GIAM THEO TIEN --}}
													@elseif($cou['coupon_function']==2)
														<span>- {{number_format($cou['coupon_number'],0,',','.')}} VND</span>

														@php
															$total_after_coupon =($total-$cou['coupon_number']);
														@endphp

														<li>Tiền sau khi giảm:<span> {{number_format($total_after_coupon,0,',','.')}} VND</span></li>
													@endif


												@endforeach
											</li>	
										@endif

										@if(Session::get('fee'))
										<li>Phí vận chuyển <span>+ {{number_format(Session::get('fee'),0,',','.')}} VND</span></li>
										<?php $total_after_fee = $total + Session::get('fee'); ?>
										@endif

										<li>Tổng thanh toán: <span>
										@php
										if(Session::get('fee')&& !Session::get('coupon')) {
											$total_after= $total_after_fee;
											echo number_format($total_after,0,',','.');
										}elseif(!Session::get('fee')&& Session::get('coupon')){
											$total_after= $total_after_coupon;
											echo number_format($total_after,0,',','.');
										}elseif(Session::get('fee')&& Session::get('coupon')){
											$total_after= $total_after_coupon;		
											$total_after= $total_after +Session::get('fee');
											echo number_format($total_after,0,',','.');
										}elseif(!Session::get('fee')&& !Session::get('coupon')){
											$total_after= $total;
											echo number_format($total_after,0,',','.');
											
										}
										@endphp
										 VND</span></li>

                        	{{-- <a href="" class="btn btn-default check_out" >Thanh toán</a> --}}
								</div>
							</td>	
						</tr>
					@else
						<tr>
							<td colspan="5"><center><h4>
								<br>Chưa có sản phẩm nào trong giỏ!<br><br><a href="{{URL::to('/trang-chu')}}">Quay lại trang chủ</a>
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
				@if(Session::get('cart')==true)
				<div class="col-sm-12">
					<div class="payment-option">
							<div class="form-group">
                                <div class="bill-to"><p>Hình thức thanh toán</p></div>
                                <select name="shipping_method" id="shipping_method" class="form-control m-bot15 shipping_method">
                                   	<option value="direct_payment">Trả tiền khi nhận hàng</option>  
                                   	<option value="transfer_money">Chuyển khoản</option>  
                                   	<option value="vnpay">VN Pay</option>      
	                            </select>
                            </div>
                            <div id="transfer_method" style="display: none">
                            	<p>Vui lòng chuyển tiền vào số tài khoản:</p>
                            	@foreach($contact as$key=>$contactItem)
                            	<p>{{$contactItem->info_bank}} với nội dung "DAT HANG CHHT12"</p>
                            	@endforeach
                            	<p>Chúng tôi sẽ xác nhận đơn hàng sớm nhất có thể</p>
                            </div>
                            <div id="vnpay_method" style="display: none">
                            	<form action="{{url('/vnpay-payment')}}" method="POST">
                            		@csrf
                            		<input type="hidden" name="total_vnpay" value="{{$total_after}}">
                            	<button type="submit" class="btn btn-default check_out" name="redirect" > Thanh toán qua VN Pay </button>
                            	</form>
                            </div>


						</div>
						<br><br>
					<div class="bill-to"><p>Thông tin gửi hàng</p></div>
					<div class="form-one">
					<form method="POST">
						{{csrf_field()}}
						<label>Thông tin cá nhân</label>
						<input type="text" name="shipping_email" class="shipping_email" required placeholder="Email *">
						<input type="text" name="shipping_name" class="shipping_name" required placeholder="Họ và tên *">
						<input type="text" name="shipping_address" class="shipping_address" required placeholder="Địa chỉ*">
						<input type="text" name="shipping_phone" class="shipping_phone" required placeholder="Điện thoại *">	
						<label>Ghi chú</label>
						<textarea name="shipping_notes" class="shipping_notes" placeholder="Notes about your order, Special Notes for Delivery" rows="5"></textarea><p></p>
						<label>Ngày nhận hàng</label>
						<input type="text" id="datepicker3" class="shipping_date_revice" name="shipping_date_revice" readonly class="form-control"><br>

						{{--hidden coupon and feeship--}}
						@if(Session::get('fee'))
							<label>Phí vận chuyển</label>
							<input type="hidden=" readonly name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
						@else 
							<label>Phí vận chuyển</label>
							<input type="hidden=" readonly name="order_fee" class="order_fee" value="0">
						@endif

						@if(Session::get('coupon'))
							<label>Áp dụng mã giảm giá</label>
							@foreach(Session::get('coupon') as$key =>$cou)
								<input type="hidden=" readonly name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
							@endforeach
						@else 
							<label>Áp dụng mã giảm giá</label>
							<input type="hidden=" readonly name="order_coupon" class="order_coupon" value="---"> 
						@endif
						

						
                        <input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-default send_order">
					</form>

				</div>

				</div>
				@endif
			</div>
	<script type="text/javascript">
    var sel = document.getElementById('shipping_method'),
        box1 = document.getElementById('transfer_method');
        box2 = document.getElementById('vnpay_method');
        
    sel.addEventListener('change',function handleChange(event){
      	if (event.target.value === 'transfer_money') {
    		box1.style.display = 'block';
  		}else {
    		box1.style.display = 'none';
  		}
    });

    sel.addEventListener('change',function handleChange(event){
      	if (event.target.value === 'vnpay') {
    		box2.style.display = 'block';
  		}else {
    		box2.style.display = 'none';
  		}
    });


    </script>
	</section> <!--/#cart_items-->

@endsection