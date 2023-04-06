@extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
@foreach($category_name as $key => $category_name)
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page">
        @foreach($category_parent as$key =>$subItem)
            @if( $subItem->category_id==$category_name->category_parent)
                {{$subItem->category_name}} ({{$category_name->category_name}})
            @endif
        @endforeach
    </li>
  </ol>
</nav>
    <h2 class="title text-center">Danh mục: {{$category_name->category_name}}</h2>
@endforeach

<div class="row">
    <div class="col-md-5">
        <form class="form" >
        @csrf
        <label for="amount">Lọc theo: </label>
            <select name="sort" id="sort" class="form-control" style="width: 85%; margin-top: 4px;">
                <option value="{{Request::url()}}?sort_by=none">--- Mặc định ---</option>
                <option value="{{Request::url()}}?sort_by=tang_dan"> Giá tăng dần </option>
                <option value="{{Request::url()}}?sort_by=giam_dan"> Giá giảm dần </option>
                <option value="{{Request::url()}}?sort_by=kytu_az"> Từ a -> z </option>
                <option value="{{Request::url()}}?sort_by=kytu_za"> Từ z -> a </option>
            </select>
        </form>
    </div>

    <div class="col-md-7">
    <form class="form" > 
    <p>   
        <label for="amount">Price range:</label>
        <input size="25" type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;"> 
        <input type="hidden" id="start_price" name="start_price"> 
        <input type="hidden" id="end_price" name="end_price"> 
     </p>
     <div>
        <div class="pull-left" id="slider-range" style="width: 70%; margin-top: 6px;"></div>
        <input type="submit" style="width: 15%; margin-left: 10px; margin-top: -5px;" value="Lọc giá" class="btn btn-default">
    </div>       
        
        
    </form>
    </div>
</div>   <br>                   

@foreach( $category_by_id as $key =>$product)
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



{{-- <div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">   
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/home/recommend1.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/home/recommend1.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/home/recommend1.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">  
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/home/recommend1.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/home/recommend1.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/home/recommend1.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>          
    </div>

</div><!--/recommended_items-->  --}}

<div class="pagination pagination-sm m-t-none m-b-none">
           {{ $category_by_id->links("pagination::bootstrap-4") }}
        </div>

@endsection