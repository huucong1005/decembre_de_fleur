@extends('layout')
@section('content')	
	@foreach($product_detail as $key => $product_detail)
	<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{URL::to('/thuong-hieu-san-pham/'.$product_detail->brand_slug)}}">{{$product_detail->brand_name}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$product_detail->product_name}}</li>
  </ol>
</nav>
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">

							<ul id="imageGallery">

							  	<li data-thumb="{{URL::to('/public/uploads/product/'.$product_detail->product_image)}}" data-src="{{URL::to('/public/uploads/product/'.$product_detail->product_image)}}">
							    	<img width="100%" src="{{URL::to('/public/uploads/product/'.$product_detail->product_image)}}" alt="{{$product_detail->product_name}}" />
							  	</li>

							  	@foreach($gallery as$key=>$galleryItem)
							  	<li data-thumb="{{URL::to('/public/uploads/gallery/'.$galleryItem->gallery_image)}}" data-src="{{URL::to('/public/uploads/gallery/'.$galleryItem->gallery_image)}}">
							    	<img width="100%" src="{{URL::to('/public/uploads/gallery/'.$galleryItem->gallery_image)}}" />
							  	</li>
							  	@endforeach
							  	
							</ul>


							{{-- <div class="view-product">
								<img src="{{URL::to('/public/uploads/product/'.$product_detail->product_image)}}" alt="{{$product_detail->product_name}}"/>
								<h3>ZOOM</h3> --}}
							{{-- </div> --}}

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$product_detail->product_name}} @if($product_detail->product_quantity==0)	(hết hàng) 	@endif.</h2>
								<p>id: #{{$product_detail->product_id}}</p>
								<ul class="list-inline rating" title="Average Rating">
                   		@for($count=1; $count<=5; $count++)
                   		@php
                   			if ($count<=$rating) {
                   				$color= 'color:#e88e7c;';
                   			}else{
                   				$color= 'color:#ccc;';
                   			}
                   		@endphp

                   		<li title="star_rating" data-index="{{$count}}" data-rating="{{$rating}}" class="rating" style="{{$color}} font-size: 15px; padding: 0px!important;">&#9733;</li>
                   		{{-- 9773:HAMMER AND SICKLE		9749:COOFFEE	9650:TRIANGLE		127804/127801/127800/10047/10048/9880:FLOWER 		10004:RIGHT		127775/9733:STAR		10084:HEART 	128077/128076:LIKE--}}
                   		@endfor
                   		
                   </ul>
			
								@if($product_detail->product_discount==0)
		                            <br>
		                            <h2>Giá: {{number_format($product_detail->product_price).' VND'}}</h2>
		                        @else
		                        	<p>Giá: <del>{{number_format($product_detail->product_price).' '.'VND'}}</del></p>
		                            <p>Giảm: {{$product_detail->product_discount}}%  </p>
		                            <h2>Chỉ còn: {{number_format($product_detail->product_price - (($product_detail->product_price*$product_detail->product_discount)/100)).' '.'VND'}}</h2>
		              
		                        @endif



							<form>
							@csrf

								<label>Số lượng đặt: </label>

									@if($product_detail->product_quantity==0)
								<input name="qty" disabled type="text" value="- - -" style="width: 40px !important; " />
									@else
								<input name="qty" type="number" min="1" value="1" max="{{$product_detail->product_quantity}}"  class="cart_product_qty_{{$product_detail->product_id}}" />
									@endif


								<input type="hidden" value="{{$product_detail->product_id}}" class="cart_product_id_{{$product_detail->product_id}}">
								<input type="hidden" value="{{$product_detail->product_quantity}}" class="cart_product_quantity_{{$product_detail->product_id}}">
                <input type="hidden" value="{{$product_detail->product_name}}" class="cart_product_name_{{$product_detail->product_id}}">
                <input type="hidden" value="{{$product_detail->product_image}}" class="cart_product_image_{{$product_detail->product_id}}">
                <input type="hidden" value="{{$product_detail->product_cost}}" class="cart_product_cost_{{$product_detail->product_id}}">
                <input type="hidden" value="{{$product_detail->product_price}}" class="cart_product_price_{{$product_detail->product_id}}">
                <input type="hidden" value="{{$product_detail->product_discount}}" class="cart_product_discount_{{$product_detail->product_id}}">

								<p><b>Trạng thái: </b>
									@if($product_detail->product_quantity==0)
										Hết hàng
									@else
										Còn {{$product_detail->product_quantity}} sản phẩm
									@endif
								</p>
								<p><b>Đã bán: </b>{{$product_detail->product_sold}}</p>
								<p><b>Danh mục: </b>
									@foreach($category_parent as$key =>$subItem)
                  						@if( $subItem->category_id==$product_detail->category_parent)
                    						{{$subItem->category_name}}
                  						@endif
                					@endforeach
								</p>
								<p><b>Thương hiệu: </b>{{$product_detail->brand_name}}</p><br>
	
								
								<input type="button" name="add-to-cart" 
											@if($product_detail->product_quantity==0)
											 	disabled
											@endif
									class="btn btn-default add-to-cart" data-id_product="{{$product_detail->product_id}}" value="Thêm vào giỏ hàng"> 
							</form>
							@if($product_detail->product_tags)
							<fieldset>
								<label for=""><h4>Tags:</h4></label>
								@php
									$tags =$product_detail->product_tags;
									$tags = explode(",",$tags);
								@endphp
								@foreach($tags as $tagItem)
									<a href="{{url('/tag/'.Str::slug($tagItem))}}" class="tags_style"><i class="fa fa-tag"></i> {{$tagItem}}</a>
								@endforeach
							</fieldset>
							@endif
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
				
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Chi tiết</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Về thương hiệu</a></li>
								<li><a href="#tags" data-toggle="tab">Tags</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<h4>{!!$product_detail->product_content!!}</h4>
								<p>{!!$product_detail->product_desc!!}</p>
					
							</div>

							<div class="tab-pane fade" id="tags" >
							
								@if($product_detail->product_tags)
							<fieldset>
								@php
									$tags =$product_detail->product_tags;
									$tags = explode(",",$tags);
								@endphp
								@foreach($tags as $tagItem)
									<a href="{{url('/tag/'.Str::slug($tagItem))}}" class="tags_style"><i class="fa fa-tag"></i> {{$tagItem}}</a>
								@endforeach
							</fieldset>
								@endif
					
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
									<form action="">
									@csrf
										<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$product_detail->product_id}}">
										<div id="comment_show"></div>
									</form>
									<br>

									<?php 
                    $customer_id =Session::get('customer_id');
                    $customer_name =Session::get('customer_name');
                      if ($customer_id==NULL) {
                     ?>
                      <h4><center>Đăng nhập để để lại bình luận bạn nhé</center></h4>
                      <li><center><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></center></li>
                     <?php
                      }else{
                     ?>
                   <p><b>Viết đánh giá của bạn ! </b> (Lưu ý: không spam và các bình luận không phù hợp mục đích kinh doanh sẽ bị xóa.)</p>

                   <ul class="list-inline rating" title="Average Rating">

                   	Đánh giá sản phẩm: 
                   		@for($count=1; $count<=5; $count++)
                   		@php
                   			if ($count<=$rating) {
                   				$color= 'color:#e88e7c;';
                   			}else{
                   				$color= 'color:#ccc;';
                   			}
                   		@endphp

                   		<li title="star_rating" id="{{$product_detail->product_id}}-{{$count}}" data-index="{{$count}}" data-product_id="{{$product_detail->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor: pointer; {{$color}} font-size: 25px; ">&#127800;</li>
                   		{{-- 9773:HAMMER AND SICKLE		9749:COOFFEE	9650:TRIANGLE		127804/127801/127800/1004710048/9880:FLOWER 		10004:RIGHT		127775/9733:STAR		10084:HEART 	128077/128076:LIKE--}}
                   		@endfor
                   		
                   </ul>
									<form action="#">
										@csrf
										<span>
											<input type="text" class="comment_name" name="comment_name" value="{{$customer_name}}" />
										</span>

										<textarea name="comment_content" placeholder="Write your comment" class="comment_content" ></textarea>
										<button type="button" class="btn btn-default send-comment pull-right mr-5">
											Submit
										</button>
										<div id="notify_comment"></div>
									</form>

                    <?php
                    	}
                    ?>

									

								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
	@endforeach					
					<div class="recommended_items col-sm-12"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm gợi ý</h2>
		
						@foreach($recommended as $key =>$recommended)
								<a href="{{URL::to('chi-tiet-san-pham/'.$recommended->product_slug)}}">
									<div class="col-sm-4">
        								<div class="product-image-wrapper">
            								<div class="single-products">
                    							<div class="productinfo text-center">
                    							<form>
                    							@csrf
                        							<input type="hidden" value="{{$recommended->product_id}}" class="cart_product_id_{{$recommended->product_id}}">
                        							<input type="hidden" value="{{$recommended->product_name}}" class="cart_product_name_{{$recommended->product_id}}">
                        							<input type="hidden" value="{{$recommended->product_image}}" class="cart_product_image_{{$recommended->product_id}}">
                        							<input type="hidden" value="{{$recommended->product_cost}}" class="cart_product_cost_{{$recommended->product_id}}">
                        							<input type="hidden" value="{{$recommended->product_price}}" class="cart_product_price_{{$recommended->product_id}}">
                        							<input type="hidden" value="{{$recommended->product_discount}}" class="cart_product_discount_{{$recommended->product_id}}">
                        							<input type="hidden" value="1" class="cart_product_qty_{{$recommended->product_id}}">

                        							<a href="{{URL::to('chi-tiet-san-pham/'.$recommended->product_slug)}}">
                            							<img src="{{URL::to('/public/uploads/product/'.$recommended->product_image)}}" alt="{{$recommended->product_name}}" style="width: 70% !important; height: 230px !important; " />
                            							<h2>{{number_format($recommended->product_price - (($recommended->product_price*$recommended->product_discount)/100)).' '.'VND'}}</h2>
                            							@if($recommended->product_discount==0)
                            								<br>
                            							@else
                            							<p><del>{{number_format($recommended->product_price).' '.'VND'}}</del></p>
                            							@endif
                            						<p>{{$recommended->product_name}}</p>
                        							</a> 
                        							<button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-id_product="{{$recommended->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                    							</form>
                    							</div>
            								</div>
        								</div>
    								</div>
								</a>
						@endforeach			
					</div><!--/recommended_items-->

@endsection

    