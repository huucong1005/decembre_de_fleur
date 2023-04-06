@extends('layout')

@section('slider')

                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">
                        @php 
                            $i=0;
                        @endphp
                        @foreach($slider as$key=>$slider)
                        @php 
                            $i++;
                        @endphp
                            <div class="item {{$i==1 ? 'active' : ''}}">
                                <div class="col-sm-3">
                                    <p style="margin-top: 100px;">{{$slider->slider_desc}}</p>
                                    {{-- <button type="button" class="btn btn-default get">Get it now</button> --}}
                                </div>
                                <div class="col-sm-9 image">
                                    <img src="public/uploads/slider/{{$slider->slider_image}}" class="girl img-responsive" alt="{{$slider->slider_desc}}" />
                                    {{-- <img src="{{asset('public/frontend/images/home/pricing.png')}}"  class="pricing" alt="{{$slider->slider_desc}}" /> --}}
                                </div>
                            </div>
                        @endforeach
                            {{-- <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>100% Responsive Design</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('public/frontend/images/home/girl2.jpg')}}" class="girl img-responsive" alt="" />
                                    <img src="{{asset('public/frontend/images/home/pricing.png')}}"  class="pricing" alt="" />
                                </div>
                            </div> --}}
                            
                            
                        </div>
                        <ol class="carousel-indicators">
                            @for($i=0; $i<$slider_active_count; $i++)
                            <li data-target="#slider-carousel" data-slide-to="{{$i}}" class="{{$i==0 ? 'active' : ''}}"></li>
                            @endfor
                        </ol>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
@endsection


@section('content')

    
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới</h2>
@foreach( $all_product as $key =>$product)

    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <form>
            @csrf
            <div class="single-products">
                    <div class="productinfo text-center">
                    
                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_cost}}" class="cart_product_cost_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_discount}}" class="cart_product_discount_{{$product->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                        <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_slug)}}">
                            <img src="{{URL::to('/public/uploads/product/'.$product->product_image)}}" alt="{{$product->product_name}}" width="240" height="350" /><br><br>
                            <p style="font-size: 16px; text-transform: uppercase;">{{$product->product_name}}</p>
                        @if($product->product_discount==0)
                            <br>
                            <h2>{{number_format($product->product_price).' '.'VND'}}</h2>
                            <img src="{{URL::to('/public/uploads/logo/new.png')}}" class="new" >
                        @else
                            <p>Giảm: {{$product->product_discount}}% <span style="margin-left: 10px;"></span> <del>{{number_format($product->product_price).' '.'VND'}}</del></p>
                            <h2>{{number_format($product->product_price - (($product->product_price*$product->product_discount)/100)).' '.'VND'}}</h2>
                            <img src="{{URL::to('/public/uploads/logo/sale.png')}}" class="new" >
                        @endif
                            
                        </a> 
                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-id_product="{{$product->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                    
                    </div>

            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#" type="button" data-toggle="modal" data-target="#quickview" name="quickview" class="quickview" data-id_product="{{$product->product_id}}"><i class="fa fa-eye"></i>Xem nhanh</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                </ul>
            </div>
            </form>
        </div>
    </div>

{{-- quick view product   --}}
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title product_quickview_title" id="">
                        <span></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <span id="product_quickview_image"></span>
                            {{-- <span id="product_quickview_gallery"></span> --}}
                        </div>
                        <div class="col-md-7">
                        <form action="">
                         @csrf
                            <div id="product_quickview_value"></div>
                            
                            <h2><span id="product_quickview_title"></span></h2>
                            <h5>Mã sp: #<span  id="product_quickview_id"></span></h5>
                            <span>
                                <h4>Giá sản phẩm: <span id="product_quickview_price"> </span> VND</h4>                               
                                
                                <div id="product_quickview_button"></div>
                                <input type="hidden" name="productid_hidden" value="">
                            <div id="beforesend_quickview"></div>
                                <h4>Mô tả sản phẩm: </h4>
                                <span id="product_quickview_desc"></span>
                                <fieldset>
                                    <span style="width: 100%;" id="product_quickview_content"></span>
                                </fieldset><br>
                             </span>   
                            
                        </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <a href="{{URL::to('/show-cart-ajax')}}" type="button" class="btn btn-success">Đi tới giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
{{-- end modal quick view product   --}}

@endforeach
</div><!--features_items-->
    <div class="pagination pagination-sm m-t-none m-b-none">
        {{ $all_product->links("pagination::bootstrap-4") }}
    </div>

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm bán chạy</h2>
@foreach( $recommended_product as $key =>$product2)

    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <form>
            @csrf
            <div class="single-products">
                    <div class="productinfo text-center">
                    
                        <input type="hidden" value="{{$product2->product_id}}" class="cart_product_id_{{$product2->product_id}}">
                        <input type="hidden" value="{{$product2->product_name}}" class="cart_product_name_{{$product2->product_id}}">
                        <input type="hidden" value="{{$product2->product_quantity}}" class="cart_product_quantity_{{$product2->product_id}}">
                        <input type="hidden" value="{{$product2->product_image}}" class="cart_product_image_{{$product2->product_id}}">
                        <input type="hidden" value="{{$product2->product_cost}}" class="cart_product_cost_{{$product2->product_id}}">
                        <input type="hidden" value="{{$product2->product_price}}" class="cart_product_price_{{$product2->product_id}}">
                        <input type="hidden" value="{{$product2->product_discount}}" class="cart_product_discount_{{$product2->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product2->product_id}}">

                        <a href="{{URL::to('chi-tiet-san-pham/'.$product2->product_slug)}}">
                            <img src="{{URL::to('/public/uploads/product/'.$product2->product_image)}}" alt="{{$product2->product_name}}" width="240" height="350" /><br><br>
                            <p style="font-size: 16px; text-transform: uppercase;">{{$product2->product_name}}</p>
                        @if($product2->product_discount==0)
                            <br>
                            <h2>{{number_format($product2->product_price).' '.'VND'}}</h2>
                        @else
                            <p>Giảm: {{$product2->product_discount}}% <span style="margin-left: 10px;"></span> <del>{{number_format($product2->product_price).' '.'VND'}}</del></p>
                            <h2>{{number_format($product2->product_price - (($product2->product_price*$product2->product_discount)/100)).' '.'VND'}}</h2>
                            <img src="{{URL::to('/public/uploads/logo/sale.png')}}" class="new" >
                        @endif
                            
                        </a> 
                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-id_product="{{$product2->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                    
                    </div>

            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#" type="button" data-toggle="modal" data-target="#quickview" name="quickview" class="quickview" data-id_product="{{$product2->product_id}}"><i class="fa fa-eye"></i>Xem nhanh</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                </ul>
            </div>
            </form>
        </div>
    </div>

{{-- quick view product   --}}
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title product_quickview_title" id="">
                        <span></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <span id="product_quickview_image"></span>
                            {{-- <span id="product_quickview_gallery"></span> --}}
                        </div>
                        <div class="col-md-7">
                        <form action="">
                         @csrf
                            <div id="product_quickview_value"></div>
                            
                            <h2><span id="product_quickview_title"></span></h2>
                            <h5>Mã sp: #<span  id="product_quickview_id"></span></h5>
                            <span>
                                <h4>Giá sản phẩm: <span id="product_quickview_price"> </span> VND</h4>                               
                                
                                <div id="product_quickview_button"></div>
                                <input type="hidden" name="productid_hidden" value="">
                            <div id="beforesend_quickview"></div>
                                <h4>Mô tả sản phẩm: </h4>
                                <span id="product_quickview_desc"></span>
                                <fieldset>
                                    <span style="width: 100%;" id="product_quickview_content"></span>
                                </fieldset><br>
                             </span>   
                            
                        </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <a href="{{URL::to('/show-cart-ajax')}}" type="button" class="btn btn-success">Đi tới giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
{{-- end modal quick view product   --}}

@endforeach
</div>

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm theo danh mục</h2>
    <div class="brand-tab">
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                @php
                    $i=0;
                @endphp
                @foreach($brand_product_tabs as$key=>$tab_value)
                @php
                    $i++;
                @endphp
                    <li class="tabs_product {{$i==1 ? 'active' : ''}}" data-id="{{$tab_value->brand_id}}"><a href="#tshirt" data-toggle="tab">{{$tab_value->brand_name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div id="tabs_product"></div>

        
            
        </div>
    </div>



@endsection

@section('partner')
<hr>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Đối tác của chúng tôi</h2>

<div class="owl-carousel owl-theme">
    @foreach($partner as $key =>$partnerItem)
    <div class="item">
        <a target="_blank" href="{{$partnerItem->partner_link}}">
            <center><h4>{{$partnerItem->partner_name}}</h4></center>
             <img src="{{URL::to('/public/uploads/logo/'.$partnerItem->partner_image)}}" alt="{{$partnerItem->partner_name}}" width="300" height="100" />
        </a>
    </div>
    @endforeach
    
</div>
</div>
@endsection