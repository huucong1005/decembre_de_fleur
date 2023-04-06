@extends('layout')
@section('content')
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
	@foreach($cate_post_name as $key => $item)
    <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{URL::to('/tin-tuc')}}">Tin tức</a></li>
    <li class="breadcrumb-item active" aria-current="page">{!!$item->cate_post_name!!}</li>
    @endforeach
  </ol>
</nav>
<div class="features_items"><!--features_items-->
	@foreach($cate_post_name as $key => $cate_post_name_item)
    	<h2 class="title text-center">{!!$cate_post_name_item->cate_post_name!!}</h2>
	@endforeach
@foreach( $cate_post_by_id as $key =>$postItem)
	<article class="blogpost">
	
		<div class="row"> 
			<div class="col-sm-4"> 
				<div class="blog-post-area"> 
					<a href="{{URL::to('/tin-tuc/'.$postItem->post_slug)}}" target="blank" title="{{$postItem->post_name}}">
						<img src="{{URL::to('/public/uploads/post/'.$postItem->post_image)}}"
						 class="img-responsive" style="height:16.5rem ;" alt="{{$postItem->post_name}}">
					</a>
				</div> 
			</div>
			<div class="col-sm-8">
				<h3 class="single-blog-post"><a href="{{URL::to('/tin-tuc/'.$postItem->post_slug)}}" target="blank" title="{{$postItem->post_name}}">{{$postItem->post_name}}</a></h3> 
				<div class="post-excerpt">
					<p>{!! $postItem->post_desc !!}</p>
					<a class="btn add-to-cart pull-right" style="margin-right: 40px;"  href="{{URL::to('/tin-tuc/'.$postItem->post_slug)}}">Đọc thêm...</a>
				</div>
			</div> 
		</div>
	 <hr>
		<div class="blog-sep">
		</div>
	</article>
@endforeach
</div>
	<div class="pagination pagination-sm m-t-none m-b-none">
        {{ $cate_post_by_id->links("pagination::bootstrap-4") }}
    </div>

@endsection