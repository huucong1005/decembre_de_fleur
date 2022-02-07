@extends('layout')
@section('content')	
	@foreach($product_detail as $key => $product_detail)
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/uploads/product/'.$product_detail->product_image)}}" alt="{{$product_detail->product_name}}"/>
								<h3>ZOOM</h3>
							</div>
{{-- 							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="{{URL::to('/public/frontend/images/product-details/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/product-details/similar2.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/product-details/similar3.jpg')}}" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="{{URL::to('/public/frontend/images/product-details/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/product-details/similar2.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/product-details/similar3.jpg')}}" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="{{URL::to('/public/frontend/images/product-details/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/product-details/similar2.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/product-details/similar3.jpg')}}" alt=""></a>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div> --}}

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$product_detail->product_name}}</h2>
								<p>ID: {{$product_detail->product_id}}</p>
								<img src="{{URL::to('/public/frontend/images/product-details/rating.png')}}" alt=""  />

								<form>
									@csrf

									<input type="hidden" value="{{$product_detail->product_id}}" class="cart_product_id_{{$product_detail->product_id}}">
                        			<input type="hidden" value="{{$product_detail->product_name}}" class="cart_product_name_{{$product_detail->product_id}}">
                        			<input type="hidden" value="{{$product_detail->product_image}}" class="cart_product_image_{{$product_detail->product_id}}">
                        			<input type="hidden" value="{{$product_detail->product_price}}" class="cart_product_price_{{$product_detail->product_id}}">
                        			<input type="hidden" value="1" class="cart_product_qty_{{$product_detail->product_id}}">

								<span>
									<span>{{number_format($product_detail->product_price).' VND'}}</span>

									<label>Số lượng:</label>
									<input name="qty" type="number" min="1" max="20" value="1"  />
									<input name="product_id" type="hidden" value="{{$product_detail->product_id}}" />

									{{-- <button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm vào giỏ
									</button> --}}
									<button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-id_product="{{$product_detail->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
								</span>
								</form>

								<p><b>Trạng thái:</b> Còn hàng</p>
								<p><b>Tình Trạng:</b> Mới</p>
								<p><b>Danh mục:</b>{{$product_detail->category_name}}</p>
								<p><b>Thương hiệu:</b>{{$product_detail->brand_name}}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
				
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Chi tiết</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Về thương hiệu</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
							
								<h4>{!!$product_detail->product_content!!}</h4>
								<p>{!!$product_detail->product_desc!!}</p>
					
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
	@endforeach					
					<div class="recommended_items col-sm-12"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm gợi ý</h2>
		
						@foreach($recommended as $key =>$recommended)
								<a href="{{URL::to('chi-tiet-san-pham/'.$recommended->product_id)}}">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to('/public/uploads/product/'.$recommended->product_image)}}" alt="{{$recommended->product_name}}" width="150" height="350" />
													<h2>{{number_format($recommended->product_price).' VND'}}</h2>
													<p>{{$recommended->product_name}}</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
												</div>
											</div>
										</div>
									</div>
								</a>
						@endforeach			
					</div><!--/recommended_items-->

@endsection