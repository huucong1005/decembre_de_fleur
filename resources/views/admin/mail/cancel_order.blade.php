<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Notify order </title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<p style="text-align: center; color: #134b5f; ">Đây là email tự động, vui lòng không phản hồi email này. Xin cảm ơn !</p>
	<div class="container" style="background-color: #fee8ea; border-radius: 15px; padding: 20px;">
		<div class="col-md-12">
			<div class="col-md-6" style="text-align: center;   font-weight: bold;font-size: 30px;">
				<h4 style="margin: 0;"> Cửa hàng hoa tươi tháng 12</h4>
				<h6 style="margin: 0;"> Thông báo hủy đơn hàng</h6>
			</div>

			<div class="col-md-6 logo"  >
				<p style="font-size: 17px;">
					Chào bạn: <strong style="color: #000; text-decoration: inherit;">{{$shipping_array['customer_name']}}</strong>, 
					<span >bạn hoặc một ai đó đã đặt hàng với thông tin như sau: </span>
				</p>
			</div>

			<div class="col-md-12">
				<h4  style=" text-transform: uppercase;">Thông tin đơn hàng</h4>
				<p  >Mã đơn: #<strong  style="text-transform: uppercase;">{{$code['order_code']}}</strong></p>
				<p  >Mã khuyến mại: <strong  style="text-transform: uppercase;">{{$code['coupon_code']}}</strong></p>
				<p  >Dịch vụ: <strong>Đặt hoa trực tuyến</strong></p><br>

				<h4  style=" text-transform: uppercase;">Thông tin nhận hàng</h4>
				<p  >Email: 
					@if($shipping_array['shipping_email']=='')
						Không có
					@else
						<span  >{{$shipping_array['shipping_email']}}</span>
					@endif
				</p>
				<p  >Người nhận: 
					@if($shipping_array['shipping_name']=='')
						Không có
					@else
						<span>{{$shipping_array['shipping_name']}}</span>
					@endif
				</p>
				<p   >Địa chỉ nhận hàng: 
					@if($shipping_array['shipping_address']=='')
						Không có
					@else
						<span>{{$shipping_array['shipping_address']}}</span>
					@endif
				</p>
				<p  >Số điện thoại:
					@if($shipping_array['shipping_phone']=='')
						Không có
					@else
						<span>{{$shipping_array['shipping_phone']}}</span>
					@endif
				</p>
				<p   >Ghi chú: 
					@if($shipping_array['shipping_notes']=='')
						Không có
					@else
						<span>{{$shipping_array['shipping_notes']}}</span>
					@endif
				</p>
				<p  >Phương thức thanh toán: 
					@if($shipping_array['shipping_method']=='direct_payment')
						<span>Thanh toán khi nhận hàng</span>
					@elseif($shipping_array['shipping_method']=='transfer_money')
						<span>Chuyển khoản ngân hàng</span>
					@else
						<span>thanh toán qua VN Pay</span>
					@endif
				</p><br>

				<h4  style=" text-transform: uppercase;">
					<p><span style="color: #d32222; font-size: 20px;">&#10008;</span>Vì một vài vấn đề bất tiện,cửa hàng rất lấy làm tiếc khi thông báo rằng đơn hàng của bạn đã bị hủy bỏ. </p>
					<p>Chúng tôi chân thành xin lỗi và sẽ hoàn tiền lại cho bạn nhanh nhất có thể theo chính sách của chúng tôi trong trường hợp bạn đã thanh toán trước đơn hàng này</p>
				</h4><br>

				<h4  style=" text-transform: uppercase;">Sản phẩm đã đặt</h4>
				<table class="table-bodered" style="border: 1px;">
		            <thead>
		                <tr>
		                    <th style="padding: 2px 15px;">Tên sản phẩm</th>
		                    <th style="padding: 2px 15px;">Số lượng</th>
		                    <th style="padding: 2px 15px;">Giá</th>
		                </tr>
		            </thead>
		            <tbody>
		            	@foreach($cart_array as $cart)
              				<tr>
              					<td style="padding: 2px 15px;">{{$cart['product_name']}}</td>
              					<td style="padding: 2px 15px;">{{$cart['product_qty']}}</td>
              					<td style="padding: 2px 15px;">{{number_format($cart['product_price'],0,',','.')}} vnd</td>
              				</tr>
		            	@endforeach

		            </tbody>	
		        </table>	<br>
		        <p  >Nếu thông tin nhận hàng không đúng, hãy liên hệ với chúng tôi ngay khi bạn nhận ra.</p>
	
			</div>
		</div>
	</div>



	<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>