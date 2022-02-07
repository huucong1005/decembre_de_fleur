@extends('layout')
@section('content')	

	<section id="cart_items">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
			  <li class="active">Thanh toán</li>
			</ol>
		</div>

		<div class="review-payment">
			<h2>Xem lại giỏ hàng</h2>
		</div>
		<div class="table-responsive cart_info">
				<?php 
				$content = Cart::content();
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="name">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $key => $value_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('/public/uploads/product/'.$value_content->options->image)}}" width="70" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$value_content->name}}</a></h4>
								<p>ID: {{$value_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($value_content->price).' VND'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="number" min="1" max="50" name="cart_quantity" value="{{$value_content->qty}}" size="2" disabled>
									<input type="hidden" value="{{$value_content->rowId}}" name="rowId_qty" class="form-control">
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
								<?php 
									$subtotal= $value_content->price * $value_content->qty;
									echo number_format($subtotal).' VND';
								?>
								</p>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
		</div>

		<div class="total_area">
			<ul>
				<li>Tổng tiền: <span>{{Cart::subtotal().' VND'}}</span></li>
				<li>Thuế <span>{{Cart::tax().' VND'}}</span></li>
				<li>Phí vận chuyển <span>Free</span></li>
				<li>Thành tiền <span>{{Cart::total().' VND'}}</span></li>
			</ul>
		</div>


<br>
<form method="POST" action="{{URL::to('/order-place')}}">
	{{ csrf_field() }}

		<div class="payment-option">
			<h2>Hình thức thanh toán</h2>

				<input name="payment_option" type="radio" id="direct_payment" checked value="direct_payment">
				<label for="direct_payment"> Trả tiền khi nhận hàng</label>

				<input name="payment_option" type="radio" id="transfer_money"  value="transfer_money">
				<label for="transfer_money"> Chuyển khoản</label>

{{-- 			<input name="payment_option" type="radio" id="paypal"  value="paypal">
				<label for="paypal"> Paypal</label> --}}

				<input type="submit" name="send_order_place" value="đặt hàng" class="btn btn-primary btn-sm">
		</div>
</form>
	</section> <!--/#cart_items-->

@endsection 

