@extends('layout')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page">Kết quả tìm kiếm: {{$keyword}}</li>
  </ol>
</nav>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
@foreach( $search_product as $key =>$product)
<a href="{{URL::to('chi-tiet-san-pham/'.$product->product_slug)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                    <form>
                    @csrf
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
                        @else
                            <p>Giảm: {{$product->product_discount}}% <span style="margin-left: 10px;"></span> <del>{{number_format($product->product_price).' '.'VND'}}</del></p>
                            <h2>{{number_format($product->product_price - (($product->product_price*$product->product_discount)/100)).' '.'VND'}}</h2>
                            <img src="{{URL::to('/public/uploads/logo/sale.png')}}" class="new" >
                        @endif
                            
                        </a> 
                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-id_product="{{$product->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                    </form>
                    </div>

                    {{-- <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div> --}}
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
</a>
@endforeach
</div><!--features_items-->



@endsection