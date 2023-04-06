@extends('layout')
@section('content')
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
	@foreach($post_detail as $key => $item)
    <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{URL::to('/tin-tuc')}}">Tin tức</a></li>
    <li class="breadcrumb-item"><a href="{{URL::to('/danh-muc-tin-tuc/'.$item->cate_post_slug)}}">{{$item->cate_post_name}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$item->post_name}}</li>
    @endforeach
  </ol>
</nav>
<div class="features_items"><!--features_items-->
    	<div class="blog-post-area">
			<h2 class="title text-center">Tin tức</h2>

	@foreach($post_detail as $key => $detail)
			<div class="single-blog-post">
				<h2>{{$detail->post_name}}</h2>
				<h6>*{{$detail->cate_post_name}} <span style="margin-left: 10px;">post: #{{$detail->cate_post_id}} </span></h6><br>
					<img class="img-responsive center-block"  src="{{URL::to('/public/uploads/post/'.$detail->post_image)}}" alt="{{$detail->post_name}}"><br>
				<p>{!! $detail->post_content !!}</p> <br>

			</div>
		</div><!--/blog-post-area-->
	@endforeach

	<h2 class="text-center">Tin tức gợi ý</h2>
	<div class="recommended_items recommended-post col-sm-12"><!--recommended_items-->
		
		@foreach($recommended as $key =>$recommendedItem)
			<div class="post-item ">
   				<div class="item-info">
   					<a href="{{URL::to('/tin-tuc/'.$recommendedItem->post_slug)}}"><img class="img-responsive center-block" style="width: 80% !important; height: 130px !important; " src="{{URL::to('/public/uploads/post/'.$recommendedItem->post_image)}}" alt="{{$recommendedItem->post_name}}"></a>
   					<div class="post-detail">						       			
   						<h4 class="post-title"><a href="{{URL::to('/tin-tuc/'.$recommendedItem->post_slug)}}">{{$recommendedItem->post_name}}</a></h4>
   					</div>
   				</div>
			</div>
		@endforeach			
	</div>
</div><!--/recommended_items-->

@endsection