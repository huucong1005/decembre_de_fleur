<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hoa tươi uy tín số 1 Việt Nam, hoa tươi đẹp, hoa tươi rực rỡ ">
    <meta name="author" content="Décembre de Fleur- Tiệm hoa tháng 12">
    <meta name="keywords" content="Hoa tươi đẹp, uy tín số 1 vn, hoa tươi rực rỡ, mua hoa online, đặt hoa online, hoa đẹp rực rỡ, hoa tốt, hoa đẹp"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <meta name="title" content="Hoa tươi"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- <link rel='canonical' href=" link trang web"/> -->

    <meta property="og:image" content="Hoa tươi" src="public/uploads/logo/logo.jpg" >
    <meta property="og:site_name" content="Hoa tươi đẹp, uy tín số 1 vn," >
    <meta property="og:description" content="Hoa tươi uy tín số 1 Việt Nam, hoa tươi đẹp, hoa tươi rực rỡ " >
    <meta property="og:title" content="Hoa tươi" >
    <meta property="og:type" content="website" >
    <link rel="icon" sizes="14x14" href="{{asset('public/uploads/logo/logo.jpg')}}" type="image/gif">
    <!-- <meta property="og:url" content="" > -->

    <title>Decembre de Fleur - Tiệm hoa tươi tháng 12</title>


    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/owl.theme.default.min')}}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    {{-- [if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif] --}}       
    <link rel="shortcut icon" sizes="16x16" href="{{asset('public/uploads/logo/logo.jpg')}}" type="image/gif">
    <link rel="apple-touch-icon-precomposed" sizes="14x14" href="{{asset('public/uploads/logo/logo.jpg')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('public/frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('public/frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                 @foreach($contact as$key=>$contactItem)
                                <li><a href="tel:+84{{$contactItem->info_contact}}"><i class="fa fa-phone" style="color: #FE980F"></i> (+84) {{$contactItem->info_contact}}</a></li>
                                <li><a target="_blank" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&source=mailto&to={{$contactItem->info_gmail}}"><i class="fa fa-envelope-o" style="color: #FE980F"></i> {{$contactItem->info_gmail}}</a></li>
                                @endforeach
                                <li><a target="_blank" href="#"><i class="fa fa-clock-o" style="color: #FE980F"></i> 08:00 – 19:00</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                @foreach($icon as $key=>$iconItem)
                                <li><a href="{{$iconItem->link}}" title="{{$iconItem->name}}" target="_blank"><i class="{{$iconItem->icon}}"></i></a></li>
                                @endforeach
{{--                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/trang-chu')}}" style="text-decoration: none;">
                                <img src="{{URL::to('public/uploads/logo/'.$contactItem->info_image)}}" height="70" alt="" /> 
                                <span style="margin-top: 5px; color: #444791;font-family: abel;font-size: 32px;text-transform: uppercase; text-decoration: none;">{{$contactItem->info_name}}</span>
                        </a>
                        </div>
                {{--         <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-sm-7">
                        <div class="shop-menu pull-right">
                            
                            <ul class="nav navbar-nav">
                                {{-- <li><a href="#"><i class="fa fa-user"></i> Tài khoản</a></li> --}}

                                <li class="cart-hover" style="padding:0 0 20px 0" ><a style="padding:0 0 20px 0" href="{{URL::to('/show-cart-ajax')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                                    <span class="counter-cart"></span>
                                    <div class="previewing"></div>
                                </a></li>
                                <?php 


                                $customer_id =Session::get('customer_id');
                                $shipping_id =Session::get('shipping_id');
                                if ($customer_id!=NULL) {
                                ?>
                                <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <li><a href="{{URL::to('/history-order')}}"><i class="fa fa-bell"></i>Lịch sử mua hàng</a></li>
                                
                                <?php
                                    }else{
                                ?>
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    }
                                ?>

                                {{-- <li><a href="{{URL::to('/show-cart-ajax')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                                    <span class="cart_counter">1</span>
                                </a></li> --}}
                                

                                <?php 
                                $customer_id =Session::get('customer_id');
                                if ($customer_id!=NULL) {
                                ?>

                                <li class="dropdown-logout">
                                    <a href="#"><i class="fa fa-user"></i> {{Session::get('customer_name')}}</a>
                                    <ul role="menu" class="sub-menu-logout">
                                        <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                    </ul>
                                </li>

                                <?php
                                }else{
                                ?>
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <?php
                                }
                                ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom" id="header-bottom"><!--header-bottom-->
            <div class="container"  >
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="{{Request::segment(1)==''||Request::segment(1)=='trang-chu' ? 'active' : ''}}">Trang chủ</a></li>
                                <li class="dropdown"><a href="#" class="{{Request::segment(1)=='thuong-hieu-san-pham' ||Request::segment(1)=='danh-muc-san-pham'||Request::segment(1)=='chi-tiet-san-pham'? 'active' : ''}}"> Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    @foreach( $brand as $key =>$brand1)
                                        <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand1->brand_slug)}}">{{$brand1->brand_name}}</a></li>
                                    @endforeach
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="{{URL::to('/tin-tuc')}}" class="{{Request::segment(1)=='tin-tuc'||Request::segment(1)=='danh-muc-tin-tuc' ? 'active' : ''}}">Tin tức <i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category_post as$key =>$item)
                                        <li><a href="{{URL::to('/danh-muc-tin-tuc/'.$item->cate_post_slug)}}">{{$item->cate_post_name}}</a></li>
                                        @endforeach

                                    </ul>
                                </li> 
                                <li><a href="{{URL::to('/show-cart-ajax')}}"  class="{{Request::segment(1)=='show-cart-ajax' ? 'active' : ''}}"> Giỏ hàng <span class="counter-cart"></span></a></li>
                                <li><a href="{{URL::to('/lien-he')}}"  class="{{Request::segment(1)=='lien-he' ? 'active' : ''}}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                    <form action="{{URL::to('/tim-kiem')}}" autocomplete="off" id="form-autosearch" method="POST">
                    {{csrf_field()}}
                        <div class="search_box pull-right" style="width: 100%;">
                            <input style="width:70%;" type="text" name="keywords_submit" id="keywords" placeholder="Nhập từ khóa"/>
                            <input type="submit" name="search_item" class="btn btn-default" value="Tìm kiếm" />
                        </div>
                        <div class="search_ajax"></div>
                    </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @yield('slider')
                </div>
            </div>
        </div>
    </section><!--/slider-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach( $category as $key =>$categoryItem)
                            <div class="panel panel-default">
                                @if($categoryItem->category_parent==0)
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        {{-- {{URL::to('/danh-muc-san-pham/'.$categoryItem->category_id)}} --}}
                                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$categoryItem->category_id}}">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            {{$categoryItem->category_name}}
                                        </a>
                                    </h4>
                                </div>
                                @endif
                                <div id="{{$categoryItem->category_id}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            @foreach( $category as $key =>$subItem)
                                                @if( $subItem->category_parent==$categoryItem->category_id)
                                                    <li><a href="{{URL::to('/danh-muc-san-pham/'.$subItem->category_slug)}}">{{$subItem->category_name}}</a></li>
                                                @endif
                                            
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach( $brand as $key =>$brand2)
                                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand2->brand_slug)}}"> <span class="pull-right">(50)</span> {{$brand2->brand_name}}</a></li>
                                    @endforeach
                            </div>
                        </div><!--/brands_products-->
                        
{{--                         <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range--> --}}
                        
                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{asset('public/frontend/images/home/shipping.jpg')}}" alt="" />
                        </div><!--/shipping-->
                    
                    </div>
                    
                </div>
                
                <div class="col-sm-9 padding-right">
                    @yield('content')
                    
                </div>
            </div>
        </div>
    </section>

    <section id="partner"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @yield('partner')
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top" style="margin-top: 20px;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <img src="{{URL::to('public/uploads/logo/'.$contactItem->info_image)}}" height="100">
                            <h3 style="margin-top: 5px; color: #444791;font-family: abel; text-decoration: none;">{{$contactItem->info_name}}</h3>
                            <p>{{$contactItem->info_slogan}}</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        
                        
                      
                        <div class="col-sm-12">
                            
                               <div class="single-widget" style="margin: 10% 5%;line-height: 25px;">
                            <ul class="nav nav-pills nav-stacked">
                                @foreach($contact as$key=>$contactItem)
                                <li><b>Địa chỉ 1: </b><span>{{$contactItem->info_address}}</span></li>
                                <li><b>Địa chỉ 2: </b><span></span></li>
                                <li><b>Số điện thoại: </b><span>(+84) {{$contactItem->info_contact}}</span></li>
                                <li><b>Email: </b><span><a target="_blank" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&source=mailto&to={{$contactItem->info_gmail}}">{{$contactItem->info_gmail}}</a></span></li>
                                @endforeach
                            </ul>
                        
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{asset('public/frontend/images/home/map1.png')}}" style="opacity:0.35;"  alt="" />
                            <p>Dịch vụ đặt hoa uy tín số 1 Việt Nam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                      <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Trang chủ</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Giỏ hàng</a></li>
                                <li><a href="#">Thanh toán</a></li>
                                <li><a href="#">Đăng nhập</a></li>
                                <li><a href="#">Voucher</a></li>
                                <li><a href="#">Tin tức</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Mua hoa</h2>
                            <ul class="nav nav-pills nav-stacked">
                                
                            @foreach( $brand as $key =>$brand1)
                                <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand1->brand_slug)}}">{{$brand1->brand_name}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Giới thiệu</h2>
                            <ul class="nav nav-pills nav-stacked">
                                @foreach($post_policy as $key=>$post_policy_item)
                                <li><a href="{{URL::to('/tin-tuc/'.$post_policy_item->post_slug)}}" target="blank" title="{{$post_policy_item->post_name}}">{{$post_policy_item->post_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>r</h2>
                            <ul class="nav nav-pills nav-stacked">
                                @foreach($post_store as $key=>$post_store_item)
                                <li><a href="{{URL::to('/tin-tuc/'.$post_store_item->post_slug)}}" target="blank" title="{{$post_store_item->post_name}}">{{$post_store_item->post_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Nhập email của bạn" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Đăng kí đề nhận ngay tin tức về những<br />sự kiện sắp diễn ra của chúng tôi</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2022 by meeem. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://huucong.site">HuuCong</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/prettify.js')}}"></script>
    <script src="{{asset('public/frontend/js/owl.carousel.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>


    <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
    margin:20,
    loop: true,
    autoplay: true,
    autoplayTimeout: 1520,
    smartSpeed: 1500,
    animateIn: 'linear',
    animateOut: 'linear',

    autoplayHoverPause: true,

    // slideTransition: 'linear',

    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
        }
    })
    </script>

    <script type="text/javascript">
    $(function(){
        $( "#datepicker3" ).datepicker({
            changeMonth: true,
            changeYear: true,
            minDate: new Date(),
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:"yy-mm-dd",
            dayNamesMin: ["T2","T3","T4","T5","T6","T7","CN"],
            duration: "slow"
        });

    });
    </script>

    <script>
      $(document).ready(function(){
        $( "#slider-range" ).slider({
          range: true,
          min:{{round($min_price_range)}}, 
          max:{{round($max_price_range)}},
          values: [ {{$min_price}}, {{$max_price}} ],
          step:10000,

          slide: function( event, ui ) {
            $( "#amount" ).val(ui.values[ 0 ] + " VND  - " + ui.values[ 1 ] + " VND");
            $( "#start_price" ).val(ui.values[ 0 ]);
            $( "#end_price" ).val(ui.values[ 1 ]);
          }
        });

        $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
          " VND  - " + $( "#slider-range" ).slider( "values", 1 ) + " VND");
         } );  
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#sort').on('change',function() {
                var url =$(this).val();
                    if(url){
                        window.location= url;
                    }
                    return false;
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var brand_id=$('.tabs_product').data('id');
            var _token = $('input[name="_token"]').val();  
            $.ajax({
                url: '{{url('/product-tabs')}}',
                method: 'POST',
                data:{brand_id:brand_id, _token:_token},
                success:function (data) {
                    $('#tabs_product').html(data);
                }
            });

            $('.tabs_product').click(function(){
                var brand_id=$(this).data('id');
                var _token = $('input[name="_token"]').val();  
                $.ajax({
                    url: '{{url('/product-tabs')}}',
                    method: 'POST',
                    data:{brand_id:brand_id, _token:_token},
                    success:function (data) {
                        $('#tabs_product').html(data);
                    }
                });
            });
        });

    </script>

    <script type="text/javascript">
        function remove_background(product_id) {
           for(var count=1;count<=5;count++){
            $('#'+product_id+'-'+count).css('color', '#ccc');
           }
        }
        // hover mouse to rating
        $(document).on('mouseenter', '.rating', function(){
            var index =$(this).data("index");    
            var product_id =$(this).data("product_id");    

            remove_background(product_id);

            for(var count=1;count<=index;count++){
                $('#'+product_id+'-'+count).css('color', '#e88e7c');
            }
        });
        // leave mouse out to rating
        $(document).on('mouseleave', '.rating', function(){
            var index =$(this).data("index");    
            var product_id =$(this).data("product_id");    
            var rating =$(this).data("rating");    

            remove_background(product_id);

            for(var count=1;count<=rating;count++){
                $('#'+product_id+'-'+count).css('color', '#e88e7c');
            }
        });
        // click mouse to rating
        $(document).on('click', '.rating', function(){
            var index =$(this).data("index");    
            var product_id =$(this).data("product_id");    
            var _token = $('input[name="_token"]').val();  

            $.ajax({
            url: '{{url('/add-rating')}}',
            method: 'POST',
            data:{product_id:product_id,index:index, _token:_token},
                success:function (data) {
                    if (data=='done') {
                        alert("Cảm ơn đã đánh giá");
                    }else{
                        alert("#lỗi, vui lòng thử lại sau!");
                    }
                }
            });

        });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
        load_comment();
    function load_comment() {
            var product_id =$('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();     
        $.ajax({
            url: '{{url('/load-comment')}}',
            method: 'POST',
            data:{product_id:product_id, _token:_token},
            success:function (data) {
                $('#comment_show').html(data);
            }
        });
    }
    $('.send-comment').click(function(){
        var product_id =$('.comment_product_id').val();
        var _token = $('input[name="_token"]').val();     
        var comment_name =$('.comment_name').val();
        var comment_content =$('.comment_content').val();

        $.ajax({
            url: '{{url('/send-comment')}}',
            method: 'POST',
            data:{comment_name:comment_name,comment_content:comment_content,product_id:product_id, _token:_token},
            success:function (data) {
                
                $('#notify_comment').html('<span class="text-success">Thêm bình luận thành công!, bình luận của bạn sẽ được duyệt sớm nhất có thể!</span>');
                load_comment();
                $('#notify_comment').fadeOut(15000);
                $('.comment_name').val('');
                $('.comment_content').val('');
                
            }
        });


    });

    });

    </script>

    <script type="text/javascript">
        $('.quickview').click(function(){
            var product_id =$(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/quickview')}}',
                method: 'POST',
                dataType: 'JSON',
                data: {product_id:product_id,_token:_token},
                success:function(data){
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);
                    $('#product_quickview_button').html(data.product_button);
                } 
            });
        });
    </script>

    <script type="text/javascript">
        $('#keywords').keyup(function(){
            var query =$(this).val();
            if(query!=''){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url : '{{url('/autocomplete-search')}}',
                method: 'POST',
                data: {query:query,_token:_token},
                success:function(data){
                    $('.search_ajax').fadeIn();
                    $('.search_ajax').html(data);
                } 
                });
            }else{
                 $('.search_ajax').fadeOut();
            }
        });
        $(document).on('click','.result-item',function(){
            $('#keywords').val($(this).text());
            $('#form-autosearch').submit();
            $('.search_ajax').fadeOut();
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:3,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }   
            });  
        });

    </script>


    <script type="text/javascript">
        $(document).ready(function(){
           $('.send_order').click(function(){

                swal({
                title: "Xác nhận đơn hàng",
                text: "Đơn hàng của bạn sẽ không hoàn trả khi đặt hàng, bạn muốn xác nhận không!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: " Mua hàng ",

                cancelButtonText: " Hủy !",
                closeOnConfirm: false,
                closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.shipping_method').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();

                        var shipping_date_revice=$('#datepicker3').val();

                        var _token = $('input[name="_token"]').val();


                        if(order_fee=='0'){
                            swal("Bạn chưa chọn nơi giao hàng", "Hãy chọn nơi giao hàng để chúng tôi có thể giao hàng thuận tiện!")
                        }else if(shipping_email=='' || shipping_date_revice=='' || shipping_name==''|| shipping_address==''|| shipping_phone=='' ||shipping_notes==''){
                            swal("Bạn chưa điền đủ thông tin!", "Hãy điền đủ thông tin của bạn để chúng tôi có thể giao hàng thuận tiện!")
                        
                        }else{
                            $.ajax({
                                url: '{{url('/confirm-order')}}',
                                method: 'POST',
                                data:{  shipping_email:shipping_email, 
                                    shipping_name:shipping_name, 
                                    shipping_address:shipping_address,
                                    shipping_phone:shipping_phone,
                                    shipping_notes:shipping_notes,
                                    order_fee:order_fee,
                                    order_coupon:order_coupon,
                                    shipping_method:shipping_method,
                                    shipping_date_revice:shipping_date_revice,
                                    _token:_token},
                                success:function (data) {
                                swal("Đã xác nhận", "đơn hàng của bạn đã được đặt.", "success");
                                }
                            });
                            window.setTimeout(function(){
                                location.reload();
                            },3000);
                        }

                    }else {
                        swal("Hủy", "Chưa đặt hàng thành công !", "error");    
                    } 
                });

           });

        });
    </script>


    <script type="text/javascript">
           $(document).on('click','.add-to-cart-quickview',function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_'+ id).val();
                var cart_product_quantity = $('.cart_product_quantity_'+ id).val();
                var cart_product_name = $('.cart_product_name_'+ id).val();
                var cart_product_image = $('.cart_product_image_'+ id).val();
                var cart_product_cost = $('.cart_product_cost_'+ id).val();
                var cart_product_price = $('.cart_product_price_'+ id).val();
                var cart_product_qty = $('.cart_product_qty_'+ id).val();
                var _token = $('input[name="_token"]').val();

                if (parseInt(cart_product_qty)>parseInt(cart_product_quantity)) {
                    alert('Xin lỗi bạn vì không đủ hàng, hãy đặt số lượng nhỏ hơn '+cart_product_quantity);
                }else{
                $.ajax({
                    url:'{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_quantity:cart_product_quantity,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_cost:cart_product_cost,cart_product_qty:cart_product_qty,_token:_token},
                    beforeSend:function() {
                        $('#beforesend_quickview').html('<p class="text-primary">Đang thêm sản phẩm vào giỏ..</p>.');
                    },
                    success:function() {
                        $('#beforesend_quickview').html('<p class="text-success">Sản phẩm đã được thêm vào giỏ.</p>')
                        }
                });
                }
           });
    </script>

    <script type="text/javascript">
        counter_cart();
        previewing();

            function counter_cart() {
               $.ajax({
                url:'{{url('/counter-cart')}}',
                method: 'GET',
                success:function(data) {
                      $('.counter-cart').html(data);
                    }
               });
            }
            function previewing() {
                $.ajax({
                url:'{{url('/preview-cart')}}',
                method: 'GET',
                success:function(data) {
                      $('.previewing').html(data);
                    }
               });
            }


        $(document).ready(function(){
            
    
           $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_'+ id).val();
                var cart_product_quantity = $('.cart_product_quantity_'+ id).val();
                var cart_product_name = $('.cart_product_name_'+ id).val();
                var cart_product_image = $('.cart_product_image_'+ id).val();
                var cart_product_cost = $('.cart_product_cost_'+ id).val();
                var cart_product_price = $('.cart_product_price_'+ id).val();
                var cart_product_discount = $('.cart_product_discount_'+ id).val();
                var cart_product_qty = $('.cart_product_qty_'+ id).val();
                var _token = $('input[name="_token"]').val();

                if (parseInt(cart_product_qty)>parseInt(cart_product_quantity)) {
                    alert('Xin lỗi bạn vì không đủ hàng, hãy đặt số lượng nhỏ hơn '+cart_product_quantity);
                }else{
                $.ajax({
                    url:'{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_quantity:cart_product_quantity,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_cost:cart_product_cost,cart_product_qty:cart_product_qty,cart_product_discount:cart_product_discount,_token:_token},
                    success:function (data) {
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/show-cart-ajax')}}";
                            });
                        counter_cart();
                        previewing();

                    }

                });
                }
           });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action =$(this).attr('id');
            var ma_id= $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            
            if(action=='city'){
                result='province';   
            }else{
                result='wards';
            }
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                data: {action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#'+result).html(data);
                } 
            })
        });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.caculate_delivery').click(function(){
                var matp=$('.city').val();
                var maqh=$('.province').val();
                var maxptt=$('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp==''|| maqh=='' || maxptt=='') {
                    alert('chưa chọn nơi vận chuyển');
                }else{
                    $.ajax({
                        url : '{{url('/caculate-fee')}}',
                        method: 'POST',
                        data: {matp:matp,maqh:maqh,maxptt:maxptt,_token:_token},
                        success:function(){
                            location.reload();
                        } 
                    });
                }
            });
        });
    </script>
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("header-bottom");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
</body>
</html>