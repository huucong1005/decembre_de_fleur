<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<div class="container" style="margin: 0 auto; max-width: 600px;">
		<!-- Email Wrapper Header Open //-->
		<table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperWebview">
			<tbody><tr>
				<td align="center" valign="top">
					<!-- Content Table Open // -->
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tbody><tr>
							<td align="center" valign="middle" style="padding-top: 40px; padding-bottom: 40px;" class="emailLogo">
								<!-- Logo and Link // -->
								<a href="#" target="_blank" style="text-decoration:none;">
									<img src="http://weekly.grapestheme.com/notify/img/hero-img/green/logo.png" alt="" width="150" border="0" style="width:100%; max-width:150px;height:auto; display:block;">
								</a>
							</td>
						</tr>
					</tbody></table>
					<!-- Content Table Close // -->
				</td>
			</tr>
		</tbody></table>
		<!-- Email Wrapper Header Close //-->

		<!-- Email Wrapper Body Open // -->
		<table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperBody">
			<tbody><tr>
				<td align="center" valign="top">

					<!-- Table Card Open // -->
					<table border="0" cellpadding="0" cellspacing="0" style="background-color: rgb(195, 219, 190); border-width: 0px 1px 1px;" width="100%" class="tableCard">

						<tbody><tr>
							<!-- Header Top Border // -->
							<td height="3" style="background-color: rgb(190, 218, 25); font-size: 1px; line-height: 3px;" class="topBorder">&nbsp;</td>
						</tr>


						<tr>
							<td align="center" valign="top" style="padding-bottom: 20px;" class="imgHero">
								<!-- Hero Image // -->
								<a href="#" target="_blank" style="text-decoration:none;">
									<img src="http://weekly.grapestheme.com/notify/img/hero-img/green/heroFlat/notification-gift-card.png" width="600" alt="" border="0" style="width:100%; max-width:600px; height:auto; display:block;">
								</a>
							</td>
						</tr>

						<tr>
							<td align="center" valign="top" style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" class="mainTitle">
								<!-- Main Title Text // -->
								<h2 class="text" style="color: rgb(22, 15, 28); font-family: Poppins, Helvetica, Arial, sans-serif; font-size: 28px; font-weight: 500; font-style: normal; letter-spacing: normal; line-height: 36px; text-transform: none; text-align: center; padding: 0px; margin: 0px;">
									Coupon {{$couponItem['coupon_number']}} 
									<?php	if($couponItem['coupon_function']==1){	?> 	%	<?php 	}else{ 	?> VND 	<?php 	} 	?>		
								</h2>
							</td>
						</tr>

						<tr>
							<td align="center" valign="top" style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" class="mainTitle">
								<!-- Main Title Text // -->
								<h4 class="text" style="color: rgb(0, 54, 6); font-family: Poppins, Helvetica, Arial, sans-serif; font-size: 20px; font-weight: 500; font-style: normal; letter-spacing: normal; line-height: 24px; text-transform: none; text-align: center; padding: 0px; margin: 0px;">
									Cửa hàng hoa tươi tháng 12 - Decembre de fleur
								</h4>
							</td>
						</tr>
						

						<tr>
							<td align="center" valign="top" style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" class="subTitle">
								<!-- Sub Title Text // -->
								<h4 class="text" style="color: rgb(0, 54, 6); font-family: Poppins, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 500; font-style: normal; letter-spacing: normal; line-height: 24px; text-transform: none; text-align: center; padding: 0px; margin: 0px;">
									Giảm giá {{$couponItem['coupon_number']}} 
									<?php	if($couponItem['coupon_function']==1){	?> 	%	<?php 	}else{ 	?> VND 	<?php 	} 	?>	 trên mọi hóa đơn.
								</h4>
							</td>
						</tr>

						<tr>
							<td align="center" valign="top" style="padding-left:20px;padding-right:20px;" class="containtTable ui-sortable">

								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableMediumTitle" style="">
									<tbody><tr>
										<td align="center" valign="top" style="padding-bottom: 20px;" class="mediumTitle">
											<!-- Medium Title Text // -->
											<p class="text" style="color: rgb(0, 84, 10); font-family: Poppins, Helvetica, Arial, sans-serif; font-size: 25px; font-weight: 300; font-style: normal; letter-spacing: normal; line-height: 30px; text-transform: none; text-align: center; padding: 0px; margin: 0px;">
												Mã giảm giá: {{$couponItem['coupon_code']}} 
											</p>
										</td>
									</tr>
								</tbody></table>

								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
									<tbody><tr>
										<td align="center" valign="top" style="padding-bottom: 20px;" class="description">
											<!-- Description Text// -->
											<p class="text" style="color: rgb(0, 54, 7); font-family: &quot;Open Sans&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; font-style: normal; letter-spacing: normal; line-height: 22px; text-transform: none; text-align: center; padding: 0px; margin: 0px;">
												Coupon giảm giá dành riêng tặng bạn - những khách hàng yêu quý đã luôn ủng hộ chúng tôi trong suốt thời gian qua. Giảm ngay {{$couponItem['coupon_number']}} 
												<?php	if($couponItem['coupon_function']==1){	?> 	%	<?php 	}else{ 	?> VND 	<?php 	} 	?>	 trên mọi hóa đơn tại Decembre de fleur. Hãy nhanh tay ghé thăm website và đặt hàng ngay bạn nhé, chương trình giảm giá của chúng tôi có thể sẽ hết hạn trước vì coupon chỉ có số lượng {{$couponItem['coupon_quantity']}}. 
											</p>
										</td>
									</tr>
								</tbody></table>

								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButtonDate" style="">
									<tbody><tr>
										<td align="center" valign="top" style="padding-top:20px;padding-bottom:5px;">
											<!-- Button Table // -->
											<table align="center" border="0" cellpadding="0" cellspacing="0">
												<tbody><tr>
													<td align="center" class="ctaButton" style="background-color: rgb(190, 218, 25); padding: 12px 35px; border-radius: 50px;">
														<!-- Button Link // -->
														<a class="text" href="#" target="_blank" style="color: rgb(37, 25, 25); font-family: Poppins, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 600; font-style: normal; letter-spacing: 1px; line-height: 20px; text-transform: uppercase; text-decoration: none; display: block;">
															Đặt hàng ngay !
														</a>
													</td>
												</tr>
											</tbody></table>
										</td>
									</tr><br>

									<tr>
										<td align="center" valign="top" style="padding-bottom: 20px;" class="infoDate">
											<!-- Info Date // -->
											<p class="text" style="color: rgb(201, 16, 16); font-family: &quot;Open Sans&quot;, Helvetica, Arial, sans-serif; font-size: 11px; font-weight: 700; font-style: normal; letter-spacing: normal; line-height: 20px; text-transform: none; text-align: center; padding: 0px; margin: 0px;">
												Chương trình diễn ra từ : {{$couponItem['coupon_start']}} đến {{$couponItem['coupon_end']}}  
											</p>
										</td>
									</tr>
								</tbody></table>

							</td>
						</tr>

						<tr>
							<td height="15" style="font-size:1px;line-height:1px;">&nbsp;</td>
						</tr>

					</tbody></table>
					<!-- Table Card Close// -->

					<!-- Space -->
					<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
						<tbody><tr>
							<td height="30" style="font-size:1px;line-height:1px;">&nbsp;</td>
						</tr>
					</tbody></table>

				</td>
			</tr>
		</tbody></table>
		<!-- Email Wrapper Body Close // -->

		<!-- Email Wrapper Footer Open // -->
		<table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperFooter">
			<tbody><tr>
				<td align="center" valign="top">
					<!-- Content Table Open// -->
					<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
						<tbody>
						<tr>
							<td align="center" valign="top" style="padding: 0px 10px 10px;" class="footerEmailInfo">
								<!-- Information of NewsLetter (Subscribe Info)// -->
								<p class="text" style="color:#777777; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:12px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:20px; text-transform:none; text-align:center; padding:0; margin:0;">
								Mọi thắc mắc xin gửi thư về địa chỉ: <a href="#" style="color:#777777;text-decoration:underline;" target="_blank">decembredefleur@gmail.com</a><br> <a href="#" style="color:#777777;text-decoration:underline;" target="_blank">Unsubscribe</a> from our mailing lists
								</p>
							</td>
						</tr>
						<p></p>
						<tr>
							<td align="center" valign="top" style="padding: 0px 10px 10px;" class="footerEmailInfo">
								<!-- Information of NewsLetter (Subscribe Info)// -->
								<p class="text" style="color:#777777; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:12px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:20px; text-transform:none; text-align:center; padding:0; margin:0;">
								Đây là mail tự động, quý khách vui lòng không trả lời email này!
								</p>
							</td>
						</tr>

						<!-- Space -->
						<tr>
							<td height="15" style="font-size:1px;line-height:1px;">&nbsp;</td>
						</tr>
					</tbody></table>
					<!-- Content Table Close// -->
				</td>
			</tr>

			<!-- Space -->
			<tr>
				<td height="20" style="font-size:1px;line-height:1px;">&nbsp;</td>
			</tr>
		</tbody></table>
		<!-- Email Wrapper Footer Close // -->
	</div>
</body>
</html>
		