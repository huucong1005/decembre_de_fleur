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
									<form action="{{URL::to('/update-cart-quantity')}}" method="POST">
									{{csrf_field()}}
									<input class="cart_quantity_input" type="number" min="1" max="50" name="cart_quantity" value="{{$value_content->qty}}" size="2">
									<input type="hidden" value="{{$value_content->rowId}}" name="rowId_qty" class="form-control">
									<input type="submit" class="btn btn-sm" value="Cập nhật" name="update_qty" >
									</form>
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
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$value_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

	</section> <!--/#cart_items-->

	<section id="do_action">
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
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền: <span>{{Cart::subtotal().' VND'}}</span></li>
							<li>Thuế <span>{{Cart::tax().' VND'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total().' VND'}}</span></li>
						</ul>
						<?php 
                        $customer_id =Session::get('customer_id');
                        if ($customer_id!=NULL) {
                        ?>
                        <a href="{{URL::to('/checkout')}}" class="btn btn-default check_out" >Thanh toán</a>
                        <?php 
                        }else{
                        ?>
                        <a href="{{URL::to('/login-checkout')}}" class="btn btn-default check_out"> Thanh toán</a>
                        <?php
                        }
                        ?>
					</div>
				</div>
			</div>
		
	</section><!--/#do_action-->
@endsection