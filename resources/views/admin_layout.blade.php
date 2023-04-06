<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Dashboard of Decembre de Fleur </title>
  <link rel="icon" sizes="14x14" href="{{asset('public/uploads/logo/unknow.jpg')}}" type="image/gif">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{csrf_token()}}">
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link rel="stylesheet" href="{{asset('public/backend/css/font-awesome.css')}}" > 
<link rel="stylesheet" href="{{asset('public/backend/css/select2.min.css')}}" type="text/css"/>
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<link rel="stylesheet" href="{{asset('public/backend/css/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
{{-- <div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-tasks"></i>
                <span class="badge bg-success">8</span>
            </a>
            <ul class="dropdown-menu extended tasks-bar">
                <li>
                    <p class="">You have 8 pending tasks</p>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Target Sell</h5>
                                <p>25% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="45">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Product Delivery</h5>
                                <p>45% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="78">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Payment collection</h5>
                                <p>87% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="60">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Target Sell</h5>
                                <p>33% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="90">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>

                <li class="external">
                    <a href="#">See All Tasks</a>
                </li>
            </ul>
        </li>
        <!-- settings end -->
        <!-- inbox dropdown start-->
        <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-important">4</span>
            </a>
            <ul class="dropdown-menu extended inbox">
                <li>
                    <p class="red">You have 4 Mails</p>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="{{asset('public/backend/images/3.png')}}"></span>
                                <span class="subject">
                                <span class="from">Jonathan Smith</span>
                                <span class="time">Just now</span>
                                </span>
                                <span class="message">
                                    Hello, this is an example msg.
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="{{asset('public/backend/images/1.png')}}"></span>
                                <span class="subject">
                                <span class="from">Jane Doe</span>
                                <span class="time">2 min ago</span>
                                </span>
                                <span class="message">
                                    Nice admin template
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="{{asset('public/backend/images/3.png')}}"></span>
                                <span class="subject">
                                <span class="from">Tasi sam</span>
                                <span class="time">2 days ago</span>
                                </span>
                                <span class="message">
                                    This is an example msg.
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="{{asset('public/backend/images/2.png')}}"></span>
                                <span class="subject">
                                <span class="from">Mr. Perfect</span>
                                <span class="time">2 hour ago</span>
                                </span>
                                <span class="message">
                                    Hi there, its a test
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">See all messages</a>
                </li>
            </ul>
        </li>
        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">3</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Notifications</p>
                </li>
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #1 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-danger clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #2 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-success clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #3 overloaded.</a>
                        </div>
                    </div>
                </li>

            </ul>
        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div> --}}
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        {{-- <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li> --}}
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span style="line-height: 30px; margin: 15px;" class="username">
                    @php    
                        if (Auth::check()) {    
                    @endphp
                        {{Auth::user()->name}}
                    @php
                        }else{
                    @endphp
                        You're not sign in
                    @php
                        }
                    @endphp
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
               {{--  <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> --}}
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="{{Request::segment(1)=='dashboard' ? 'active' : ''}}" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @can('list-category')
                <li>
                    <a href="{{URL::to('/list-category')}}" class="{{Request::segment(1)=='list-category'||Request::segment(1)=='edit-category'||Request::segment(1)=='add-category' ? 'active' : ''}}">
                        <i class="fa fa-tags"></i>
                        <span>Danh mục</span>
                    </a>
                </li>
                @endcan
                @can('list-brand')
                <li >
                    <a href="{{URL::to('/list-brand')}}" class="{{Request::segment(1)=='list-brand' ||Request::segment(1)=='edit-brand'||Request::segment(1)=='add-brand' ? 'active' : ''}}">
                        <i class="fa fa-bookmark"></i>
                        <span>Thương hiệu</span>
                    </a>
                </li>
                @endcan
 
                @can('list-product')
                <li class="sub-menu">
                    <a href="javascript:;"  class="{{Request::segment(1)=='list-product' ||Request::segment(1)=='edit-product'||Request::segment(1)=='add-product' ||Request::segment(1)=='add-gallery'? 'active' : ''}}">
                        <i class="fa fa-users"></i>
                        <span>Quản lý sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/list-product')}}">Danh sách sản phẩm</a></li>
                        <li><a href="{{URL::to('/list-product-discount')}}">Quản lý giá bán</a></li>
                    </ul>
                 </li>
                 @endcan
                @can('list-order')
                <li class="sub-menu">
                    <a href="{{URL::to('/list-order')}}" class="{{Request::segment(1)=='list-order'||Request::segment(1)=='view-order' ? 'active' : ''}}">
                        <i class="fa fa-tasks"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                @endcan
                @can('list-feeship')
                <li class="sub-menu">
                    <a href="{{URL::to('/delivery')}}" class="{{Request::segment(1)=='delivery' ? 'active' : ''}}">
                        <i class="fa fa-truck"></i>
                        <span>Phí vận chuyển</span>
                    </a>
                </li>
                @endcan
                @can('list-coupon')
                <li class="sub-menu">
                    <a href="{{URL::to('/list-coupon')}}" class="{{Request::segment(1)=='list-coupon'||Request::segment(1)=='add-coupon' ? 'active' : ''}}">
                        <i class="fa fa-flash"></i>
                        <span>Mã giảm giá</span>
                    </a>
                </li>
                @endcan
                @can('list-slider')
                <li class="sub-menu">
                    <a href="{{URL::to('/list-slider')}}" class="{{Request::segment(1)=='list-slider' ||Request::segment(1)=='edit-slider'||Request::segment(1)=='add-slider' ? 'active' : ''}}">
                        <i class="fa fa-picture-o"></i>
                        <span>Slider</span>
                    </a>
                </li>
                @endcan
                @can('list-user')
                <li class="sub-menu">
                    <a href="javascript:;"  class="{{Request::segment(1)=='list-user' ||Request::segment(1)=='edit-user'||Request::segment(1)=='add-user' ||Request::segment(1)=='list-roles' ||Request::segment(1)=='edit-roles'||Request::segment(1)=='add-roles' ? 'active' : ''}}">
                        <i class="fa fa-users"></i>
                        <span>Quản lý user</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/list-user')}}">Danh sách user</a></li>
                        @can('list-role')<li><a href="{{URL::to('/list-roles')}}">Danh sách phân quyền</a></li>@endcan
                    </ul>
                 </li>
                 @endcan

                 <li class="sub-menu">
                    <a href="javascript:;" class="{{Request::segment(1)=='list-cate-post' ||Request::segment(1)=='edit-cate-post'||Request::segment(1)=='add-cate-post'||Request::segment(1)=='list-post' ||Request::segment(1)=='edit-post'||Request::segment(1)=='add-post' ? 'active' : ''}}">
                        <i class="fa fa-th"></i>
                        <span>Quản lý bài viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/list-cate-post')}}">Danh mục bài viết</a></li>
                        <li><a href="{{URL::to('/list-post')}}">Bài viết</a></li>
                    </ul>
                </li> 

                <li class="sub-menu">
                    <a href="{{URL::to('/list-comment')}}" class="{{Request::segment(1)=='list-comment' ? 'active' : ''}}">
                        <i class="fa fa-comment"></i>
                        <span>Quản lý bình luận</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="{{URL::to('/add-info')}}" class="{{Request::segment(1)=='add-info' ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Thông tin website</span>
                    </a>
                </li>

                {{-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-coupon')}}">Thêm mã giảm giá</a></li>
                        <li><a href="{{URL::to('/list-coupon')}}">Danh sách mã giảm giá</a></li>
                    </ul>
                </li> 
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-slider')}}">Thêm slider</a></li>
                        <li><a href="{{URL::to('/list-slider')}}">Danh sách slider</a></li>
                    </ul>
                </li>--}}
               
                {{--<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-envelope"></i>
                        <span>Mail </span>
                    </a>
                    <ul class="sub">
                        <li><a href="mail.html">Inbox</a></li>
                        <li><a href="mail_compose.html">Compose Mail</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Maps</span>
                    </a>
                    <ul class="sub">
                        <li><a href="google_map.html">Google Map</a></li>
                        <li><a href="vector_map.html">Vector Map</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-glass"></i>
                        <span>Extra</span>
                    </a>
                    <ul class="sub">
                        <li><a href="gallery.html">Gallery</a></li>
						<li><a href="404.html">404 Error</a></li>
                        <li><a href="registration.html">Registration</a></li>
                    </ul>
                </li>--}}
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        
        @yield('admin_content')

    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="#">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/backend/js/select2.min.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dataTables.js') }}"></script>
<script src="{{asset('public/backend/js/dataTables.bootstrap.js') }}"></script>
<script src="{{asset('public/backend/js/bootstrap-tagsinput.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

{!! Toastr::message() !!}

<script type="text/javascript">
    $(document).ready(function(){
        $('#category_order').sortable({
            placeholder: 'ui-state-highlight',
            update : function(event, ui) {
                var page_id_array=new Array();
                var _token = $('input[name="_token"]').val();
                $('#category_order tr').each(function(){
                    page_id_array.push($(this).attr("id"));
                });
            $.ajax({
                url : '{{url('/arrange-category')}}',
                method: 'POST',
                data: {_token:_token,page_id_array:page_id_array},
                success:function(data){
                    alert(data);
                } 
            });

            }
        });

        $('#brand_order').sortable({
            placeholder: 'ui-state-highlight',
            update : function(event, ui) {
                var page_id_array=new Array();
                var _token = $('input[name="_token"]').val();
                $('#brand_order tr').each(function(){
                    page_id_array.push($(this).attr("id"));
                });
                $.ajax({
                url : '{{url('/arrange-brand')}}',
                method: 'POST',
                data: {_token:_token,page_id_array:page_id_array},
                success:function(data){
                    alert(data);
                } 
            });

            }
        });
    });
</script>


<script type="text/javascript">
    function previewfile(input) {
        var file =$(".image-preview").get(0).files[0];
        if (file){
            var reader = new FileReader();
            reader.onload= function() {
                $(".previewImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
        
    }
</script>


<script type="text/javascript">
    $('#dataTableList').DataTable({
    responsive: true,
    "language": {
        "emptyTable":     "Không tồn tại dữ liệu",
        "lengthMenu":     "Hiển thị _MENU_ ",
        "search":         "Tìm kiếm",
        "paginate": {
            "next":       "Tiếp",
            "previous":   "Quay trở lại"
        },
        "info":           "Hiển thị  _PAGE_  của _PAGES_",
        "processing": "",
        "infoFiltered": " ",
        "infoEmpty":"Không tồn tại dữ liệu",
        "zeroRecords": " ",

    },
});
</script>
<script type="text/javascript">
        $('.update_quantity_order').click(function(){
            var ord_product_id=$(this).data('product_id');
            var order_qty = $('.order_qty_'+ord_product_id).val();
            var order_code= $('.order_code').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url : '{{url('/update-qty')}}',
                method: 'POST',
                data: {_token:_token, ord_product_id:ord_product_id, order_qty:order_qty, order_code: order_code},
                success:function(data){
                    alert('Cập nhật số lượng thành công');
                    location.reload();
                } 
        });

        });
</script>

<script type="text/javascript">
 
    function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
           
</script>

<script type="text/javascript">
    $('.order_details').change(function(){
        var order_status =$(this).val();
        var order_id =$(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();

        quantity=[];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        order_product_id=[];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        a = 0;
        for(i=0;i<order_product_id.length;i++){
            var order_qty= $('.order_qty_'+order_product_id[i]).val();

            var product_qty =$('.product_qty_'+order_product_id[i]).val();

            if (parseInt(order_qty)>parseInt(product_qty) && order_status==2) {
                a= a+1;
                if (a==1) {
                    alert('Trong kho không đủ hàng!');
                }
                $('.color_qty_'+order_product_id[i]).css('border', 'solid 2px red');
            }
        }

        if (a==0){
            $.ajax({
                url : '{{url('/update-order-qty')}}',
                method: 'POST',
                data: {_token:_token, order_status:order_status, order_id:order_id, quantity:quantity,order_product_id:order_product_id},
                success:function(data){
                    alert('Cập nhật đơn hàng thành công');
                    location.reload();
                } 
            });
        }

    });
</script>

<script type="text/javascript">
    $('.select2_init').select2({
        'placeholder':'Chọn phân quyền'
        })

</script>

<script type="text/javascript">
    $('.checkbox_wrapper').on('click', function(){
        $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
    });

    $('.checkall').on('click', function(){
        $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
        $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
    });
</script>

<script type="text/javascript">
    $.validate({

    });
</script>


<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->	
{{-- <script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script> --}}

    
{{--<script type="text/javascript">
    CKEDITOR.replace('ckeditor',{
        filebrowserImageUploadUrl:"{{url('uploads-ckeditor?_token='.csrf_token())}}",
        filebrowserBrowseUrl:"{{url('file-browser?_token='.csrf_token())}}",
        filebrowserUploadMethod:'form'
    });

</script> --}}
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
