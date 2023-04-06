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
                                <div class="col-sm-4">
                                    <p style="margin-top: 130px;">{{$slider->slider_desc}}</p>
                                    {{-- <button type="button" class="btn btn-default get">Get it now</button> --}}
                                </div>
                                <div class="col-sm-8 image">
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
                            @for($i=0; $i<$slider_count; $i++)
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
	<h2 class="title text-center">Liên hệ</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
  </ol>
</nav>
@foreach($contact as$key=>$contactItem)
<div class="row">
	<div class="col-md-12">
		<h4>Thông tin liên hệ</h4>
	</div>
	<div class="col-md-7">		
		<p>Cửa hàng: <span>{{$contactItem->info_name}}</span></p>
        <p>Địa chỉ: <span>{{$contactItem->info_address}}</span></p>
		<p>Số điện thoại: <span>(+84) {{$contactItem->info_contact}}</span></p>
		<p>Email: <a target="blank" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&source=mailto&to={{$contactItem->info_gmail}}">{{$contactItem->info_gmail}}</a></p>
	</div>
	<div class="col-md-5">
		{!!$contactItem->info_fanpage!!}
	</div>
	<div class="col-md-12">
		{{-- https://www.google.com/maps/ --}}
		<h4>Map</h4>
		{!!$contactItem->info_map!!}
	</div>
</div>

@endforeach
@endsection

@section('partner')
<hr>
<center><h3>~ Đối tác của chúng tôi ~</h3></center>
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



@endsection